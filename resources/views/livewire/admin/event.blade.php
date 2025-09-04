<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Event Management</h2>
    <x-admin.searchbar page="Add Event" livewire_method="switchAddEventModal" />

    <!-- Add Event Modal -->
    <!-- Add Event Modal -->
    <div x-data x-init="$watch('$wire.addEventModal', value => document.body.classList.toggle('overflow-hidden', value))"
        class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 {{ $addEventModal ? '' : 'hidden' }}">

        <div class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">

            <button wire:click="switchAddEventModal"
                class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;
            </button>

            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Event</h1>
            </div>

            <form wire:submit.prevent="saveEvent" class="p-6 space-y-6">
                <div x-data="fileUpload()" class="space-y-4">
                    <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                        @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                        @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
                        :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                        <input type="file" x-ref="fileInput" class="hidden" wire:model="image"
                            @change="handleFiles($event)">

                        <div class="text-center px-2">
                            <div class="mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                            </div>
                            <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop it here</p>
                            <button type="button"
                                class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Browse File
                            </button>
                        </div>
                    </div>

                    <div x-show="image.length" class="overflow-x-auto mt-3">
                        <div class="flex gap-2 min-w-max">
                            <template x-for="(img, index) in image" :key="index">
                                <div class="relative w-32 flex-shrink-0">
                                    <img :src="img" class="w-full h-32 object-cover rounded-md border"
                                        alt="Preview">
                                    <button type="button" @click="removeImage(index)"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" placeholder="Title text" wire:model="title"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Max person</label>
                        <input type="number" placeholder="Max person" wire:model="max_person"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea rows="6" placeholder="Enter description" wire:model="description"
                        class="w-full px-3 py-2 h-[264px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" placeholder="Location" wire:model="location"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                    <div class="col-span-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                            <input type="time" wire:model="time"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" wire:model="date"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                    </div>
                </div>

                <div class="flex justify-center md:justify-start mt-6">

                    <button type="submit"
                        class="px-6 py-2 bg-[#C7AE6A] text-black rounded-md cursor-pointer hover:bg-opacity-90 transition-colors font-medium">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg overflow-hidden mt-14 mb-5">
        <table class="min-w-full table-fixed border-collapse">
            <thead>
                <tr class="hidden md:table-row bg-[#E7E7E7]">
                    <th class="p-4 text-left font-medium text-base">SL</th>
                    <th class="py-3 px-2 text-left text-lg md:text-xl font-semibold text-black font-playfair w-[70%]">
                        Service Name
                    </th>
                    <th class="py-3 px-2 text-left text-lg md:text-xl font-semibold text-black font-playfair w-[70%]">
                        Status
                    </th>
                    <th class="p-4 text-right font-medium text-base md:text-lg  text-black font-playfair w-[30%]">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 mt-4 md:mt-2">
                @foreach ($events as $event)
                    <tr wire:key="booking-{{ $event['id'] }}" x-data="{ dropdownOpen: false }"
                        class="grid grid-cols-1 md:table-row items-center py-4 px-2 gap-4 transition">
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-black whitespace-nowrap">{{ $event['id'] }}</p>
                        </td>
                        <td class="flex items-start md:items-center col-span-3 space-x-3 md:space-x-4">

                            <p
                                class="w-20 h-15 mt-6 mb-2 md:w-26 md:h-26 overflow-hidden rounded shadow-sm flex-shrink-0 ">
                                <img src="{{ $event['event_img'] }}" alt="{{ $event['title'] }}"
                                    class="object-cover w-full h-20 md:h-26 ">
                            </p>

                            <div>
                                <div class="font-semibold text-gray-800 text-base md:text-xl font-playfair">
                                    {{ $event['title'] }}</div>
                                <div class="my-2 md:my-5"></div>
                                <div class="flex items-center text-xs md:text-sm text-black font-playfair">
                                    <svg class="w-4 h-4 mr-1 text-black" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $event['location'] }}
                                </div>
                            </div>

                        </td>
                        <td class="p-4 text-left font-normal text-base">
                            @if ($event['status'])
                                <span
                                    class="inline-block px-3 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">Active</span>
                            @else
                                <span
                                    class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">Inactive</span>
                            @endif
                        </td>


                        <td class="py-3 px-6 text-left md:text-right">
                            <div class="relative inline-block text-left" x-data="{ open: false }"
                                x-on:click.outside="open = false">
                                <button x-on:click="open = ! open"
                                    class="-mt-1 text-[#AD8945] rounded-full focus:outline-none" title="Settings">
                                    <flux:icon name="cog-6-tooth" class="text-[#C7AE6A]" />
                                </button>

                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-3 -mt-1 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">

                                    <button wire:click="switchEditEventModal('{{ encrypt($event['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Edit
                                    </button>

                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="check" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Active
                                    </button>

                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="x-circle" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Deactivate
                                    </button>

                                    <button wire:click="deleteEvent('{{ encrypt($event['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    {{-- <!edit event modal--> --}}



    <div x-data x-data x-init="$watch('$wire.editEventModal', value => document.body.classList.toggle('overflow-hidden', value))"
        class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 {{ $editEventModal ? '' : 'hidden' }}">

        <div class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">

            <button wire:click="switchEditEventModal"
                class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;</button>

            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-2xl font-semibold text-gray-900">Edit Event</h1>
            </div>
            <form wire:submit.prevent="updateEvent" class="p-6 space-y-6">
                <div class="p-6 space-y-6">


                    <div x-data="{ dragOver: false, imagePreview: @entangle('image') }" class="space-y-4">
                        <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                            @drop.prevent="dragOver = false; $wire.upload('image', event.dataTransfer.files[0])"
                            @click="$refs.fileInput.click()" :class="{ 'border-blue-500': dragOver }">
                            <input wire:model="image" type="file" x-ref="fileInput" class="hidden"
                                accept="image/*">

                            <template
                                x-if="imagePreview && (imagePreview.previewUrl || (typeof imagePreview === 'string' && imagePreview.length > 0))">
                                <div class="relative w-full h-full">
                                    <img :src="imagePreview.previewUrl || imagePreview"
                                        class="w-full h-full object-cover rounded-md" alt="Preview">

                                    <button type="button"
                                        @click.stop="$wire.set('image', null); $refs.fileInput.value = '';"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">
                                        &times;
                                    </button>
                                </div>
                            </template>

                            <div x-show="!imagePreview || (typeof imagePreview === 'string' && imagePreview.length === 0)"
                                class="text-center px-2">
                                <div class="mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                </div>
                                <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop it here</p>
                                <button type="button"
                                    class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Browse File
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input wire:model.defer="title" type="text" placeholder="Title text"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 ">Max person</label>
                            <input wire:model.defer="max_person" type="number" placeholder="Max person"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea wire:model.defer="description" rows="6" placeholder="Enter description"
                            class="w-full px-3 py-2 h-[264px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input wire:model.defer="location" type="text" placeholder="Location"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Time </label>
                            <input type="time" wire:model.defer="time"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date </label>
                            <input type="date" wire:model.defer="date"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                    </div>
                    <div class="flex justify-center md:justify-start mt-6">
                        <button type="submit"
                            class="px-6 py-2 bg-[#C7AE6A] text-black rounded-md cursor-pointer hover:bg-opacity-90 transition-colors font-medium">
                            Save
                        </button>
                    </div>
            </form>
        </div>

    </div>
    </div>
    <input type="file" id="photoUpload" accept="image/*" multiple class="hidden">
    </div>



    <!-- Pagination -->

    @if (!empty($pagination) && ($pagination['pages'] ?? 1) > 1)
        <div class="flex items-center justify-center space-x-2 py-3 my-3 flex-wrap border-t border-slate-200">
            <button wire:click="previousPage" @disabled(!$hasPrevious) @class([
                'flex items-center justify-center w-8 h-8 rounded border border-slate-300',
                'bg-slate-100 text-slate-400 cursor-not-allowed' => !$hasPrevious,
                'bg-white text-slate-700 hover:bg-slate-50' => $hasPrevious,
            ])>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            @foreach ($pages as $page)
                @if ($page === '...')
                    <span class="flex items-center justify-center w-8 h-8 text-slate-500 text-sm">...</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" @class([
                        'flex items-center justify-center w-8 h-8 rounded border font-medium text-sm',
                        'border-2 border-[#AD8945] text-[#AD8945]' => $page == $currentPage,
                        'border-slate-300 bg-white text-slate-700 hover:bg-slate-50' =>
                            $page != $currentPage,
                    ])>
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            <button wire:click="nextPage" @disabled(!$hasNext) @class([
                'flex items-center justify-center w-8 h-8 rounded border border-slate-300',
                'bg-slate-100 text-slate-400 cursor-not-allowed' => !$hasNext,
                'bg-white text-slate-700 hover:bg-slate-50' => $hasNext,
            ])>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    @endif


</section>
