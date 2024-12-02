<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Trashed Events</h2>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Back to Events
                    </a>
                </div>
            </div>

            @if (session('status'))
                <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-6 bg-white overflow-hidden shadow-xl sm:rounded-lg p-1">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="w-5/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="w-2/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Details</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Date</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deleted</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($trashedEvents as $event)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($event->image)
                                                <div class="h-20 w-20 overflow-hidden rounded-lg cursor-pointer"
                                                     @click="$dispatch('show-modal', { 
                                                        url: '{{ asset('storage/' . $event->image) }}',
                                                        alt: '{{ $event->title }}'
                                                     })">
                                                    <img src="{{ asset('storage/' . $event->image) }}" 
                                                         alt="{{ $event->title }}" 
                                                         class="h-full w-full object-cover hover:scale-110 transition-transform duration-300">
                                                </div>
                                            @else
                                                <div class="h-20 w-20 rounded-lg bg-gray-100 flex items-center justify-center">
                                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($event->description, 100) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $event->event_date->format('F j, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $event->event_date->format('g:i A') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $event->deleted_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $event->deleted_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <form method="POST" action="{{ route('events.restore', $event->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-green-600 transition"
                                                            title="Restore Event">
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
                                                            class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-red-600 transition"
                                                            title="Delete Permanently">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-3">
                                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <p class="text-gray-500 text-lg font-medium">No trashed events found</p>
                                                <p class="text-gray-400 text-sm">Deleted events will appear here</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
             class="fixed inset-0 z-50 overflow-y-auto"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div @click.away="showModal = false" 
                     class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <img :src="imageUrl" :alt="imageAlt" class="w-full h-auto">
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" 
                                @click="showModal = false"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
