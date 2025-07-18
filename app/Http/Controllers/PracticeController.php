<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PracticeController extends Controller
{
    /**
     * Store a newly created practice in storage.
     */
    public function store(Request $request)
    {
        try {
            $anggota = Anggota::where('user_id', Auth::id())->first();

            if (!$anggota) {
                return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
            }

            $request->validate([
                'institution_name' => 'required|string|max:255',
                'practice_type' => 'required|in:hospital,clinic,private,government,other',
                'position' => 'nullable|string|max:255',
                'department' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive,terminated',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'city' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'license_number' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'schedule' => 'nullable|array',
                'schedule.*' => 'nullable|string|max:50'
            ]);

            $data = $request->all();
            $data['anggota_id'] = $anggota->id;

            // Clean up empty schedule values
            if (isset($data['schedule'])) {
                $data['schedule'] = array_filter($data['schedule'], function ($value) {
                    return !empty(trim($value));
                });
            }

            Practice::create($data);

            return redirect()->back()->with('success', 'Practice added successfully!');
        } catch (\Exception $e) {
            Log::error('Practice store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add practice. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified practice.
     */
    public function edit($id)
    {
        try {
            $anggota = Anggota::where('user_id', Auth::id())->first();

            if (!$anggota) {
                return response()->json(['success' => false, 'message' => 'Data anggota tidak ditemukan']);
            }

            $practice = Practice::where('id', $id)
                ->where('anggota_id', $anggota->id)
                ->first();

            if (!$practice) {
                return response()->json(['success' => false, 'message' => 'Practice not found']);
            }

            return response()->json([
                'success' => true,
                'practice' => $practice
            ]);
        } catch (\Exception $e) {
            Log::error('Practice edit error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error loading practice data']);
        }
    }

    /**
     * Update the specified practice in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $anggota = Anggota::where('user_id', Auth::id())->first();

            if (!$anggota) {
                return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
            }

            $practice = Practice::where('id', $id)
                ->where('anggota_id', $anggota->id)
                ->first();

            if (!$practice) {
                return redirect()->back()->with('error', 'Practice not found');
            }

            $request->validate([
                'institution_name' => 'required|string|max:255',
                'practice_type' => 'required|in:hospital,clinic,private,government,other',
                'position' => 'nullable|string|max:255',
                'department' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive,terminated',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'city' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'license_number' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'schedule' => 'nullable|array',
                'schedule.*' => 'nullable|string|max:50'
            ]);

            $data = $request->all();

            // Clean up empty schedule values
            if (isset($data['schedule'])) {
                $data['schedule'] = array_filter($data['schedule'], function ($value) {
                    return !empty(trim($value));
                });
            }

            $practice->update($data);

            return redirect()->back()->with('success', 'Practice updated successfully!');
        } catch (\Exception $e) {
            Log::error('Practice update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update practice. Please try again.');
        }
    }

    /**
     * Remove the specified practice from storage.
     */
    public function destroy($id)
    {
        try {
            $anggota = Anggota::where('user_id', Auth::id())->first();

            if (!$anggota) {
                return response()->json(['success' => false, 'message' => 'Data anggota tidak ditemukan']);
            }

            $practice = Practice::where('id', $id)
                ->where('anggota_id', $anggota->id)
                ->first();

            if (!$practice) {
                return response()->json(['success' => false, 'message' => 'Practice not found']);
            }

            $practice->delete();

            return response()->json(['success' => true, 'message' => 'Practice deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Practice delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error deleting practice']);
        }
    }
}
