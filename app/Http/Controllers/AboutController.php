<?php

namespace App\Http\Controllers;

use App\Models\Activity;
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

        $activity = Activity::with('photos')->get();

        $learning = DB::table('video_learning_method as vlm')
            ->join('learning_methods as lm', 'lm.id', '=', 'vlm.learning_method_id')
            ->select('vlm.progress', 'lm.name', 'lm.created_at', 'vlm.id')
            ->get();
        $categories = CategoryMitra::all();

        return view('admin.about', compact('articles', 'categories', 'learning'));
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

    // public function destroy($id)
    // {
    //     try {
    //         $article = Mitra::findOrFail($id);

    //         if ($article->attachment) {
    //             Storage::disk('public')->delete($article->attachment);
    //         }

    //         $article->delete();

    //         return redirect()->back()->with('success', 'Mitra deleted successfully!');
    //     } catch (\Throwable $e) {
    //         Log::error('Mitra delete error: ' . $e->getMessage(), [
    //             'article_id' => $id,
    //             'file' => $e->getFile(),
    //             'line' => $e->getLine()
    //         ]);

    //         return redirect()->back()->with('error', 'Failed to delete mitra. Please try again.');
    //     }
    // }

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

    // // 3. Method update di ArticleController
    public function update(Request $request, $id)
    {
        try {
            $article = Video::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'url' => 'required|url',
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
