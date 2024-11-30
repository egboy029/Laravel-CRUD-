<!-- Create Event Modal -->
<div x-data="createEventModal()" @keydown.escape.window="closeModal()">
    <!-- Trigger Button -->
    <button @click="openModal()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
        Create Event
    </button>

    <!-- Modal -->
    <div x-show="isOpen" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black opacity-50"></div>

        <!-- Modal content -->
        <div class="relative min-h-screen flex items-center justify-center">
            <div class="relative bg-white rounded-lg shadow-xl mx-4" style="width: 500px;" @click.away="closeModal()">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Create New Event</h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4">
                    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" @submit="closeModal()">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <x-label for="title" value="Event Title" />
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                            </div>
                            <div>
                                <x-label for="description" value="Description" />
                                <textarea id="description" class="block mt-1 w-full rounded-md border-gray-300" name="description" rows="3"></textarea>
                            </div>
                            <div>
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
                                <x-input id="event_date" class="block mt-1 w-full" type="date" name="event_date" required />
                            </div>
                            <div class="flex justify-end space-x-3 mt-6">
                                <button type="button" 
                                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 font-medium text-sm"
                                        @click="closeModal()">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 font-medium text-sm">
                                    Create Event
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { 
        display: none !important; 
    }
</style>

<script>
    function createEventModal() {
        return {
            isOpen: false,
            openModal() {
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;
            }
        }
    }
</script>
