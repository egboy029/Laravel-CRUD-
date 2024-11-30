<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->id())->get();
        return view('staff.home', compact('events'));
    }

    public function store(EventRequest $request)
    {
        try {
            $data = $request->validated();
            
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:20480'
                ]);
                
                // Create the events directory if it doesn't exist
                Storage::disk('public')->makeDirectory('events');
                
                // Store the file directly in the public disk under events directory
                $path = $request->file('image')->store('events', 'public');
                $data['image'] = $path;
            }
            
            $data['user_id'] = auth()->id();
            Event::create($data);
            
            return redirect()->route('staff.home')
                ->with('status', 'Event created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create event. Please try again.');
        }
    }

    public function edit(Event $event)
    {
        if (Gate::denies('update', $event)) {
            abort(403);
        }

        return view('staff.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        try {
            if (Gate::denies('update', $event)) {
                abort(403, 'Unauthorized action.');
            }

            $data = $request->validated();
            
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:20480'
                ]);

                if ($event->image) {
                    Storage::delete('public/' . $event->image);
                }
                
                // Create the events directory if it doesn't exist
                Storage::disk('public')->makeDirectory('events');
                
                // Store the file directly in the public disk under events directory
                $path = $request->file('image')->store('events', 'public');
                $data['image'] = $path;
            }
            
            $event->update($data);
            
            return redirect()->route('staff.home')
                ->with('status', 'Event updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating event: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update event. Please try again.');
        }
    }

    public function destroy(Event $event)
    {
        try {
            if (Gate::denies('delete', $event)) {
                abort(403, 'Unauthorized action.');
            }

            // Optionally handle image when moving to trash
            // Uncomment if you want to delete image when moving to trash
            /*
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
                $event->update(['image' => null]);
            }
            */

            $event->delete();
            
            return redirect()->route('staff.home')
                ->with('status', 'Event moved to trash.');
        } catch (Exception $e) {
            Log::error('Error moving event to trash: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to move event to trash. Please try again.');
        }
    }

    public function trash()
    {
        $trashedEvents = Event::onlyTrashed()
            ->where('user_id', auth()->id())
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);
        
        return view('staff.trash', compact('trashedEvents'));
    }

    public function restore($id)
    {
        try {
            $event = Event::onlyTrashed()->findOrFail($id);
            
            if ($event->user_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }

            $event->restore();
            
            return redirect()->route('events.trash')
                ->with('status', 'Event restored successfully.');
        } catch (Exception $e) {
            Log::error('Error restoring event: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to restore event. Please try again.');
        }
    }

    public function forceDelete($id)
    {
        try {
            $event = Event::onlyTrashed()->findOrFail($id);
            
            if (Gate::denies('forceDelete', $event)) {
                abort(403, 'Unauthorized action.');
            }

            // Delete the image file if it exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $event->forceDelete();
            
            return redirect()->route('events.trash')
                ->with('status', 'Event permanently deleted.');
        } catch (Exception $e) {
            Log::error('Error permanently deleting event: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to permanently delete event. Please try again.');
        }
    }
}