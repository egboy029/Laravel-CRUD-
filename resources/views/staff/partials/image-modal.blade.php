<!-- Image Modal -->
<div x-data="{ 
    open: false,
    imageUrl: '',
    imageAlt: ''
}">
    <!-- Modal -->
    <div x-show="open" 
         class="fixed inset-0 z-50 overflow-hidden" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="open = false"
         style="display: none;">
        
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black opacity-75"></div>

        <!-- Modal content -->
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="relative" @click.away="open = false">
                <!-- Close button -->
                <button @click="open = false" 
                        class="absolute top-0 right-0 -mt-4 -mr-4 bg-white rounded-full p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Image -->
                <img :src="imageUrl" 
                     :alt="imageAlt" 
                     class="max-h-[80vh] max-w-[90vw] object-contain rounded-lg shadow-xl"
                     @click.stop>
            </div>
        </div>
    </div>

    <!-- Image Trigger Template -->
    <template x-teleport="#image-modal-triggers">
        <div>
            @foreach ($events as $event)
                @if($event->image)
                    <div class="h-48 overflow-hidden cursor-pointer"
                         @click="open = true; imageUrl = '{{ asset('storage/' . $event->image) }}'; imageAlt = '{{ $event->title }}'">
                        <img src="{{ asset('storage/' . $event->image) }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    </div>
                @endif
            @endforeach
        </div>
    </template>
</div>
