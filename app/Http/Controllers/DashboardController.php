<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('member.index');
    }
}
