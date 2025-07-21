<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::select('testimonials.*', 'anggotas.nama as anggota_name')
            ->join('anggotas', 'testimonials.anggota_id', '=', 'anggotas.id')
            ->orderBy('testimonials.created_at', 'desc')
            ->get();

        return view('member.testimonial', compact('testimonials'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'testimonial_text' => 'required|string|max:1000',
                'rating' => 'required|integer|between:1,5',
            ]);

            Testimonial::create([
                'anggota_id' => auth()->id(),
                'testimonial_text' => $request->testimonial_text,
                'rating' => $request->rating,
                'is_active' => true, // auto active
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
            $testimonial = Testimonial::where('anggota_id', auth()->id())
                ->findOrFail($id); // hanya bisa hapus testimonial sendiri
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

            return response()->json([
                'success' => true,
                'testimonial' => $testimonial
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
            $testimonial = Testimonial::where('anggota_id', auth()->id())
                ->findOrFail($id); // hanya bisa edit testimonial sendiri

            $request->validate([
                'testimonial_text' => 'required|string|max:1000',
                'rating' => 'required|integer|between:1,5',
            ]);

            $testimonial->update([
                'testimonial_text' => $request->testimonial_text,
                'rating' => $request->rating,
                // is_active tetap sama, tidak bisa diubah user
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
