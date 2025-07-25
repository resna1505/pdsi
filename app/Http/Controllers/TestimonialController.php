<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestimonialController extends Controller
{
    public function index()
    {
        try {
            $testimonials = Testimonial::select('testimonials.*', 'anggotas.nama as anggota_name')
                ->leftJoin('anggotas', 'testimonials.anggota_id', '=', 'anggotas.id')
                ->orderBy('testimonials.created_at', 'desc')
                ->get();

            // Load all anggota for dropdown
            $anggotas = Anggota::select('id', 'nama')
                ->orderBy('nama', 'asc')
                ->get();

            return view('member.testimonial', compact('testimonials', 'anggotas'));
        } catch (\Throwable $e) {
            Log::error('Testimonial index error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            // Fallback: tampilkan halaman kosong dengan error message
            return view('member.testimonial', [
                'testimonials' => collect([]),
                'anggotas' => collect([])
            ])->with('error', 'Failed to load testimonials. Please try again.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'anggota_id' => 'required|exists:anggotas,id',
                'testimonial_text' => 'required|string|max:1000',
                'rating' => 'required|integer|between:1,5',
            ]);

            Testimonial::create([
                'anggota_id' => $request->anggota_id,
                'testimonial_text' => $request->testimonial_text,
                'rating' => $request->rating,
                'is_active' => true,
            ]);

            return redirect()->back()->with('success', 'Testimonial added successfully!');
        } catch (\Throwable $e) {
            Log::error('Testimonial store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Testimonial. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();

            return redirect()->back()->with('success', 'Testimonial deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Testimonial delete error: ' . $e->getMessage(), [
                'testimonial_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Testimonial. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $testimonial = Testimonial::with('anggota')->findOrFail($id);
            $anggotas = Anggota::select('id', 'nama')->orderBy('nama', 'asc')->get();

            return response()->json([
                'success' => true,
                'testimonial' => $testimonial,
                'anggotas' => $anggotas
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);

            $request->validate([
                'anggota_id' => 'required|exists:anggotas,id',
                'testimonial_text' => 'required|string|max:1000',
                'rating' => 'required|integer|between:1,5',
            ]);

            $testimonial->update([
                'anggota_id' => $request->anggota_id,
                'testimonial_text' => $request->testimonial_text,
                'rating' => $request->rating,
            ]);

            return redirect()->back()->with('success', 'Testimonial updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Testimonial update error: ' . $e->getMessage(), [
                'testimonial_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Testimonial. Please try again.');
        }
    }
}
