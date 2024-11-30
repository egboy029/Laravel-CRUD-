<div>
    <x-button type="button" wire:click="openModal">
        Create Event
    </x-button>

    <x-dialog-modal wire:model.live="showModal">
        <x-slot name="title">
            Create New Event
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <x-label for="title" value="Event Title" />
                    <x-input id="title" class="block mt-1 w-full" type="text" wire:model="title" required />
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="description" value="Description" />
                    <textarea id="description" class="block mt-1 w-full rounded-md border-gray-300" wire:model="description" rows="4"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="event_date" value="Event Date" />
                    <x-input id="event_date" class="block mt-1 w-full" type="date" wire:model="event_date" required />
                    @error('event_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal">
                Cancel
            </x-secondary-button>

            <x-button class="ml-2" wire:click="save">
                Create Event
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div> 