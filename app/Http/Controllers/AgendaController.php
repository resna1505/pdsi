<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\CategoryAgenda;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function index()
    {
        $articles = Agenda::orderBy('created_at', 'desc')->get();
        $categories = CategoryAgenda::with('agenda')->get();

        return view('admin.agenda', compact('articles', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'nullable|image',
                'category_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'author' => 'required|string|max:100',
                'dimulai' => 'required|string',
                'berakhir' => 'required|string',
                'location' => 'nullable|string|max:191',
            ]);

            // Convert format tanggal dari d.m.Y H:i ke DateTime object
            $dimulaiDateTime = \DateTime::createFromFormat('d.m.Y H:i', $request->dimulai);
            $berakhirDateTime = \DateTime::createFromFormat('d.m.Y H:i', $request->berakhir);

            if ($dimulaiDateTime === false || $berakhirDateTime === false) {
                throw new \Exception('Invalid date format');
            }

            // Validasi tanggal berakhir harus setelah dimulai
            if ($berakhirDateTime <= $dimulaiDateTime) {
                return redirect()->back()->with('error', 'Tanggal berakhir harus setelah tanggal dimulai!');
            }

            // Format untuk agenda table (datetime)
            $dimulai = $dimulaiDateTime->format('Y-m-d H:i:s');
            $berakhir = $berakhirDateTime->format('Y-m-d H:i:s');

            // Format untuk event table (terpisah date dan time)
            $start_date = $dimulaiDateTime->format('Y-m-d');
            $start_time = $dimulaiDateTime->format('H:i:s');
            $end_date = $berakhirDateTime->format('Y-m-d');
            $end_time = $berakhirDateTime->format('H:i:s');

            // Hitung all_day berdasarkan jarak hari
            $diff = $dimulaiDateTime->diff($berakhirDateTime);
            $all_day = $diff->days > 0 ? $diff->days : 0; // Jika sama hari = 0, jika beda 1 hari = 1, dst

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/articles'), $filename);
                $imagePath = $filename;
            }

            // Insert ke table agenda
            $agenda = Agenda::create([
                'attachment' => $imagePath,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'author' => $request->author,
                'dimulai' => $dimulai,
                'berakhir' => $berakhir
            ]);

            // Insert ke table event
            Event::create([
                'agenda_id' => $agenda->id, // Link ke agenda
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'location' => $request->location ?? '',
                'category' => 'bg-info-subtle',
                'all_day' => $all_day,
            ]);

            return redirect()->back()->with('success', 'Agenda added successfully!');
        } catch (\Throwable $e) {
            Log::error('Agenda store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Agenda. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $article = Agenda::findOrFail($id);

            $request->validate([
                'image' => 'nullable|image',
                'category_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'author' => 'required|string|max:100',
                'dimulai' => 'required|string',
                'berakhir' => 'required|string',
                'location' => 'nullable|string|max:191',
            ]);

            // Convert format tanggal dari d.m.Y H:i ke DateTime object
            $dimulaiDateTime = \DateTime::createFromFormat('d.m.Y H:i', $request->dimulai);
            $berakhirDateTime = \DateTime::createFromFormat('d.m.Y H:i', $request->berakhir);

            if ($dimulaiDateTime === false || $berakhirDateTime === false) {
                throw new \Exception('Invalid date format');
            }

            // Validasi tanggal berakhir harus setelah dimulai
            if ($berakhirDateTime <= $dimulaiDateTime) {
                return redirect()->back()->with('error', 'Tanggal berakhir harus setelah tanggal dimulai!');
            }

            // Format untuk agenda table (datetime)
            $dimulai = $dimulaiDateTime->format('Y-m-d H:i:s');
            $berakhir = $berakhirDateTime->format('Y-m-d H:i:s');

            // Format untuk event table (terpisah date dan time)
            $start_date = $dimulaiDateTime->format('Y-m-d');
            $start_time = $dimulaiDateTime->format('H:i:s');
            $end_date = $berakhirDateTime->format('Y-m-d');
            $end_time = $berakhirDateTime->format('H:i:s');

            // Hitung all_day berdasarkan jarak hari
            $diff = $dimulaiDateTime->diff($berakhirDateTime);
            $all_day = $diff->days > 0 ? $diff->days : 0;

            // Handle image upload
            $imagePath = $article->attachment;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($article->attachment && file_exists(public_path('storage/articles/' . $article->attachment))) {
                    unlink(public_path('storage/articles/' . $article->attachment));
                }

                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/articles'), $filename);
                $imagePath = $filename;
            }

            // Update agenda
            $article->update([
                'attachment' => $imagePath,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'author' => $request->author,
                'dimulai' => $dimulai,
                'berakhir' => $berakhir
            ]);

            // Update atau create event
            $event = Event::where('agenda_id', $article->id)->first();

            if ($event) {
                // Update existing event
                $event->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'location' => $request->location ?? '',
                    'category' => 'bg-info-subtle',
                    'all_day' => $all_day
                ]);
            } else {
                // Create new event if not exists
                Event::create([
                    'agenda_id' => $article->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'location' => $request->location,
                    'category' => 'bg-info-subtle',
                    'all_day' => $all_day
                ]);
            }

            return redirect()->back()->with('success', 'Agenda updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Agenda update error: ' . $e->getMessage(), [
                'Agenda_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Agenda. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $article = Agenda::findOrFail($id);

            // Hapus file gambar jika ada
            if ($article->attachment && file_exists(public_path('storage/articles/' . $article->attachment))) {
                unlink(public_path('storage/articles/' . $article->attachment));
            }

            // Hapus event yang terkait
            Event::where('agenda_id', $article->id)->delete();

            // Hapus agenda
            $article->delete();

            return redirect()->back()->with('success', 'Agenda deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Agenda delete error: ' . $e->getMessage(), [
                'Agenda_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Agenda. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $article = Agenda::findOrFail($id);
            $categories = CategoryAgenda::all();

            // Get related event
            $event = Event::where('agenda_id', $article->id)->first();

            // Format tanggal untuk ditampilkan di form
            $articleData = $article->toArray();

            // Convert datetime ke format yang dibutuhkan flatpickr (d.m.Y H:i)
            if ($article->dimulai) {
                $articleData['dimulai'] = $article->dimulai->format('d.m.Y H:i');
            }
            if ($article->berakhir) {
                $articleData['berakhir'] = $article->berakhir->format('d.m.Y H:i');
            }

            // Tambahkan location dari event
            if ($event) {
                $articleData['location'] = $event->location;
                $articleData['all_day'] = $event->all_day;
            }

            return response()->json([
                'success' => true,
                'article' => $articleData,
                'categories' => $categories
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda not found'
            ], 404);
        }
    }
}
