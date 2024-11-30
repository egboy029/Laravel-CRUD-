<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Event</h2>

        <form method="POST" action="{{ route('events.update', $event) }}" class="mt-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <x-label for="title" value="Event Title" />
                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $event->title }}" required />
                </div>
                <div>
                    <x-label for="description" value="Description" />
                    <textarea id="description" class="block mt-1 w-full rounded-md border-gray-300" name="description" rows="4">{{ $event->description }}</textarea>
                </div>
                <div>
                    @if($event->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($event->image) }}" alt="Current event image" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    <x-label for="image" value="Event Image" />
                    <input type="file" id="image" name="image" 
                           class="block mt-1 w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-gray-800 file:text-white
                                  hover:file:bg-gray-700" 
                           accept="image/*" />
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