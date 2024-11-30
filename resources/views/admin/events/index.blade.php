<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Events</h2>
                <div class="flex space-x-4">
                    @include('admin.events.partials.create-event-modal')
                    <a href="{{ route('events.trash') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        View Trash
                    </a>
                </div>
            </div>

            @if (session('status'))
                <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            @include('components.error-message')

            <!-- Event List -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg transition duration-500 hover:shadow-2xl hover:scale-[1.015]">
                        @if($event->image)
                            <div class="h-48 overflow-hidden cursor-pointer"
                                 @click="$dispatch('show-modal', { 
                                    url: '{{ asset('storage/' . $event->image) }}',
                                    alt: '{{ $event->title }}'
                                 })">
                                <img src="{{ asset('storage/' . $event->image) }}" 
                                     alt="{{ $event->title }}" 
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                        @endif
                        <div class="main p-4">
                            <h3 class="text-lg font-medium text-gray-800">{{ $event->title }}</h3>
                            <hr class="border-gray-200 my-2">
                            <p class="text-gray-600 text-sm">{{ $event->description }}</p>
                            
                            <div class="tokenInfo flex justify-between items-center mt-4">
                                <div class="duration flex items-center text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="ml-2">{{ $event->event_date->format('F j, Y') }}</span>
                                </div>
                            </div>

                            <div class="flex space-x-2 mt-4">
                                <a href="{{ route('admin.events.edit', $event) }}" 
                                   class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-black transition"
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}" 
                                      onsubmit="return confirm('Are you sure you want to move this event to trash?');" 
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-black transition"
                                            title="Move to Trash">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Image Modal -->
        <div x-data="{ 
            showModal: false,
            imageUrl: '',
            imageAlt: ''
        }"
        @show-modal.window="
            showModal = true;
            imageUrl = $event.detail.url;
            imageAlt = $event.detail.alt;
        ">
            <div x-show="showModal" 
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
                 @click="showModal = false"
                 @keydown.escape.window="showModal = false"
                 style="display: none;">
                <div class="relative">
                    <img :src="imageUrl" 
                         class="max-w-none w-auto h-auto"
                         @click.stop>
                    <button @click="showModal = false" 
                            class="absolute top-4 right-4 text-white hover:text-gray-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
