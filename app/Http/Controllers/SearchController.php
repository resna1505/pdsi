<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Agenda;
use App\Models\Article;
use App\Models\Workshop;
use App\Models\Workshops;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        try {
            $query = $request->input('query');
            $user = Auth::user();
            $userLevel = strtolower($user->level);

            Log::info("Search query: '{$query}' by user level: {$userLevel}");

            $results = [];

            // Cek level user untuk menentukan akses
            if ($userLevel === 'admin') {
                $results = $this->adminSearch($query);
            } elseif ($userLevel === 'dokter') {
                $results = $this->dokterSearch($query);
            } else {
                // Default untuk level lain
                $results = $this->dokterSearch($query);
            }

            return response()->json($results);
        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Search failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function adminSearch($query)
    {
        return [
            'menus' => $this->searchAdminMenus($query),
            'users' => $this->searchUsers($query),
            'agendas' => $this->searchAgendas($query),
            'news' => $this->searchNews($query),
            'workshops' => $this->searchWorkshops($query)
        ];
    }

    private function dokterSearch($query)
    {
        return [
            'menus' => $this->searchDokterMenus($query),
            'agendas' => $this->searchAgendas($query),
            'news' => $this->searchNews($query),
            'workshops' => $this->searchWorkshops($query)
        ];
    }

    private function searchAdminMenus($query)
    {
        // Menu lengkap untuk admin berdasarkan sidebar
        $adminMenus = [
            // Dashboard
            ['title' => 'Dashboard', 'url' => '/index', 'icon' => 'ri-pie-chart-line'],

            // User Menu
            ['title' => 'Member', 'url' => '/member', 'icon' => 'ri-user-line'],
            ['title' => 'Verifikasi Iuran', 'url' => '/verifikasi-iuran', 'icon' => 'ri-donut-chart-line'],

            // Apps
            ['title' => 'Calendar', 'url' => '/apps-calendar', 'icon' => 'bi-calendar3'],
            ['title' => 'Leaderboard', 'url' => '/apps-leaderboards', 'icon' => 'bi-gem'],

            // Master Data
            ['title' => 'User Management', 'url' => '/user', 'icon' => 'bi-person-circle'],
            ['title' => 'Workshops', 'url' => '/workshops', 'icon' => 'ri-calendar-line'],
            ['title' => 'Master Iuran', 'url' => '/masteriuran', 'icon' => 'ri-money-dollar-circle-line'],

            // Profile
            ['title' => 'Banner', 'url' => '/slider', 'icon' => 'ri-slideshow-line'],
            ['title' => 'News Management', 'url' => '/articles', 'icon' => 'ri-volume-up-line'],
            ['title' => 'Agenda', 'url' => '/agenda', 'icon' => 'ri-image-add-line'],
            ['title' => 'Mitra', 'url' => '/mitra', 'icon' => 'ri-building-2-line'],
            ['title' => 'About', 'url' => '/about', 'icon' => 'ri-list-unordered'],
            ['title' => 'Visi Misi', 'url' => '/visimisi', 'icon' => 'ri-invision-line'],
            ['title' => 'Program Kerja', 'url' => '/programkerja', 'icon' => 'ri-briefcase-line'],
            ['title' => 'FAQ', 'url' => '/faq', 'icon' => 'ri-questionnaire-line'],
        ];

        return collect($adminMenus)->filter(function ($menu) use ($query) {
            return stripos($menu['title'], $query) !== false;
        })->take(5)->values()->toArray();
    }

    private function searchDokterMenus($query)
    {
        // Menu terbatas untuk dokter berdasarkan sidebar
        $dokterMenus = [
            // Dashboard
            ['title' => 'Dashboard', 'url' => '/index', 'icon' => 'ri-pie-chart-line'],

            // User Menu
            ['title' => 'Iuran Anggota', 'url' => '/pembayaran-iuran', 'icon' => 'ri-funds-line'],
            ['title' => 'Training', 'url' => '/training', 'icon' => 'ri-briefcase-line'],
            ['title' => 'Announcement', 'url' => '/announcement', 'icon' => 'ri-megaphone-line'],

            // Apps
            ['title' => 'Calendar', 'url' => '/apps-calendar', 'icon' => 'bi-calendar3'],

            // FAQ
            ['title' => 'FAQ', 'url' => '/faq-dokter', 'icon' => 'ri-question-line'],

            // External Links
            ['title' => 'Transformasi Kesehatan Indonesia', 'url' => 'https://kemkes.go.id/id/layanan/transformasi-kesehatan-indonesia', 'icon' => 'ri-pin-distance-line'],
            ['title' => 'Gerakan Masyarakat Hidup Sehat', 'url' => 'https://kemkes.go.id/id/layanan/gerakan-masyarakat-hidup-sehat', 'icon' => 'ri-pin-distance-line'],
            ['title' => 'Platform Satu Sehat', 'url' => 'https://satusehat.kemkes.go.id/platform', 'icon' => 'ri-pin-distance-line'],
            ['title' => 'Tenaga Kesehatan', 'url' => 'https://kemkes.go.id/id/layanan/tenaga-kesehatan', 'icon' => 'ri-pin-distance-line'],
            ['title' => 'Fasilitas Kesehatan', 'url' => 'https://kemkes.go.id/id/layanan/fasilitas-kesehatan', 'icon' => 'ri-pin-distance-line'],
        ];

        return collect($dokterMenus)->filter(function ($menu) use ($query) {
            return stripos($menu['title'], $query) !== false;
        })->take(5)->values()->toArray();
    }

    private function searchUsers($query)
    {
        try {
            return User::whereHas('anggota', function ($q) use ($query) {
                $q->where('nama', 'LIKE', "%{$query}%")
                    ->orWhere('profesi', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->orWhere('spesialis', 'LIKE', "%{$query}%")
                    ->orWhere('kota', 'LIKE', "%{$query}%")
                    ->orWhere('provinsi', 'LIKE', "%{$query}%");
            })
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->with('anggota')
                ->limit(5)
                ->get()
                ->map(function ($user) {
                    $anggota = $user->anggota;
                    return [
                        'id' => $user->id,
                        'name' => $anggota->nama ?? $user->email,
                        'email' => $user->email,
                        'role' => $anggota->profesi ?? 'User',
                        'speciality' => $anggota->spesialis ?? null,
                        'city' => $anggota->kota ?? null,
                        'avatar' => $anggota->avatar ?? 'avatar-1.jpg',
                        'url' => '/user/' . $user->id
                    ];
                });
        } catch (\Exception $e) {
            Log::error('User search error: ' . $e->getMessage());
            return collect([]);
        }
    }

    private function searchAgendas($query)
    {
        try {
            return Agenda::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('location', 'LIKE', "%{$query}%")
                ->orWhere('author', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get()
                ->map(function ($agenda) {
                    return [
                        'id' => $agenda->id,
                        'title' => $agenda->title,
                        'description' => $agenda->description ? \Illuminate\Support\Str::limit($agenda->description, 50) : null,
                        'author' => $agenda->author,
                        'location' => $agenda->location,
                        'start_date' => $agenda->dimulai ? date('Y-m-d', strtotime($agenda->dimulai)) : null,
                        'end_date' => $agenda->berakhir ? date('Y-m-d', strtotime($agenda->berakhir)) : null,
                        'date' => $agenda->dimulai ? date('d M Y', strtotime($agenda->dimulai)) : 'TBD',
                        'url' => '/agenda/' . $agenda->id
                    ];
                });
        } catch (\Exception $e) {
            Log::error('Agenda search error: ' . $e->getMessage());
            return collect([]);
        }
    }

    private function searchNews($query)
    {
        try {
            return Article::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('author', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get()
                ->map(function ($article) {
                    return [
                        'id' => $article->id,
                        'title' => $article->title,
                        'excerpt' => $article->description ? \Illuminate\Support\Str::limit($article->description, 50) : null,
                        'author' => $article->author,
                        'published_at' => $article->created_at ? $article->created_at->format('d M Y') : null,
                        'url' => '/articles/' . $article->id
                    ];
                });
        } catch (\Exception $e) {
            Log::error('News search error: ' . $e->getMessage());
            return collect([]);
        }
    }

    private function searchWorkshops($query)
    {
        try {
            return Workshops::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('tagline', 'LIKE', "%{$query}%")
                ->orWhere('short_description', 'LIKE', "%{$query}%")
                ->where('is_active', true) // Hanya yang aktif
                ->limit(5)
                ->get()
                ->map(function ($workshop) {
                    return [
                        'id' => $workshop->id,
                        'title' => $workshop->title,
                        'tagline' => $workshop->tagline,
                        'description' => $workshop->description ? \Illuminate\Support\Str::limit($workshop->description, 50) : null,
                        'short_description' => $workshop->short_description,
                        'price' => $workshop->price > 0 ? 'Rp ' . number_format($workshop->price, 0, ',', '.') : 'Free',
                        'price_raw' => $workshop->price,
                        'image' => $workshop->image,
                        'url' => '/workshops/' . $workshop->id
                    ];
                });
        } catch (\Exception $e) {
            Log::error('Workshop search error: ' . $e->getMessage());
            return collect([]);
        }
    }
}
