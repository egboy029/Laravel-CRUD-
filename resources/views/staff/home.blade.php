<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Events</h2>
            <a href="{{ route('events.trash') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                View Trash
            </a>
        </div>

        @if (session('status'))
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('status') }}
            </div>
        @endif

        @include('components.error-message')

        <!-- Event List -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($events as $event)
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $event->description }}</p>
                        <p class="text-sm text-gray-600">{{ $event->event_date->format('F j, Y') }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Are you sure you want to move this event to trash?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Move to Trash
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Create Event Form -->
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
    </div>
</x-app-layout>
