<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mitra;
use Illuminate\Support\Facades\Log;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::all();
        return view('admin.mitra', compact('mitras'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:50',
            'address' => 'required|string',
            'type' => 'required|string',
            'website' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('mitras', 'public');
            $validated['image'] = $path;
        }

        $mitra = new Mitra();
        $mitra->title = $request->title;
        $mitra->email = $request->email;
        $mitra->telephone = $request->telephone;
        $mitra->address = $request->address;
        $mitra->type = $request->type;
        $mitra->type = $request->type;
        $mitra->website = $request->website;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('mitras', 'public');
            $mitra->image = $path;
        }

        $mitra->save();

        Log::info('Data yang akan disimpan:', $validated);

        return redirect()->back()->with('success', 'Mitra berhasil ditambahkan.');
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
