<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recently Deleted Events</h2>
            <a href="{{ route('staff.home') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Back to Events
            </a>
        </div>

        @if (session('status'))
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('status') }}
            </div>
        @endif

        @include('components.error-message')

        <!-- Trashed Event List -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @forelse ($trashedEvents as $event)
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $event->description }}</p>
                        <p class="text-sm text-gray-600">Event Date: {{ $event->event_date->format('F j, Y') }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <form method="POST" action="{{ route('events.restore', $event->id) }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Restore
                            </button>
                        </form>
                        <form method="POST" action="{{ route('events.force-delete', $event->id) }}" onsubmit="return confirm('Are you sure you want to permanently delete this event? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete Permanently
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    No deleted events found.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
