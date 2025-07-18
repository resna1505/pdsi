<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('created_at', 'desc')->get();
        return view('admin.slider', compact('sliders'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'sub_title' => 'required|string|max:500',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title_banner' => 'required|string|max:255',
                'sub_title_banner' => 'required|string|max:500',
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/sliders'), $filename);
                $imagePath = $filename;
            }

            Slider::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'image' => $imagePath,
                'title_banner' => $request->title_banner,
                'sub_title_banner' => $request->sub_title_banner,
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            return redirect()->back()->with('success', 'Slider added successfully!');
        } catch (\Throwable $e) {
            Log::error('Slider store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Slider. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);

            // Delete image file if exists
            if ($slider->image) {
                $imagePath = public_path('storage/sliders/' . $slider->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $slider->delete();

            return redirect()->back()->with('success', 'Slider deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Slider delete error: ' . $e->getMessage(), [
                'slider_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Slider. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $slider = Slider::findOrFail($id);

            return response()->json([
                'success' => true,
                'slider' => $slider
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
            $slider = Slider::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'sub_title' => 'required|string|max:500',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title_banner' => 'required|string|max:255',
                'sub_title_banner' => 'required|string|max:500',
            ]);

            $imagePath = $slider->image;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($slider->image) {
                    $oldImagePath = public_path('storage/sliders/' . $slider->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/sliders'), $filename);
                $imagePath = $filename;
            }

            $slider->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'image' => $imagePath,
                'title_banner' => $request->title_banner,
                'sub_title_banner' => $request->sub_title_banner,
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            return redirect()->back()->with('success', 'Slider updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Slider update error: ' . $e->getMessage(), [
                'slider_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Slider. Please try again.');
        }
    }

    public function toggleStatus($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->update([
                'is_active' => !$slider->is_active
            ]);

            return redirect()->back()->with('success', 'Slider status updated successfully!');
        } catch (\Throwable $e) {
            Log::error('Slider toggle status error: ' . $e->getMessage(), [
                'slider_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Slider status. Please try again.');
        }
    }
}
