<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EducationController extends Controller
{
    /**
     * Store a newly created education in storage.
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
                'degree_type' => 'required|string|max:255',
                'major' => 'nullable|string|max:255',
                'start_year' => 'required|integer|min:1980|max:2030',
                'end_year' => 'nullable|integer|min:1980|max:2030|gte:start_year',
                'status' => 'required|in:completed,progress,dropped',
                'gpa' => 'nullable|numeric|min:0|max:4',
                'graduation_date' => 'nullable|date',
                'certificate_number' => 'nullable|string|max:255',
                'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string'
            ]);

            $data = $request->all();
            $data['anggota_id'] = $anggota->id;

            // Handle file upload
            if ($request->hasFile('institution_logo')) {
                $file = $request->file('institution_logo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/logos'), $filename);
                $data['institution_logo'] = $filename;
            }

            Education::create($data);

            return redirect()->back()->with('success', 'Education added successfully!');
        } catch (\Exception $e) {
            Log::error('Education store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add education. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified education.
     */
    public function edit($id)
    {
        try {
            $anggota = Anggota::where('user_id', Auth::id())->first();

            if (!$anggota) {
                return response()->json(['success' => false, 'message' => 'Data anggota tidak ditemukan']);
            }

            $education = Education::where('id', $id)
                ->where('anggota_id', $anggota->id)
                ->first();

            if (!$education) {
                return response()->json(['success' => false, 'message' => 'Education not found']);
            }

            return response()->json([
                'success' => true,
                'education' => $education
            ]);
        } catch (\Exception $e) {
            Log::error('Education edit error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error loading education data']);
        }
    }

    /**
     * Update the specified education in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $anggota = Anggota::where('user_id', Auth::id())->first();

            if (!$anggota) {
                return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
            }

            $education = Education::where('id', $id)
                ->where('anggota_id', $anggota->id)
                ->first();

            if (!$education) {
                return redirect()->back()->with('error', 'Education not found');
            }

            $request->validate([
                'institution_name' => 'required|string|max:255',
                'degree_type' => 'required|string|max:255',
                'major' => 'nullable|string|max:255',
                'start_year' => 'required|integer|min:1980|max:2030',
                'end_year' => 'nullable|integer|min:1980|max:2030|gte:start_year',
                'status' => 'required|in:completed,progress,dropped',
                'gpa' => 'nullable|numeric|min:0|max:4',
                'graduation_date' => 'nullable|date',
                'certificate_number' => 'nullable|string|max:255',
                'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string'
            ]);

            $data = $request->except(['institution_logo']);

            // Handle file upload
            if ($request->hasFile('institution_logo')) {
                // Delete old logo if exists
                if ($education->institution_logo) {
                    $oldLogoPath = public_path('storage/logos/' . $education->institution_logo);
                    if (file_exists($oldLogoPath)) {
                        unlink($oldLogoPath);
                    }
                }

                $file = $request->file('institution_logo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/logos'), $filename);
                $data['institution_logo'] = $filename;
            }

            $education->update($data);

            return redirect()->back()->with('success', 'Education updated successfully!');
        } catch (\Exception $e) {
            Log::error('Education update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update education. Please try again.');
        }
    }

    /**
     * Remove the specified education from storage.
     */
    public function destroy($id)
    {
        try {
            $anggota = Anggota::where('user_id', Auth::id())->first();

            if (!$anggota) {
                return response()->json(['success' => false, 'message' => 'Data anggota tidak ditemukan']);
            }

            $education = Education::where('id', $id)
                ->where('anggota_id', $anggota->id)
                ->first();

            if (!$education) {
                return response()->json(['success' => false, 'message' => 'Education not found']);
            }

            // Delete logo file if exists
            if ($education->institution_logo) {
                $logoPath = public_path('storage/logos/' . $education->institution_logo);
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            $education->delete();

            return response()->json(['success' => true, 'message' => 'Education deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Education delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error deleting education']);
        }
    }
}
