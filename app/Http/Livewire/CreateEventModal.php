<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateEventModal extends Component
{
    public $showModal = false;
    public $title;
    public $description;
    public $event_date;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'event_date' => 'required|date|after_or_equal:today',
        ]);

        Event::create([
            'title' => $this->title,
            'description' => $this->description,
            'event_date' => $this->event_date,
            'user_id' => auth()->id(),
        ]);

        $this->closeModal();
        $this->reset();
        return redirect()->route('staff.home')->with('status', 'Event created successfully.');
    }

    public function render()
    {
        return view('livewire.create-event-modal');
    }
} 