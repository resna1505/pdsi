<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Otp;
use Carbon\Carbon;
use App\Mail\OtpEmail;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;

class Register extends Component
{
    use WithFileUploads;

    // PROPERTI YANG SUDAH ADA (TIDAK DIUBAH)
    public $email;
    public $name;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $no_hp = '628';
    public $alamat;
    public $kota;
    public $provinsi;
    public $profesi;
    public $ktp;
    public $npwp;
    public $avatar;
    public $password;
    public $password_confirmation, $otp, $generatedOtp, $remember;
    public $otherProfesi = '';
    public $noktp;

    // ========================================
    // 🆕 TAMBAHAN BARU UNTUK AUTOCOMPLETE
    // ========================================
    public $suggestions = [];
    public $showSuggestions = false;
    public $selectedKota = null;

    // 🆕 DATA KOTA DAN PROVINSI INDONESIA
    public $dataKota = [
        'Jakarta Pusat' => 'DKI Jakarta',
        'Jakarta Barat' => 'DKI Jakarta',
        'Jakarta Timur' => 'DKI Jakarta',
        'Jakarta Selatan' => 'DKI Jakarta',
        'Jakarta Utara' => 'DKI Jakarta',
        'Kep. Seribu' => 'DKI Jakarta',
        'Surabaya' => 'Jawa Timur',
        'Malang' => 'Jawa Timur',
        'Banyuwangi' => 'Jawa Timur',
        'Jember' => 'Jawa Timur',
        'Kediri' => 'Jawa Timur',
        'Blitar' => 'Jawa Timur',
        'Madiun' => 'Jawa Timur',
        'Mojokerto' => 'Jawa Timur',
        'Pasuruan' => 'Jawa Timur',
        'Probolinggo' => 'Jawa Timur',
        'Sidoarjo' => 'Jawa Timur',
        'Gresik' => 'Jawa Timur',
        'Lamongan' => 'Jawa Timur',
        'Bojonegoro' => 'Jawa Timur',
        'Tuban' => 'Jawa Timur',
        'Lumajang' => 'Jawa Timur',
        'Bondowoso' => 'Jawa Timur',
        'Situbondo' => 'Jawa Timur',
        'Nganjuk' => 'Jawa Timur',
        'Magetan' => 'Jawa Timur',
        'Ponorogo' => 'Jawa Timur',
        'Pacitan' => 'Jawa Timur',
        'Trenggalek' => 'Jawa Timur',
        'Tulungagung' => 'Jawa Timur',
        'Bandung' => 'Jawa Barat',
        'Bekasi' => 'Jawa Barat',
        'Bogor' => 'Jawa Barat',
        'Depok' => 'Jawa Barat',
        'Cirebon' => 'Jawa Barat',
        'Sukabumi' => 'Jawa Barat',
        'Tasikmalaya' => 'Jawa Barat',
        'Banjar' => 'Jawa Barat',
        'Cimahi' => 'Jawa Barat',
        'Garut' => 'Jawa Barat',
        'Kuningan' => 'Jawa Barat',
        'Majalengka' => 'Jawa Barat',
        'Pangandaran' => 'Jawa Barat',
        'Ciamis' => 'Jawa Barat',
        'Indramayu' => 'Jawa Barat',
        'Subang' => 'Jawa Barat',
        'Purwakarta' => 'Jawa Barat',
        'Karawang' => 'Jawa Barat',
        'Semarang' => 'Jawa Tengah',
        'Solo' => 'Jawa Tengah',
        'Magelang' => 'Jawa Tengah',
        'Salatiga' => 'Jawa Tengah',
        'Pekalongan' => 'Jawa Tengah',
        'Tegal' => 'Jawa Tengah',
        'Surakarta' => 'Jawa Tengah',
        'Kudus' => 'Jawa Tengah',
        'Jepara' => 'Jawa Tengah',
        'Demak' => 'Jawa Tengah',
        'Sragen' => 'Jawa Tengah',
        'Klaten' => 'Jawa Tengah',
        'Boyolali' => 'Jawa Tengah',
        'Wonogiri' => 'Jawa Tengah',
        'Karanganyar' => 'Jawa Tengah',
        'Yogyakarta' => 'DI Yogyakarta',
        'Sleman' => 'DI Yogyakarta',
        'Bantul' => 'DI Yogyakarta',
        'Kulon Progo' => 'DI Yogyakarta',
        'Gunung Kidul' => 'DI Yogyakarta',
        'Denpasar' => 'Bali',
        'Badung' => 'Bali',
        'Gianyar' => 'Bali',
        'Tabanan' => 'Bali',
        'Klungkung' => 'Bali',
        'Bangli' => 'Bali',
        'Karangasem' => 'Bali',
        'Buleleng' => 'Bali',
        'Jembrana' => 'Bali',
        'Medan' => 'Sumatera Utara',
        'Binjai' => 'Sumatera Utara',
        'Pematangsiantar' => 'Sumatera Utara',
        'Tanjungbalai' => 'Sumatera Utara',
        'Tebing Tinggi' => 'Sumatera Utara',
        'Sibolga' => 'Sumatera Utara',
        'Padangsidimpuan' => 'Sumatera Utara',
        'Gunungsitoli' => 'Sumatera Utara',
        'Palembang' => 'Sumatera Selatan',
        'Prabumulih' => 'Sumatera Selatan',
        'Pagar Alam' => 'Sumatera Selatan',
        'Lubuklinggau' => 'Sumatera Selatan',
        'Lahat' => 'Sumatera Selatan',
        'Muara Enim' => 'Sumatera Selatan',
        'Makassar' => 'Sulawesi Selatan',
        'Pare-Pare' => 'Sulawesi Selatan',
        'Palopo' => 'Sulawesi Selatan',
        'Bone' => 'Sulawesi Selatan',
        'Gowa' => 'Sulawesi Selatan',
        'Takalar' => 'Sulawesi Selatan',
        'Maros' => 'Sulawesi Selatan',
        'Balikpapan' => 'Kalimantan Timur',
        'Samarinda' => 'Kalimantan Timur',
        'Bontang' => 'Kalimantan Timur',
        'Berau' => 'Kalimantan Timur',
        'Kutai Kartanegara' => 'Kalimantan Timur',
        'Pontianak' => 'Kalimantan Barat',
        'Singkawang' => 'Kalimantan Barat',
        'Ketapang' => 'Kalimantan Barat',
        'Sintang' => 'Kalimantan Barat',
        'Manado' => 'Sulawesi Utara',
        'Bitung' => 'Sulawesi Utara',
        'Tomohon' => 'Sulawesi Utara',
        'Kotamobagu' => 'Sulawesi Utara',
        'Jayapura' => 'Papua',
        'Biak Numfor' => 'Papua',
        'Ambon' => 'Maluku',
        'Tual' => 'Maluku',
        'Banjarmasin' => 'Kalimantan Selatan',
        'Banjarbaru' => 'Kalimantan Selatan',
        'Pekanbaru' => 'Riau',
        'Dumai' => 'Riau',
        'Padang' => 'Sumatera Barat',
        'Bukittinggi' => 'Sumatera Barat',
        'Padangpanjang' => 'Sumatera Barat',
        'Pariaman' => 'Sumatera Barat',
        'Payakumbuh' => 'Sumatera Barat',
        'Solok' => 'Sumatera Barat',
        'Jambi' => 'Jambi',
        'Sungai Penuh' => 'Jambi',
        'Bengkulu' => 'Bengkulu',
        'Bandar Lampung' => 'Lampung',
        'Metro' => 'Lampung',
        'Serang' => 'Banten',
        'Tangerang' => 'Banten',
        'Cilegon' => 'Banten',
        'Tangerang Selatan' => 'Banten',
        'Banda Aceh' => 'Aceh',
        'Sabang' => 'Aceh',
        'Langsa' => 'Aceh',
        'Lhokseumawe' => 'Aceh',
        'Subulussalam' => 'Aceh',
        'Batam' => 'Kepulauan Riau',
        'Tanjungpinang' => 'Kepulauan Riau',
        'Mataram' => 'Nusa Tenggara Barat',
        'Bima' => 'Nusa Tenggara Barat',
        'Kupang' => 'Nusa Tenggara Timur',
        'Palu' => 'Sulawesi Tengah',
        'Kendari' => 'Sulawesi Tenggara',
        'Mamuju' => 'Sulawesi Barat',
        'Gorontalo' => 'Gorontalo',
        'Ternate' => 'Maluku Utara',
        'Tidore Kepulauan' => 'Maluku Utara',
        'Sorong' => 'Papua Barat',
        'Palangka Raya' => 'Kalimantan Tengah',
    ];

    // RULES VALIDATION (TIDAK DIUBAH)
    protected $rules = [
        'email' => 'required|string|email|max:255|unique:users',
        'name' => 'required',
        'noktp' => 'required|string|min:16|max:16', // ← TAMBAHKAN INI
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'no_hp' => 'required',
        'alamat' => 'required',
        'kota' => 'required',
        'provinsi' => 'required',
        'profesi' => 'required',
        'ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'npwp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
        ],
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'remember' => 'required|accepted',
        'otp' => 'required',
    ];

    // ========================================
    // 🆕 METHOD BARU UNTUK AUTOCOMPLETE
    // ========================================

    /**
     * Method dipanggil otomatis ketika properti $kota berubah
     */
    public function updatedKota()
    {
        $this->selectedKota = null;

        if (strlen($this->kota) >= 2) {
            $this->suggestions = collect($this->dataKota)
                ->keys()
                ->filter(function ($kota) {
                    return stripos($kota, $this->kota) !== false;
                })
                ->take(10)
                ->values()
                ->toArray();

            $this->showSuggestions = count($this->suggestions) > 0;

            // Auto-fill provinsi jika kota exact match
            if (isset($this->dataKota[$this->kota])) {
                $this->provinsi = $this->dataKota[$this->kota];
            }
        } else {
            $this->suggestions = [];
            $this->showSuggestions = false;
            $this->provinsi = '';
        }
    }

    protected $messages = [
        'password.regex' => 'Password harus mengandung kombinasi huruf dan angka.',
    ];

    /**
     * Method dipanggil ketika user klik pada suggestion
     */
    public function selectKota($selectedKota)
    {
        $this->kota = $selectedKota;
        $this->selectedKota = $selectedKota;
        $this->provinsi = $this->dataKota[$selectedKota] ?? '';
        $this->showSuggestions = false;
        $this->suggestions = [];
    }

    /**
     * Method untuk menyembunyikan suggestions
     */
    public function hideSuggestions()
    {
        $this->dispatch('hide-suggestions');
    }

    // ========================================
    // METHOD YANG SUDAH ADA (TIDAK DIUBAH)
    // ========================================

    public function sendOtp()
    {
        $this->validate(['email' => 'required|email']);

        // Generate OTP
        $otpCode = rand(100000, 999999);

        // Simpan OTP ke database
        Otp::updateOrCreate(
            ['email' => $this->email],
            ['otp' => $otpCode, 'expires_at' => Carbon::now()->addMinutes(10)]
        );

        // Kirim OTP ke email
        // Mail::raw("Your OTP Code is: $otpCode", function ($message) {
        //     $message->to($this->email)->subject('Your OTP Code');
        // });
        Mail::to($this->email)->send(new OtpEmail($otpCode));

        session()->flash('success', 'OTP has been sent to your email.');
    }

    public function submit()
    {
        $this->validate();

        $otpRecord = Otp::where('email', $this->email)
            ->where('otp', $this->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            session()->flash('error', 'Invalid or expired OTP.');
            return;
        }

        $otpRecord->delete();

        $destination = public_path('storage/images/users');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        if ($this->ktp) {
            $ktpName = time() . '_ktp.' . $this->ktp->getClientOriginalExtension();
            $ktpPath = $this->ktp->getRealPath();

            try {
                file_put_contents($destination . '/' . $ktpName, file_get_contents($ktpPath));
            } catch (\Exception $e) {
                dd('Gagal simpan file KTP: ' . $e->getMessage());
            }
        }


        $npwpName = $this->npwp ? time() . '_npwp.' . $this->npwp->getClientOriginalExtension() : null;
        if ($this->npwp) {
            try {
                file_put_contents($destination . '/' . $npwpName, file_get_contents($this->npwp->getRealPath()));
            } catch (\Exception $e) {
                dd('Gagal simpan file NPWP: ' . $e->getMessage());
            }
        }

        $avatarName = $this->avatar ? time() . '_avatar.' . $this->avatar->getClientOriginalExtension() : null;
        if ($this->avatar) {
            try {
                file_put_contents($destination . '/' . $avatarName, file_get_contents($this->avatar->getRealPath()));
            } catch (\Exception $e) {
                dd('Gagal simpan file Avatar: ' . $e->getMessage());
            }
        }


        if ($this->profesi == 'other') {
            $this->profesi = $this->otherProfesi;
        }

        $token = bin2hex(random_bytes(20));

        // ⛑️ Transaksi database
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $this->email,
                'level' => 'Dokter',
                'password' => Hash::make($this->password),
                'email_verified_at' => now(),
                'remember_token' => $token,
                'created_at' => now(),
            ]);

            Anggota::create([
                'user_id' => $user->id,
                'email' => $this->email,
                'nama' => $this->name,
                'noktp' => $this->noktp, // ← TAMBAHKAN INI
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
                'kota' => $this->kota,
                'provinsi' => $this->provinsi,
                'profesi' => $this->profesi,
                'spesialis' => $this->profesi,
                'ktp' => $ktpName,
                'npwp' => $npwpName,
                'avatar' => $avatarName,
            ]);

            DB::commit();
            return redirect('login')->with('success', 'User registered successfully.!');
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.master-without-nav');
    }
}
