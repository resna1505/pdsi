<?php

namespace App\Http\Controllers;

use App\Models\MasterIuranAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterIuranController extends Controller
{
    public function index()
    {
        $data = MasterIuranAnggota::all();

        return view('admin.master-iuran', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'jumlah' => 'required',
                'periode' => 'required',
            ]);

            MasterIuranAnggota::create([
                'nama_iuran' => $request->title,
                'jumlah' => $request->jumlah,
                'periode' => $request->periode
            ]);

            return redirect()->back()->with('success', 'Master Iuran added successfully!');
        } catch (\Throwable $e) {
            Log::error('Master Iuran store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Master Iuran. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $data = MasterIuranAnggota::findOrFail($id);
            $data->delete();

            return redirect()->back()->with('success', 'Master Iuran deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Master Iuran delete error: ' . $e->getMessage(), [
                'master_iuran' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Visi Misi. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $article = MasterIuranAnggota::findOrFail($id);

            return response()->json([
                'success' => true,
                'article' => $article,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Master not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $article = MasterIuranAnggota::findOrFail($id);

            $request->validate([
                'title' => 'required',
                'jumlah' => 'required',
                'periode' => 'required',
            ]);

            $article->update([
                'title' => $request->title,
                'jumlah' => $request->jumlah,
                'periode' => $request->periode,
            ]);

            return redirect()->back()->with('success', 'Master Iuran updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Master Iuran update error: ' . $e->getMessage(), [
                'VisiMisi_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Master Iuran. Please try again.');
        }
    }
}
