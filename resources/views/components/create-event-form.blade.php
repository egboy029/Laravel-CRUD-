<form method="POST" action="{{ route('events.store') }}" class="mt-6">
    @csrf
    <div class="grid grid-cols-1 gap-6">
        <div>
            <x-label for="title" value="Event Title" />
            <x-input id="title" class="block mt-1 w-full" type="text" name="title" required />
        </div>
        <div>
            <x-label for="description" value="Description" />
            <textarea id="description" class="block mt-1 w-full" name="description" rows="4"></textarea>
        </div>
        <div>
            <x-label for="event_date" value="Event Date" />
            <x-input id="event_date" class="block mt-1 w-full" type="date" name="event_date" required />
        </div>
        <div>
            <x-button>Create Event</x-button>
        </div>
    </div>
</form> 