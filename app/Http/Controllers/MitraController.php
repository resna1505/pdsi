<?php

namespace App\Http\Controllers;

use App\Models\CategoryMitra;
use Illuminate\Http\Request;
use App\Models\Mitra;
use Illuminate\Support\Facades\Log;

class MitraController extends Controller
{
    public function index()
    {
        $articles = Mitra::orderBy('created_at', 'desc')->get();
        $categories = CategoryMitra::all();

        // dd($articles);
        return view('admin.mitra', compact('articles', 'categories'));
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'email' => 'required|email',
    //         'telephone' => 'required|string|max:50',
    //         'address' => 'required|string',
    //         'type' => 'required|string',
    //         'website' => 'required|string',
    //         'image' => 'nullable|image|max:2048'
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('mitras', 'public');
    //         $validated['image'] = $path;
    //     }

    //     $mitra = new Mitra();
    //     $mitra->title = $request->title;
    //     $mitra->email = $request->email;
    //     $mitra->telephone = $request->telephone;
    //     $mitra->address = $request->address;
    //     $mitra->type = $request->type;
    //     $mitra->type = $request->type;
    //     $mitra->website = $request->website;

    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('mitras', 'public');
    //         $mitra->image = $path;
    //     }

    //     $mitra->save();

    //     Log::info('Data yang akan disimpan:', $validated);

    //     return redirect()->back()->with('success', 'Mitra berhasil ditambahkan.');
    // }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'email' => 'required|email',
                'telephone' => 'required|string|max:50',
                'address' => 'required|string',
                'website' => 'required|string',
                'image' => 'nullable|image|max:2048'
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->storeAs('public/mitras', $filename);
                $imagePath = $filename;
            }

            Mitra::create([
                'image' => $imagePath,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'address' => $request->address,
                'website' => $request->website,
            ]);

            return redirect()->back()->with('success', 'Mitra added successfully!');
        } catch (\Throwable $e) {
            Log::error('Mitra store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Mitra. Please try again.');
        }
    }

    public function edit($id)
    {
        dd($id);
        $mitra = Mitra::findOrFail($id);
        return view('admin.mitra', compact('mitra'));
    }

    public function update(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);

        $mitra->update([
            'title' => $request->title,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'type' => $request->type,
            'website' => $request->website,
            // Add other fields as needed
        ]);

        if ($request->hasFile('image')) {
            // Handle image upload
            $imagePath = $request->file('image')->store('mitra_images', 'public');
            $mitra->update(['image' => $imagePath]);
        }

        return redirect()->route('mitra.index')->with('success', 'Mitra updated successfully');
    }

    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->delete();

        return response()->json(['message' => 'Mitra berhasil dihapus!']);
    }
}
