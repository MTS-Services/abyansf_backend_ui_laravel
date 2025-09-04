<section class="mx-auto max-w-[1200px]  font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Listing Management</h2>
    <x-admin.searchbar page="Add Listing" livewire_method="switchAddListingModal" />

    <div x-data x-init="$watch('$wire.addListingModal', value => document.body.classList.toggle('overflow-hidden', value))"
        class="fixed inset-0 bg-black/70 {{ $addListingModal ? 'block' : 'hidden' }} z-50 overflow-auto flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">

            <button wire:click="switchAddListingModal"
                class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;
            </button>

            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Listing</h1>
            </div>


            <div class="w-full max-w-8xl mx-auto px-4">
                <div class="overflow-x-auto scroll-smooth snap-x snap-mandatory flex gap-4 pb-8 no-scrollbar"
                    id="previewSlider">
                </div>
            </div>

            <form wire:submit.prevent="saveListing" class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1 font-playfair">Specific Category</label>
                        <select wire:model="specificCategoryId"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                            <option value="">Select a category</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 font-playfair">Name</label>
                        <input wire:model="name" type="text" placeholder="Name"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 font-playfair">Location</label>
                        <input wire:model="location" type="text" placeholder="Location"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 font-playfair">Member Privileges Description</label>
                    <textarea wire:model="member_privileges_description" placeholder="Enter member privileges description"
                        class="w-full border border-[#C7AE6A] rounded p-2 focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] h-[100px]"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 font-playfair">Description</label>
                    <textarea wire:model="description" placeholder="Enter description"
                        class="w-full border border-[#C7AE6A] rounded p-2 h-[264px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1 font-playfair">Hours</label>
                        <input wire:model="hours" type="time" placeholder="e.g., Mon-Fri: 9am-5pm"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 font-playfair">Form Name</label>
                        <input wire:model="formName" type="text" placeholder="Form Name"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 font-playfair">Venue Name</label>
                        <input wire:model="venueName" type="text" placeholder="Venue Name"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1 font-playfair">Type of Service</label>
                        <input wire:model="typeofservice" type="text" placeholder="Type of Service"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 font-playfair">Contract Whatsapp</label>
                        <input wire:model="contractWhatsapp" type="number" placeholder="Whatsapp number"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>

                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div x-data="{ mainImage: null, dragOver: false }" class="space-y-4">
                        <label class="block text-sm font-medium mb-1">Main Image (Single)</label>
                        <div class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                            @drop.prevent="mainImage = $event.dataTransfer.files[0]"
                            @click="$refs.mainImageInput.click()"
                            :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">
                            <input type="file" x-ref="mainImageInput" class="hidden"
                                @change="mainImage = $event.target.files[0]">
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
                        <div x-show="mainImage" class="mt-3">
                            <div class="relative w-32 flex-shrink-0">
                                <img :src="URL.createObjectURL(mainImage)"
                                    class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                <button type="button" @click="mainImage = null"
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ menuImages: [], dragOver: false }" class="space-y-4">
                        <label class="block text-sm font-medium mb-1">Menu Images</label>
                        <div class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                            @drop.prevent="menuImages = Array.from($event.dataTransfer.files)"
                            @click="$refs.menuImageInput.click()"
                            :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">
                            <input type="file" x-ref="menuImageInput" multiple class="hidden"
                                @change="menuImages = Array.from($event.target.files)">
                            <div class="text-center px-2">
                                <div class="mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                </div>
                                <p class="text-lg font-bold text-gray-800">Choose files or drag & drop them here</p>
                                <button type="button"
                                    class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Browse Files
                                </button>
                            </div>
                        </div>
                        <div x-show="menuImages.length > 0" class="overflow-x-auto mt-3">
                            <div class="flex gap-2 min-w-max">
                                <template x-for="(img, index) in menuImages" :key="index">
                                    <div class="relative w-32 flex-shrink-0">
                                        <img :src="URL.createObjectURL(img)"
                                            class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                        <button type="button" @click="menuImages.splice(index, 1)"
                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ subImages: [], dragOver: false }" class="space-y-4">
                        <label class="block text-sm font-medium mb-1">Sub Images</label>
                        <div class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                            @drop.prevent="subImages = Array.from($event.dataTransfer.files)"
                            @click="$refs.subImageInput.click()"
                            :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">
                            <input type="file" x-ref="subImageInput" multiple class="hidden"
                                @change="subImages = Array.from($event.target.files)">
                            <div class="text-center px-2">
                                <div class="mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                </div>
                                <p class="text-lg font-bold text-gray-800">Choose files or drag & drop them here</p>
                                <button type="button"
                                    class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Browse Files
                                </button>
                            </div>
                        </div>
                        <div x-show="subImages.length > 0" class="overflow-x-auto mt-3">
                            <div class="flex gap-2 min-w-max">
                                <template x-for="(img, index) in subImages" :key="index">
                                    <div class="relative w-32 flex-shrink-0">
                                        <img :src="URL.createObjectURL(img)"
                                            class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                        <button type="button" @click="subImages.splice(index, 1)"
                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Has Form</label>
                    <div class="flex items-center space-x-4">
                        <label class="inline-flex items-center">
                            <input wire:model="hasForm" type="radio" value="1"
                                class="form-radio text-[#C7AE6A] h-4 w-4">
                            <span class="ml-2 text-gray-700">Yes</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input wire:model="hasForm" type="radio" value="0"
                                class="form-radio text-[#C7AE6A] h-4 w-4">
                            <span class="ml-2 text-gray-700">No</span>
                        </label>
                    </div>
                </div>


                <div class="flex justify-center md:justify-start pt-6">
                    <button type="submit"
                        class="px-8 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-opacity-90 transition-colors font-medium">
                        Save
                    </button>
                </div>
        </div>
        </form>
    </div>
    </div>
    <div class="bg-white rounded-lg overflow-y-visible mt-14 mb-5 ">
        <table class="min-w-full table-fixed border-collapse">
            <thead>
                <tr class="hidden md:table-row bg-[#E7E7E7]">
                    <th class="p-4 text-left font-medium text-base">SL</th>
                    <th class="py-3 px-2 text-left text-lg md:text-xl font-semibold text-black font-playfair w-[70%]">
                        Service Name
                    </th>
                    <th class="p-4 text-right font-medium text-base md:text-lg text-black font-playfair w-[30%]">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 mt-4 md:mt-2">
                @foreach ($listings as $listing)
                    <tr wire:key="booking-{{ $listing['id'] }}" x-data="{ dropdownOpen: false }"
                        class="flex flex-col md:table-row items-start md:items-center py-4 px-2 gap-4 transition relative md:static">
                        <div class="flex flex-col md:flex-row w-full md:w-auto items-start md:items-center">
                            <td class="p-4 text-left font-normal text-base block md:table-cell" data-label="SL">
                                <span class="font-medium text-gray-500 md:hidden">SL: </span>
                                <p class="text-black whitespace-nowrap inline-block md:block">{{ $listing['id'] }}</p>
                            </td>
                            <td class="flex items-start md:items-center space-x-3 md:space-x-4">
                                <p
                                    class="w-20 h-15 mt-6 mb-2 md:w-26 md:h-26 overflow-hidden rounded shadow-sm flex-shrink-0 ">
                                    <img src="{{ $listing['main_image'] }}" alt="{{ $listing['name'] }}"
                                        class="object-cover w-full h-20 md:h-26 ">
                                </p>
                                <div>
                                    <div class="font-semibold text-gray-800 text-base md:text-xl font-playfair">
                                        <span class="font-medium text-gray-500 md:hidden">Service Name: </span>
                                        {{ $listing['name'] }}
                                    </div>
                                    <div class="my-2 md:my-5"></div>
                                    <div class="flex items-center text-xs md:text-sm text-black font-playfair">
                                        <svg class="w-4 h-4 mr-1 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $listing['location'] }}
                                    </div>
                                </div>
                            </td>
                        </div>

                        <td class="py-3 px-6 text-left md:text-right absolute top-4 right-4 md:static">
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
                                    <button wire:click="switchEditListingModal('{{ encrypt($listing['id']) }}')"
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
                                    <button wire:click="deleteListing('{{ encrypt($listing['id']) }}')"
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
        <div x-data="{ open: @entangle('editListingModal') }" x-show="open" x-cloak x-init="$watch('open', value => document.body.classList.toggle('overflow-hidden', value));" x-on:click.self="open = false"
            class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 transition-opacity duration-300 ease-in-out"
            x-transition:enter="opacity-0" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="opacity-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">

                <button wire:click="closeEditModal"
                    class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;</button>

                <div class="flex items-center justify-between border-gray-200 pb-4">
                    <h1 class="text-2xl font-semibold text-gray-900">Edit Listing</h1>
                </div>

                <form wire:submit.prevent="updateListing" class="p-6 space-y-6">
                    {{-- Image Upload and Preview Section --}}
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                        {{-- Main Image handling --}}
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Main Image (Single)</label>
                            <div class="h-56 sm:h-72 md:h-56 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                                @click="$refs.mainImageInput.click()">
                                <input type="file" wire:model.live="main_image" x-ref="mainImageInput" class="hidden" accept="image/*">
                                <div class="text-center px-2">
                                    <div class="mb-4 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                    </div>
                                    <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop it here</p>
                                </div>
                            </div>
                            @if ($main_image)
                                <div class="relative w-32 flex-shrink-0 mt-3">
                                    <img src="{{ $main_image->temporaryUrl() }}" class="w-full h-32 object-cover rounded-md border" alt="Main Image Preview">
                                    <button type="button" wire:click="$set('main_image', null)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">&times;</button>
                                </div>
                            @elseif ($existing_main_image)
                                <div class="relative w-32 flex-shrink-0 mt-3">
                                    <img src="{{ $existing_main_image }}" class="w-full h-32 object-cover rounded-md border" alt="Existing Main Image">
                                    <button type="button" wire:click="$set('existing_main_image', null)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">&times;</button>
                                </div>
                            @endif
                        </div>

                        {{-- Multi-image handling (Menu and Sub Images) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            {{-- Menu Images --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Menu Images</label>
                                <div class="h-56 sm:h-72 md:h-56 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4 mt-2"
                                    @click="$refs.menuImagesInput.click()">
                                    <input type="file" wire:model.live="menu_images" multiple x-ref="menuImagesInput" class="hidden" accept="image/*">
                                    <div class="text-center px-2">
                                        <div class="mb-4 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                        </div>
                                        <p class="text-lg font-bold text-gray-800">Choose files or drag & drop here</p>
                                    </div>
                                </div>
                                @if ($menu_images || $existing_menu_images)
                                    <div class="mt-4 overflow-x-auto">
                                        <div class="flex gap-2 min-w-max">
                                            @foreach ($existing_menu_images as $image)
                                                <div class="relative w-32 flex-shrink-0">
                                                    <img src="{{ $image['url'] }}" class="w-full h-32 object-cover rounded-md border" alt="Existing Menu Image">
                                                    <button type="button" wire:click="removeExistingImage('menu_images', '{{ $image['id'] }}')" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">&times;</button>
                                                </div>
                                            @endforeach
                                            @foreach ($menu_images as $index => $newImage)
                                                <div class="relative w-32 flex-shrink-0">
                                                    <img src="{{ $newImage->temporaryUrl() }}" class="w-full h-32 object-cover rounded-md border" alt="New Menu Image Preview">
                                                    <button type="button" wire:click="removeNewImage('menu_images', {{ $index }})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">&times;</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Sub Images --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Sub Images</label>
                                <div class="h-56 sm:h-72 md:h-56 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4 mt-2"
                                    @click="$refs.subImagesInput.click()">
                                    <input type="file" wire:model.live="sub_images" multiple x-ref="subImagesInput" class="hidden" accept="image/*">
                                    <div class="text-center px-2">
                                        <div class="mb-4 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                        </div>
                                        <p class="text-lg font-bold text-gray-800">Choose files or drag & drop here</p>
                                    </div>
                                </div>
                                @if ($sub_images || $existing_sub_images)
                                    <div class="mt-4 overflow-x-auto">
                                        <div class="flex gap-2 min-w-max">
                                            @foreach ($existing_sub_images as $image)
                                                <div class="relative w-32 flex-shrink-0">
                                                    <img src="{{ $image['url'] }}" class="w-full h-32 object-cover rounded-md border" alt="Existing Sub Image">
                                                    <button type="button" wire:click="removeExistingImage('sub_images', '{{ $image['id'] }}')" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">&times;</button>
                                                </div>
                                            @endforeach
                                            @foreach ($sub_images as $index => $newImage)
                                                <div class="relative w-32 flex-shrink-0">
                                                    <img src="{{ $newImage->temporaryUrl() }}" class="w-full h-32 object-cover rounded-md border" alt="New Sub Image Preview">
                                                    <button type="button" wire:click="removeNewImage('sub_images', {{ $index }})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">&times;</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input wire:model.defer="name" type="text" placeholder="Enter name"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea wire:model.defer="description" rows="6" placeholder="Enter description"
                            class="w-full px-3 py-2 h-[264px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                        @error('description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input wire:model.defer="location" type="text" placeholder="Location"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        @error('location')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" wire:model.defer="active" name="status" value="true"
                                    class="form-radio text-[#C7AE6A]">
                                <span class="ml-2 text-sm text-gray-700">Active</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" wire:model.defer="active" name="status" value="false"
                                    class="form-radio text-[#C7AE6A]">
                                <span class="ml-2 text-sm text-gray-700">Disabled</span>
                            </label>
                        </div>
                        @error('active')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
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

    <script>
        function fileUpload() {
            return {
                dragOver: false,
                images: [],
                handleFiles(event) {
                    for (let file of event.target.files) {
                        this.preview(file);
                    }
                },
                handleDrop(event) {
                    for (let file of event.dataTransfer.files) {
                        this.preview(file);
                    }
                    this.dragOver = false;
                },
                preview(file) {
                    const reader = new FileReader();
                    reader.onload = e => this.images.push(e.target.result);
                    reader.readAsDataURL(file);
                },
                removeImage(index) {
                    this.images.splice(index, 1);
                }
            }
        }
    </script>
</section>