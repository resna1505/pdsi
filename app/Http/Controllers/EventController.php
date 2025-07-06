<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        return view('member.apps-calendar');
    }

    public function getEvents(): JsonResponse
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'description' => $event->description,
                'location' => $event->location,
                'className' => $event->category,
                'allDay' => $event->all_day,
                'extendedProps' => [
                    'category' => $event->category,
                    'description' => $event->description,
                    'location' => $event->location,
                    'start_time' => $event->start_time ? $event->start_time->format('H:i') : null,
                    'end_time' => $event->end_time ? $event->end_time->format('H:i') : null,
                ]
            ];
        });

        return response()->json($events);
    }

    public function getUpcomingEvents(): JsonResponse
    {
        $upcomingEvents = Event::where('start_date', '>=', Carbon::today())
            ->orderBy('start_date')
            ->orderBy('start_time')
            ->take(10)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'date' => $event->formatted_start_date,
                    'time' => $event->formatted_time,
                    'category' => $event->category,
                    'location' => $event->location
                ];
            });

        return response()->json($upcomingEvents);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'all_day' => 'boolean'
        ]);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'category' => $request->category,
            'all_day' => $request->all_day ?? false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'event' => $event
        ]);
    }

    public function show(Event $event): JsonResponse
    {
        return response()->json([
            'id' => $event->id,
            'title' => $event->title,
            'description' => $event->description,
            'start_date' => $event->start_date->format('Y-m-d'),
            'start_time' => $event->start_time ? $event->start_time->format('H:i') : null,
            'end_time' => $event->end_time ? $event->end_time->format('H:i') : null,
            'location' => $event->location,
            'category' => $event->category,
            'all_day' => $event->all_day,
            'formatted_date' => $event->formatted_start_date,
            'formatted_time' => $event->formatted_time
        ]);
    }

    public function update(Request $request, Event $event): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'all_day' => 'boolean'
        ]);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'category' => $request->category,
            'all_day' => $request->all_day ?? false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'event' => $event
        ]);
    }

    public function destroy(Event $event): JsonResponse
    {
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully'
        ]);
    }

    public function updateEventDate(Request $request, Event $event): JsonResponse
    {
        $request->validate([
            'start_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i'
        ]);

        $event->update([
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event date updated successfully'
        ]);
    }
}
