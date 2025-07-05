<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityPhoto;
use App\Models\CategoryMitra;
use App\Models\LearningMethod;
use App\Models\Mitra;
use App\Models\Video;
use App\Models\VideoLearningMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        $articles = Video::with('learningMethods')->get();

        $activity = DB::table('activities as act')
            ->join('activity_photos as ap', 'ap.activity_id', '=', 'act.id')
            ->select('act.id', 'act.title', 'act.description', 'act.created_at', 'act.location', 'ap.image')
            ->get();

        $learning = DB::table('video_learning_method as vlm')
            ->join('learning_methods as lm', 'lm.id', '=', 'vlm.learning_method_id')
            ->select('vlm.progress', 'lm.name', 'lm.created_at', 'vlm.id')
            ->get();

        return view('admin.about', compact('articles', 'activity', 'learning'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'url' => 'required'
            ]);

            Video::create([
                'title' => $request->title,
                'url' => $request->url,
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

    public function storegaleri(Request $request)
    {
        try {
            $request->validate([
                'image' => 'nullable|image',
                'location' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);


            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/galeri'), $filename);
                $imagePath = $filename;
            }

            $activity = Activity::create([
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location
            ]);

            ActivityPhoto::create([
                'activity_id' => $activity->id,
                'image' => $imagePath
            ]);

            return redirect()->back()->with('success', 'Article added successfully!');
        } catch (\Throwable $e) {
            Log::error('Article store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add article. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $activity = Activity::findOrFail($id);
            // $activityphoto = ActivityPhoto::where('activity_id', $id)->first();

            // if ($activityphoto->image) {
            //     Storage::disk('public/galeri')->delete($activityphoto->image);
            // }

            // dd($id);
            $activity->delete();
            // $activityphoto->delete();

            return redirect()->back()->with('success', 'Galeri deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Galeri delete error: ' . $e->getMessage(), [
                'article_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Galeri. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $article = Video::findOrFail($id);

            return response()->json([
                'success' => true,
                'article' => $article
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found'
            ], 404);
        }
    }

    public function editgaleri($id)
    {
        try {
            $article = DB::table('activities as act')
                ->join('activity_photos as ap', 'ap.activity_id', '=', 'act.id')
                ->select('act.title', 'act.description', 'act.location', 'act.created_at', 'act.id', 'ap.image')
                ->where('act.id', $id)
                ->first();

            return response()->json([
                'success' => true,
                'article' => $article,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found'
            ], 404);
        }
    }

    public function editmetode($id)
    {
        try {
            // $article = VideoLearningMethod::where('id', $id)->first();
            $article = DB::table('video_learning_method as vlm')
                ->join('learning_methods as lm', 'lm.id', '=', 'vlm.learning_method_id')
                ->select('vlm.progress', 'lm.name', 'lm.created_at', 'vlm.id')
                ->where('vlm.id', $id)
                ->first();

            return response()->json([
                'success' => true,
                'article' => $article
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found'
            ], 404);
        }
    }

    // PERBAIKAN 1: Tambahkan method convertToEmbedUrl yang hilang
    private function convertToEmbedUrl($url)
    {
        // Jika sudah embed URL, return as is
        if (strpos($url, 'embed') !== false) {
            return $url;
        }

        // Convert regular YouTube URL to embed URL
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // If not a YouTube URL, return as is
        return $url;
    }

    public function update(Request $request, $id)
    {
        try {
            $article = Video::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'url' => 'required', // PERBAIKAN 2: Hilangkan validasi 'url' karena bisa embed URL
            ]);

            // Ubah URL menjadi embed YouTube
            $embedUrl = $this->convertToEmbedUrl($request->url);

            $article->update([
                'title' => $request->title,
                'url' => $embedUrl,
            ]);

            return redirect()->back()->with('success', 'Video updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Video update error: ' . $e->getMessage(), [
                'Video_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Video. Please try again.');
        }
    }

    public function updategaleri(Request $request, $id)
    {
        try {
            $activity = Activity::where('id', $id)->first();
            // PERBAIKAN 3: Fix query ActivityPhoto
            $activityphoto = ActivityPhoto::where('activity_id', $id)->first(); // Ubah dari 'id' ke 'activity_id'

            $request->validate([
                'image' => 'nullable|image',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'location' => 'required|string|max:100',
            ]);

            // PERBAIKAN 4: Fix image path logic
            $imagePath = $activityphoto ? $activityphoto->image : null;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($activityphoto && $activityphoto->image) {
                    $oldImagePath = public_path('storage/galeri/' . $activityphoto->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/galeri'), $filename);
                $imagePath = $filename;
            }

            $activity->update([
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
            ]);

            if ($activityphoto) {
                $activityphoto->update([
                    'image' => $imagePath
                ]);
            }

            return redirect()->back()->with('success', 'Galeri updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Galeri update error: ' . $e->getMessage(), [
                'Galeri_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Galeri. Please try again.');
        }
    }

    public function updatemetode(Request $request, $id)
    {
        try {
            $article = VideoLearningMethod::where('learning_method_id', $id)->first();
            $learning = LearningMethod::where('id', $id)->first();

            $request->validate([
                'name' => 'required|string|max:255',
                'progress' => 'required',
            ]);

            $article->update([
                'progress' => $request->progress,
            ]);

            $learning->update([
                'name' => $request->name,
            ]);

            return redirect()->back()->with('success', 'Video updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Video update error: ' . $e->getMessage(), [
                'Video_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Video. Please try again.');
        }
    }
}
