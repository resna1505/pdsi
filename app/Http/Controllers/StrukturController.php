<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function index()
    {
        $struktur = Struktur::orderBy('created_at', 'desc')->get();
        return view('admin.struktur', compact('struktur'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:500',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/struktur'), $filename);
                $imagePath = $filename;
            }

            Struktur::create([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'image' => $imagePath,
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            return redirect()->back()->with('success', 'Struktur added successfully!');
        } catch (\Throwable $e) {
            Log::error('Struktur store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Struktur. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $struktur = Struktur::findOrFail($id);

            // Delete image file if exists
            if ($struktur->image) {
                $imagePath = public_path('storage/struktur/' . $struktur->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $struktur->delete();

            return redirect()->back()->with('success', 'Struktur deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Struktur delete error: ' . $e->getMessage(), [
                'struktur_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Struktur. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $struktur = Struktur::findOrFail($id);

            return response()->json([
                'success' => true,
                'struktur' => $struktur
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
            $struktur = Struktur::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:500',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $imagePath = $struktur->image;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($struktur->image) {
                    $oldImagePath = public_path('storage/struktur/' . $struktur->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/struktur'), $filename);
                $imagePath = $filename;
            }

            $struktur->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'image' => $imagePath,
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            return redirect()->back()->with('success', 'Struktur updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Struktur update error: ' . $e->getMessage(), [
                'struktur_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Struktur. Please try again.');
        }
    }

    public function toggleStatus($id)
    {
        try {
            $struktur = Struktur::findOrFail($id);
            $struktur->update([
                'is_active' => !$struktur->is_active
            ]);

            return redirect()->back()->with('success', 'Struktur status updated successfully!');
        } catch (\Throwable $e) {
            Log::error('Struktur toggle status error: ' . $e->getMessage(), [
                'struktur_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Struktur status. Please try again.');
        }
    }
}
