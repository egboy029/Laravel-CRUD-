<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Event</h2>

        <form method="POST" action="{{ route('events.update', $event) }}" class="mt-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <x-label for="title" value="Event Title" />
                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $event->title }}" required />
                </div>
                <div>
                    <x-label for="description" value="Description" />
                    <textarea id="description" class="block mt-1 w-full" name="description" rows="4">{{ $event->description }}</textarea>
                </div>
                <div>
                    <x-label for="event_date" value="Event Date" />
                    <x-input id="event_date" class="block mt-1 w-full" type="date" name="event_date" value="{{ $event->event_date->format('Y-m-d') }}" required />
                </div>
                <div>
                    <x-button>Update Event</x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout> 