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
                <div class="p-6 flex space-x-4 items-center">
                    @if($event->image)
                        <div class="w-24 h-24 flex-shrink-0">
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->title }}" 
                                 class="w-full h-full object-cover rounded-lg">
                        </div>
                    @endif
                    <div class="flex-grow">
                        <h3 class="text-lg font-medium">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $event->description }}</p>
                        <p class="text-sm text-gray-600">Event Date: {{ $event->event_date->format('F j, Y') }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <form method="POST" action="{{ route('events.restore', $event->id) }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-black transition"
                                    title="Restore">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('events.force-delete', $event->id) }}" 
                              onsubmit="return confirm('Are you sure you want to permanently delete this event? This action cannot be undone.');"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-black transition"
                                    title="Delete Permanently">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
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
