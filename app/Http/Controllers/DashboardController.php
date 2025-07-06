<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Main dashboard yang akan redirect berdasarkan level user
     */
    public function index()
    {
        $user = Auth::user();

        switch (strtolower($user->level)) {
            case 'admin':
                return $this->adminDashboard();

            case 'dokter':
                return $this->dokterDashboard();

            default:
                return redirect()->route('login')->with('error', 'Unauthorized access');
        }
    }

    /**
     * Show admin dashboard
     */
    public function adminDashboard()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        $total_earnings = DB::table('iuran_anggotas as ia')
            ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
            ->where('ia.status', 3)
            ->whereBetween('mia.periode', [$startOfMonth, $endOfMonth])
            ->sum('mia.jumlah') ?? 0;

        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();

        $total_last_month = DB::table('iuran_anggotas as ia')
            ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
            ->where('ia.status', 3)
            ->whereBetween('mia.periode', [$startOfLastMonth, $endOfLastMonth])
            ->sum('mia.jumlah') ?? 0;

        $percentage = 0;
        $status = 'same';
        $formatted_percentage = '0.00';

        if ($total_last_month > 0) {
            $difference = $total_earnings - $total_last_month;
            $percentage = ($difference / $total_last_month) * 100;

            if ($percentage > 0) {
                $status = 'increase';
            } elseif ($percentage < 0) {
                $status = 'decrease';
            } else {
                $status = 'same';
            }

            $formatted_percentage = number_format(abs($percentage), 2);
        } elseif ($total_earnings > 0) {
            $percentage = 100;
            $status = 'increase';
            $formatted_percentage = '100.00';
        }

        $currentYear = Carbon::now()->year;
        $lastYear = Carbon::now()->subYear()->year;

        // Total seminar tahun ini
        $total_seminar_this_year = DB::table('workshops')
            ->where('is_active', 1)
            ->whereYear('created_at', $currentYear)
            ->count();

        // Total seminar tahun lalu
        $total_seminar_last_year = DB::table('workshops')
            ->where('is_active', 1)
            ->whereYear('created_at', $lastYear)
            ->count();

        // Hitung persentase perubahan seminar
        $seminar_percentage = 0;
        $seminar_status = 'same';
        $seminar_formatted_percentage = '0.00';

        if ($total_seminar_last_year > 0) {
            $seminar_difference = $total_seminar_this_year - $total_seminar_last_year;
            $seminar_percentage = ($seminar_difference / $total_seminar_last_year) * 100;

            if ($seminar_percentage > 0) {
                $seminar_status = 'increase';
            } elseif ($seminar_percentage < 0) {
                $seminar_status = 'decrease';
            } else {
                $seminar_status = 'same';
            }

            $seminar_formatted_percentage = number_format(abs($seminar_percentage), 2);
        } elseif ($total_seminar_this_year > 0) {
            $seminar_percentage = 100;
            $seminar_status = 'increase';
            $seminar_formatted_percentage = '100.00';
        }

        $doctorData = [
            'Dr. Umum' => DB::table('anggotas')->where('spesialis', 'Dokter Umum')->count(),
            'Sarjana Kedokteran' => DB::table('anggotas')->where('spesialis', 'Sarjana Kedokteran')->count(),
            'Dr. Spesialist' => DB::table('anggotas')->where('spesialis', 'Dokter Spesialis')->count(),
            'Anggota Kehormatan' => DB::table('anggotas')->where('spesialis', 'Anggota Kehormatan')->count(),
        ];

        $best_selling_seminar = DB::table('workshops')
            ->where('is_active', 1)
            ->get();

        $agendas = Agenda::orderBy('created_at', 'desc')
            ->limit(10) // Batasi jumlah agenda yang ditampilkan
            ->get()
            ->map(function ($agenda) {
                return [
                    'id' => $agenda->id,
                    'title' => $agenda->title,
                    'description' => $agenda->description,
                    'author' => $agenda->author,
                    'date' => Carbon::parse($agenda->created_at),
                    'month_year' => Carbon::parse($agenda->created_at)->format('F, Y'),
                    'day_month' => Carbon::parse($agenda->created_at)->format('j M'),
                    'formatted_date' => Carbon::parse($agenda->created_at)->format('d M Y'),
                ];
            });

        $totalDaftar = Anggota::count();
        $totalAktif = Anggota::where('spesialis', '!=', '')
            ->whereHas('user', function ($query) {
                $query->where('is_active', 1);
            })
            ->count();
        $totalNonAktif = Anggota::where('spesialis', '!=', '')
            ->whereHas('user', function ($query) {
                $query->where('is_active', 0);
            })
            ->count();

        $conversionRatio = $totalDaftar > 0 ? ($totalAktif / $totalDaftar) * 100 : 0;

        $currentYear = Carbon::now()->year;
        $chartData = [];

        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $daftarCount = Anggota::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

            $aktifCount = Anggota::whereHas('user', function ($query) {
                $query->where('is_active', 1);
            })
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $nonAktifCount = Anggota::whereHas('user', function ($query) {
                $query->where('is_active', 0);
            })
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $chartData['daftar'][] = $daftarCount;
            $chartData['aktif'][] = $aktifCount;
            $chartData['non_aktif'][] = $nonAktifCount;
        }


        return view('admin.index', compact(
            'total_earnings',
            'total_last_month',
            'percentage',
            'formatted_percentage',
            'status',
            'total_seminar_this_year',
            'total_seminar_last_year',
            'seminar_percentage',
            'seminar_formatted_percentage',
            'seminar_status',
            'doctorData',
            'best_selling_seminar',
            'agendas',
            'totalDaftar',
            'totalAktif',
            'totalNonAktif',
            'conversionRatio',
            'chartData',
        ));
    }

    /**
     * Show dokter dashboard  
     */
    public function dokterDashboard()
    {
        // Get current date info
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $lastYear = $currentYear - 1;

        // ==================== PEMBAYARAN SUKSES ====================
        // Query untuk total pembayaran sukses tahun sekarang (Januari - bulan sekarang)
        $totalPembayaranSekarang = DB::table('iuran_anggotas as ia')
            ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
            ->where('anggota_id', auth()->user()->anggota->id)
            ->where('status', 3)
            ->whereYear('mia.periode', $currentYear)
            ->whereMonth('mia.periode', '<=', $currentMonth)
            ->count();

        // Query untuk total pembayaran sukses tahun lalu (Januari - bulan yang sama tahun lalu)
        $totalPembayaranTahunLalu = DB::table('iuran_anggotas as ia')
            ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
            ->where('anggota_id', auth()->user()->anggota->id)
            ->where('status', 3)
            ->whereYear('mia.periode', $lastYear)
            ->whereMonth('mia.periode', '<=', $currentMonth)
            ->count();

        // Hitung persentase perubahan pembayaran sukses
        $persentasePerubahanSukses = 0;
        $statusTrendSukses = 'success'; // default green

        if ($totalPembayaranTahunLalu > 0) {
            $persentasePerubahanSukses = (($totalPembayaranSekarang - $totalPembayaranTahunLalu) / $totalPembayaranTahunLalu) * 100;
            $statusTrendSukses = $persentasePerubahanSukses >= 0 ? 'success' : 'danger';
        } elseif ($totalPembayaranSekarang > 0) {
            $persentasePerubahanSukses = 100; // Jika tahun lalu 0 tapi sekarang ada data
        }

        // Format persentase pembayaran sukses
        $persentaseFormattedSukses = number_format(abs($persentasePerubahanSukses), 2);
        $trendIconSukses = $persentasePerubahanSukses >= 0 ? 'ri-arrow-up-line' : 'ri-arrow-down-line';

        // ==================== GAGAL BAYAR IURAN ====================
        // Query untuk total gagal bayar tahun sekarang (Januari - bulan sekarang)
        $totalGagalBayarSekarang = DB::table('iuran_anggotas as ia')
            ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
            ->where('anggota_id', auth()->user()->anggota->id)
            ->where('status', '<>', 3) // Status selain 3
            ->whereYear('mia.periode', $currentYear)
            ->whereMonth('mia.periode', '<=', $currentMonth)
            ->count();

        // Query untuk total gagal bayar tahun lalu (Januari - bulan yang sama tahun lalu)
        $totalGagalBayarTahunLalu = DB::table('iuran_anggotas as ia')
            ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
            ->where('anggota_id', auth()->user()->anggota->id)
            ->where('status', '<>', 3) // Status selain 3
            ->whereYear('mia.periode', $lastYear)
            ->whereMonth('mia.periode', '<=', $currentMonth)
            ->count();

        // Hitung persentase perubahan gagal bayar
        $persentasePerubahanGagal = 0;
        $statusTrendGagal = 'danger'; // default red karena gagal bayar

        if ($totalGagalBayarTahunLalu > 0) {
            $persentasePerubahanGagal = (($totalGagalBayarSekarang - $totalGagalBayarTahunLalu) / $totalGagalBayarTahunLalu) * 100;
            // Untuk gagal bayar, trend turun (berkurang) adalah bagus, jadi logic dibalik
            $statusTrendGagal = $persentasePerubahanGagal >= 0 ? 'danger' : 'success';
        } elseif ($totalGagalBayarSekarang > 0) {
            $persentasePerubahanGagal = 100; // Jika tahun lalu 0 tapi sekarang ada data
            $statusTrendGagal = 'danger';
        } elseif ($totalGagalBayarSekarang == 0 && $totalGagalBayarTahunLalu > 0) {
            $persentasePerubahanGagal = -100; // Semua sudah berhasil bayar
            $statusTrendGagal = 'success';
        }

        // Format persentase gagal bayar
        $persentaseFormattedGagal = number_format(abs($persentasePerubahanGagal), 2);
        $trendIconGagal = $persentasePerubahanGagal >= 0 ? 'ri-arrow-up-line' : 'ri-arrow-down-line';

        $data = [
            // Data Pembayaran Sukses
            'totalPembayaran' => $totalPembayaranSekarang,
            'persentaseSukses' => $persentaseFormattedSukses,
            'statusTrendSukses' => $statusTrendSukses,
            'trendIconSukses' => $trendIconSukses,

            // Data Gagal Bayar
            'totalGagalBayar' => $totalGagalBayarSekarang,
            'persentaseGagal' => $persentaseFormattedGagal,
            'statusTrendGagal' => $statusTrendGagal,
            'trendIconGagal' => $trendIconGagal,

            // Data Umum
            'currentYear' => $currentYear,
            'currentMonth' => Carbon::now()->format('F') // nama bulan
        ];

        $agendaData = $this->getAgendaDataFromDB();

        return view('member.index', compact('data', 'agendaData'));
    }

    private function getAgendaDataFromDB()
    {
        try {
            // Buat subquery untuk UNION
            $agendasQuery = DB::table('agendas as ag')
                ->join('category_agendas as ca', 'ca.id', '=', 'ag.category_id')
                ->select(
                    'ag.title',
                    'ca.name as category',
                    'ag.created_at',
                    DB::raw("'-' as lokasi"),
                    DB::raw("0 as skp"),
                    DB::raw("'agenda' as source_type"),
                    'ag.id as source_id'
                );

            $workshopsQuery = DB::table('workshops as ws')
                ->join('categories_workshops as cw', 'cw.id', '=', 'ws.category_id')
                ->select(
                    'ws.title',
                    'cw.name as category',
                    'ws.created_at',
                    DB::raw("'-' as lokasi"),
                    DB::raw("0 as skp"),
                    DB::raw("'workshop' as source_type"),
                    'ws.id as source_id'
                )
                ->where('ws.is_active', 1);

            // Gabungkan dengan UNION dan pagination
            $agendas = $agendasQuery
                ->union($workshopsQuery)
                ->orderBy('created_at', 'desc')
                ->paginate(10); // 10 items per page

            // Transform data untuk view dengan tetap mempertahankan pagination
            $agendas->getCollection()->transform(function ($agenda) {
                $status = $this->determineStatus($agenda);

                return (object)[
                    'title' => $agenda->title,
                    'category' => $agenda->category,
                    'tanggal' => $agenda->created_at ? Carbon::parse($agenda->created_at)->format('d F Y') : 'Tanggal tidak tersedia',
                    'tanggal_raw' => $agenda->created_at,
                    'lokasi' => $agenda->lokasi ?? '-',
                    'skp' => $agenda->skp ?? 0,
                    'status' => $status,
                    'source_type' => $agenda->source_type,
                    'source_id' => $agenda->source_id,
                    'status_class' => $this->getStatusClass($status),
                    'action_button' => $this->getActionButton($status)
                ];
            });

            return $agendas;
        } catch (\Exception $e) {
            // Log error
            Log::error('Error getting agenda data: ' . $e->getMessage());

            // Return empty paginator
            return new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]),
                0,
                10,
                1,
                ['path' => request()->url()]
            );
        }
    }

    private function determineStatus($agenda)
    {
        // Status berdasarkan tanggal created_at (sementara)
        if (!$agenda->created_at) {
            return 'Belum Daftar';
        }

        $date = Carbon::parse($agenda->created_at);

        if ($date->isFuture()) {
            return 'Belum Daftar';
        } elseif ($date->isToday()) {
            return 'Terdaftar';
        } else {
            return 'Selesai';
        }
    }

    // private function getStatusClass($status)
    // {
    //     switch ($status) {
    //         case 'Terdaftar':
    //             return 'text-success bg-success-subtle';
    //         case 'Belum Daftar':
    //             return 'text-warning bg-warning-subtle';
    //         case 'Selesai':
    //             return 'text-secondary bg-secondary-subtle';
    //         case 'Disable':
    //             return 'text-danger bg-danger-subtle';
    //         default:
    //             return 'text-primary bg-primary-subtle';
    //     }
    // }

    // private function getActionButton($status)
    // {
    //     switch ($status) {
    //         case 'Terdaftar':
    //             return [
    //                 'text' => 'Lihat Detail',
    //                 'class' => 'btn btn-sm btn-primary',
    //                 'url' => '#'
    //             ];
    //         case 'Belum Daftar':
    //             return [
    //                 'text' => 'Daftar',
    //                 'class' => 'btn btn-sm btn-outline-primary',
    //                 'url' => '#'
    //             ];
    //         case 'Selesai':
    //             return [
    //                 'text' => 'Sertifikat',
    //                 'class' => 'btn btn-sm btn-success',
    //                 'url' => '#'
    //             ];
    //         default:
    //             return [
    //                 'text' => 'Aksi',
    //                 'class' => 'btn btn-sm btn-secondary',
    //                 'url' => '#'
    //             ];
    //     }
    // }

    // private function getAgendaData()
    // {
    //     $agendas = DB::select("
    //         SELECT
    //             ag.title,
    //             ca.name AS category,
    //             ag.created_at,
    //             '-' AS lokasi,
    //             0 AS skp,
    //             'agenda' AS source_type,
    //             ag.id AS source_id,
    //             CASE 
    //                 WHEN ag.created_at > NOW() THEN 'Terdaftar'
    //                 WHEN ag.created_at <= NOW() THEN 'Selesai'
    //                 ELSE 'Belum Daftar'
    //             END AS status
    //         FROM
    //             agendas AS ag
    //             INNER JOIN category_agendas AS ca ON ca.id = ag.category_id 

    //         UNION ALL

    //         SELECT
    //             ws.title,
    //             cw.name AS category,
    //             ws.created_at,
    //             '-' AS lokasi,
    //             0 AS skp,
    //             'workshop' AS source_type,
    //             ws.id AS source_id,
    //             CASE 
    //                 WHEN ws.created_at > NOW() THEN 'Terdaftar'
    //                 WHEN ws.created_at <= NOW() THEN 'Selesai'
    //                 ELSE 'Belum Daftar'
    //             END AS status
    //         FROM
    //             workshops AS ws
    //             INNER JOIN categories_workshops AS cw ON cw.id = ws.category_id
    //         WHERE
    //             ws.is_active = 1
    //         ORDER BY created_at DESC
    //     ");

    //     // Transform data untuk tampilan
    //     return collect($agendas)->map(function ($agenda) {
    //         return [
    //             'title' => $agenda->title,
    //             'category' => $agenda->category,
    //             'tanggal' => Carbon::parse($agenda->created_at)->format('d F Y'),
    //             'tanggal_raw' => $agenda->created_at,
    //             'lokasi' => $agenda->lokasi,
    //             'skp' => $agenda->skp,
    //             'status' => $agenda->status,
    //             'source_type' => $agenda->source_type,
    //             'source_id' => $agenda->source_id,
    //             'status_class' => $this->getStatusClass($agenda->status),
    //             'action_button' => $this->getActionButton($agenda->status, $agenda->source_type, $agenda->source_id)
    //         ];
    //     });
    // }

    private function getStatusClass($status)
    {
        switch ($status) {
            case 'Terdaftar':
                return 'text-success bg-success-subtle';
            case 'Belum Daftar':
                return 'text-warning bg-warning-subtle';
            case 'Selesai':
                return 'text-secondary bg-secondary-subtle';
            default:
                return 'text-primary bg-primary-subtle';
        }
    }

    private function getActionButton($status)
    {
        switch ($status) {
            case 'Terdaftar':
                return [
                    'text' => 'Lihat Detail',
                    'class' => 'btn btn-sm btn-primary',
                    // 'url' => route('agenda.detail', ['type' => $sourceType, 'id' => $sourceId])
                ];
            case 'Belum Daftar':
                return [
                    'text' => 'Daftar',
                    'class' => 'btn btn-sm btn-outline-primary',
                    // 'url' => route('agenda.register', ['type' => $sourceType, 'id' => $sourceId])
                ];
            case 'Selesai':
                return [
                    'text' => 'Sertifikat',
                    'class' => 'btn btn-sm btn-success',
                    // 'url' => route('agenda.certificate', ['type' => $sourceType, 'id' => $sourceId])
                ];
            default:
                return [
                    'text' => 'Lihat',
                    'class' => 'btn btn-sm btn-secondary',
                    'url' => '#'
                ];
        }
    }

    // Alternative method jika format periode berbeda (misal: YYYY-MM)
    // public function dokterDashboardAlternative()
    // {
    //     $currentYear = Carbon::now()->year;
    //     $currentMonth = Carbon::now()->month;
    //     $lastYear = $currentYear - 1;

    //     // Jika periode format string seperti "2024-01", "2024-02", dll
    //     $periodeSekarang = [];
    //     $periodeTahunLalu = [];

    //     for ($i = 1; $i <= $currentMonth; $i++) {
    //         $periodeSekarang[] = $currentYear . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
    //         $periodeTahunLalu[] = $lastYear . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
    //     }

    //     $totalPembayaranSekarang = DB::table('iuran_anggotas as ia')
    //         ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
    //         ->where('anggota_id', 1)
    //         ->where('status', 3)
    //         ->whereIn('mia.periode', $periodeSekarang)
    //         ->count();

    //     $totalPembayaranTahunLalu = DB::table('iuran_anggotas as ia')
    //         ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
    //         ->where('anggota_id', 1)
    //         ->where('status', 3)
    //         ->whereIn('mia.periode', $periodeTahunLalu)
    //         ->count();

    //     // Logic persentase sama seperti method sebelumnya...

    //     return view('member.index', compact('data'));
    // }
}
