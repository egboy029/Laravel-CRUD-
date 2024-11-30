<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminEventController extends Controller
{
    public function dashboard()
    {
        // Get total counts
        $totalEvents = Event::count();
        $trashedEvents = Event::onlyTrashed()->count();
        $activeEvents = Event::whereNull('deleted_at')->count();
        $totalUsers = User::where('role', 'staff')->count();

        // Get events by user
        $eventsByUser = DB::table('events')
            ->join('users', 'events.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('count(*) as total_events'))
            ->groupBy('users.id', 'users.name')
            ->get();

        // Get recent activities
        $recentActivities = Event::with('user')
            ->withTrashed()
            ->latest()
            ->take(5)
            ->get();

        // Get monthly event statistics for PostgreSQL
        $monthlyStats = Event::select(
            DB::raw('EXTRACT(MONTH FROM created_at) as month'),
            DB::raw('EXTRACT(YEAR FROM created_at) as year'),
            DB::raw('count(*) as total')
        )
        ->groupBy(DB::raw('EXTRACT(YEAR FROM created_at)'), DB::raw('EXTRACT(MONTH FROM created_at)'))
        ->orderBy(DB::raw('EXTRACT(YEAR FROM created_at)'), 'desc')
        ->orderBy(DB::raw('EXTRACT(MONTH FROM created_at)'), 'desc')
        ->take(6)
        ->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'trashedEvents',
            'activeEvents',
            'totalUsers',
            'eventsByUser',
            'recentActivities',
            'monthlyStats'
        ));
    }

    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function store(EventRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('image')) {
                // Create the events directory if it doesn't exist
                Storage::disk('public')->makeDirectory('events');
                
                // Store the file directly in the public disk under events directory
                $path = $request->file('image')->store('events', 'public');
                $validated['image'] = $path;
            }

            // Add user_id to validated data
            $validated['user_id'] = auth()->id();

            Event::create($validated);

            return redirect()->route('admin.events.index')->with('status', 'Event created successfully!');
        } catch (Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create event. Please try again.');
        }
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'image' => 'nullable|image|max:20480', // 20MB max
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('status', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('status', 'Event moved to trash!');
    }

    public function trash()
    {
        $trashedEvents = Event::onlyTrashed()->get();
        return view('admin.events.trash', compact('trashedEvents'));
    }

    public function restore($id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->restore();
        return redirect()->route('events.trash')->with('status', 'Event restored successfully!');
    }

    public function forceDelete($id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->forceDelete();
        return redirect()->route('events.trash')->with('status', 'Event permanently deleted!');
    }
}
