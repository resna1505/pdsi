<?php

namespace App\Http\Controllers;

use App\Models\Perhimpunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PerhimpunanController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless(auth()->user()?->level === 'Admin', 403);

            return $next($request);
        });
    }

    public function index()
    {
        $data = Perhimpunan::withCount('anggotas')->orderBy('urutan')->orderBy('nama')->get();

        return view('admin.perhimpunan', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        try {
            Perhimpunan::create($validated + [
                'urutan' => (Perhimpunan::max('urutan') ?? 0) + 1,
                'kta_depan' => $this->storeKtaImage($request, 'kta_depan'),
                'kta_belakang' => $this->storeKtaImage($request, 'kta_belakang'),
            ]);

            return redirect()->back()->with('success', 'Perhimpunan berhasil ditambahkan!');
        } catch (\Throwable $e) {
            Log::error('Perhimpunan store error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Gagal menambahkan perhimpunan. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $perhimpunan = Perhimpunan::find($id);

        if (!$perhimpunan) {
            return response()->json(['success' => false, 'message' => 'Perhimpunan tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'perhimpunan' => $perhimpunan,
            'kta_depan_url' => $perhimpunan->kta_depan ? asset('storage/images/kta/' . $perhimpunan->kta_depan) : null,
            'kta_belakang_url' => $perhimpunan->kta_belakang ? asset('storage/images/kta/' . $perhimpunan->kta_belakang) : null,
        ]);
    }

    public function update(Request $request, $id)
    {
        $perhimpunan = Perhimpunan::findOrFail($id);
        $validated = $this->validateRequest($request);

        try {
            foreach (['kta_depan', 'kta_belakang'] as $field) {
                if ($request->hasFile($field) || $request->boolean('hapus_' . $field)) {
                    $this->deleteKtaImage($perhimpunan->{$field});
                    $validated[$field] = $this->storeKtaImage($request, $field);
                }
            }

            $perhimpunan->update($validated);

            return redirect()->back()->with('success', 'Perhimpunan berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('Perhimpunan update error: ' . $e->getMessage(), ['perhimpunan_id' => $id]);

            return redirect()->back()->with('error', 'Gagal memperbarui perhimpunan. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        $perhimpunan = Perhimpunan::withCount('anggotas')->findOrFail($id);

        if ($perhimpunan->anggotas_count > 0) {
            return redirect()->back()->with('error', 'Perhimpunan masih memiliki ' . $perhimpunan->anggotas_count . ' anggota. Nonaktifkan saja agar tidak muncul di form register.');
        }

        $this->deleteKtaImage($perhimpunan->kta_depan);
        $this->deleteKtaImage($perhimpunan->kta_belakang);
        $perhimpunan->delete();

        return redirect()->back()->with('success', 'Perhimpunan berhasil dihapus!');
    }

    private function validateRequest(Request $request): array
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'required|string|max:50',
            'kta_depan' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'kta_belakang' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        unset($validated['kta_depan'], $validated['kta_belakang']);
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }

    private function storeKtaImage(Request $request, string $field): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $destination = public_path('storage/images/kta');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file = $request->file($field);
        $fileName = time() . '_' . Str::random(6) . '_' . $field . '.' . $file->getClientOriginalExtension();
        $file->move($destination, $fileName);

        return $fileName;
    }

    private function deleteKtaImage(?string $fileName): void
    {
        if ($fileName && file_exists(public_path('storage/images/kta/' . $fileName))) {
            unlink(public_path('storage/images/kta/' . $fileName));
        }
    }
}
