<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <x-admin.searchbar page="Add Listing" livewire_method="switchAddListingModal" />

    <!-- Add Listing Modal -->
    <div  x-data 
    x-effect="document.body.classList.toggle('overflow-hidden', @entangle('addEventModal'))"
        class="fixed inset-0 bg-black/70 {{ $addListingModal ? 'block' : 'hidden' }} z-50 overflow-auto flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">

            <!-- Close Button -->
            <button wire:click="closeAddListingModal"
                class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;</button>

            <div class="max-w-[1200px] mx-auto bg-white rounded-lg p-6 space-y-6 mt-4">
                <!-- Title -->
                <h2 class="text-4xl font-semibold text-gray-800 h-40px">Add Listing</h2>

                <!-- Add Photos Section -->
                <div x-data="fileUpload()" class="space-y-4">
                    <!-- Upload Box -->
                    <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex items-center justify-center transition-colors cursor-pointer relative
            border-4 border-[#C7AE6A]"
                        style="border: 4px dashed #C7AE6A;" @dragover.prevent="dragOver = true"
                        @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop($event)"
                        @click="$refs.fileInput.click()"
                        :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                        <!-- Hidden File Input -->
                        <input type="file" x-ref="fileInput" multiple class="hidden" @change="handleFiles($event)">

                        <div class="text-center px-2">
                            <div class="mb-4 flex items-center justify-center">
                                <!-- Upload Icon -->
                                <svg class="w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                            </div>

                            <!-- Placeholder Text -->
                            <template x-if="!images.length">
                                <div>
                                    <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop it here</p>
                                    <button type="button"
                                        class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Browse File
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>


                    <!-- Image Preview Section (Always below box) -->
                    <div x-show="images.length" class="flex flex-wrap gap-2 mt-3">
                        <template x-for="(img, index) in images" :key="index">
                            <div class="relative">
                                <img :src="img" class="w-40 h-40 object-cover rounded-md border"
                                    alt="Preview">
                                <button type="button" @click="removeImage(index)"
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                            </div>
                        </template>
                    </div>
                </div>
                <input type="file" id="photoUpload" class="hidden" accept="image/*" multiple>

                <!-- Preview Slider -->
                <div class="w-full max-w-8xl mx-auto px-4">
                    <div class="overflow-x-auto scroll-smooth snap-x snap-mandatory flex gap-4 pb-8 no-scrollbar"
                        id="previewSlider">
                        <!-- Example cards (will be replaced by selected images) -->
                    </div>
                </div>
                <!-- Category Selection -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Main Service</label>
                        <select
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-4 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                            <option>Select one category</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Sub Category</label>
                        <select
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                            <option>Select one category</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Specific Category</label>
                        <select
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                            <option>Select one category</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea class="w-full border border-[#C7AE6A] rounded p-2 h-[264px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"
                        placeholder="Enter description"></textarea>
                </div>

                <!-- Location & Open Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Location</label>
                        <input type="text" placeholder="Location"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Open time</label>
                        <input type="text" placeholder="Open time"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>
                </div>

                <!-- Status -->
                <div class="flex gap-6">
                    <!-- Active -->
                    <label class="relative flex items-center cursor-pointer">
                        <input type="checkbox"
                            class="peer w-4 h-4 border border-gray-300 rounded appearance-none checked:bg-[#C7AE6A] checked:border-[#C7AE6A] focus:ring-[#C7AE6A]">
                        <span
                            class="pointer-events-none absolute left-0 top-0 w-4 h-4 flex items-center justify-center text-white text-sm hidden peer-checked:flex">✔</span>
                        <span class="ml-2 text-sm text-gray-700">Active</span>
                    </label>

                    <!-- Disable -->
                    <label class="relative flex items-center cursor-pointer">
                        <input type="checkbox"
                            class="peer w-4 h-4 border border-gray-300 rounded appearance-none checked:bg-[#C7AE6A] checked:border-[#C7AE6A] focus:ring-[#C7AE6A]">
                        <span
                            class="pointer-events-none absolute left-0 top-0 w-4 h-4 flex items-center justify-center text-white text-sm hidden peer-checked:flex">✔</span>
                        <span class="ml-2 text-sm text-gray-700">Disable</span>
                    </label>
                </div>

                <!-- Save Button -->
                <div class="flex justify-center md:justify-start">
                    <button
                        class="px-8 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-opacity-90 transition-colors font-medium">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>




    <div class="bg-white rounded-lg overflow-hidden mt-14 mb-5">
        <!-- Table Header (Hidden on mobile) -->
        <div class="hidden md:grid grid-cols-6 py-3 px-2">
            <div class="col-span-3 text-lg md:text-xl font-semibold  text-black font-playfair">Service Name</div>
            <div class="col-span-1 text-lg md:text-xl font-semibold text-black font-playfair pl-1">Status</div>
            <div class="col-span-2 text-right pr-4 md:pr-16 text-lg md:text-xl font-semibold text-black font-playfair">
                Action</div>
        </div>

        <!-- Services Loop -->
        <div class="divide-y divide-gray-200">
            @php
                $services = [
                    [
                        'name' => 'Camel Camp',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (2).jpg'),
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Single Buggy Ride',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (3).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Aura Sky Pool',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (4).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Eva beach',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (5).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Super car',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (6).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Helicopter tour',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (7).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Luxury Real Estate Consultant',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (1).jpg'),
                        'status' => 'active',
                    ],
                ];
            @endphp
            @foreach ($services as $service)
                <div class="grid grid-cols-1 md:grid-cols-6 items-center py-4 px-2 gap-4 transition">
                    <!-- Service Info -->
                    <div class="flex items-start md:items-center col-span-3 space-x-3 md:space-x-4">
                        <input type="checkbox"
                            class="w-4 h-4 text-[#C7AE6A] border-gray-300 rounded focus:ring-[#C7AE6A] mt-1 md:mt-0">

                        <div class="w-20 h-20 md:w-26 md:h-26 overflow-hidden rounded shadow-sm flex-shrink-0 ">
                            <img src="{{ $service['image'] }}" alt="{{ $service['name'] }}"
                                class="object-cover w-full h-full">
                        </div>

                        <div>
                            <div class="font-semibold text-gray-800 text-base md:text-xl font-playfair">
                                {{ $service['name'] }}</div>
                            <div class="my-2 md:my-5"></div>
                            <div class="flex items-center text-xs md:text-sm text-black font-playfair">
                                <svg class="w-4 h-4 mr-1 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $service['location'] }}
                            </div>
                        </div>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="col-span-1 relative w-full md:w-32 text-center mt-3 md:mt-0">
                        <div class="w-full md:w-24 h-[40px] bg-[#F4F4F4] rounded-sm items-center pt-1 relative">
                            <select
                                class="block w-full text-center px-2 py-2 text-xs font-playfair md:text-[10px] text-black font-medium rounded-sm appearance-none focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="active" {{ $service['status'] === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive" {{ $service['status'] === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                            <!-- Status indicator -->
                            <span
                                class="absolute left-3 bottom-2 transform font-playfair -translate-y-1/2 w-2 h-2 rounded-full {{ $service['status'] === 'active' ? 'bg-[#22C55E]' : 'bg-[#9A9A9A]' }}">
                            </span>

                            <!-- Dropdown arrow -->
                            <div class="absolute right-3 top-4 text-black pointer-events-none">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="flex items-center justify-start md:justify-end col-span-2 space-x-2 mt-3 md:mt-0">
                        <button wire:click="editListingModel"
                            class="bg-[#C7AE6A] hover:bg-[#b99b52] text-black px-3 md:px-4 py-2 cursor-pointer font-playfair rounded-sm flex items-center text-xs md:text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Edit
                        </button>

                        <button class="text-[#C7AE6A] p-1 hover:text-[#b99b52]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Modal -->
                        @if ($editListingModal)
                            <div class="fixed inset-0  bg-black/70 z-50 flex items-center justify-center p-4">
                                <div
                                    class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 overflow-y-auto max-h-[90vh] ">
                                    <div class="flex justify-end">
                                        <button wire:click="closeEditListingModal"
                                            class="text-gray-600 hover:text-gray-900 cursor-pointer text-xl font-bold">&times;</button>
                                    </div>

                                    <h2 class="text-4xl font-semibold text-gray-800 h-40px mb-4">Edit Listing</h2>

                                    <div x-data="fileUpload()" class="space-y-4">
                                        <!-- Upload Box -->
                                        <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex items-center justify-center transition-colors cursor-pointer relative
                                        border-4 border-[#C7AE6A]"
                                            style="border: 4px dashed #C7AE6A;" @dragover.prevent="dragOver = true"
                                            @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop($event)"
                                            @click="$refs.fileInput.click()"
                                            :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                                            <!-- Hidden File Input -->
                                            <input type="file" x-ref="fileInput" multiple class="hidden"
                                                @change="handleFiles($event)">

                                            <div class="text-center px-2">
                                                <div class="mb-4 flex items-center justify-center">
                                                    <!-- Upload Icon -->
                                                    <svg class="w-8 h-8 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                    </svg>
                                                </div>

                                                <!-- Placeholder Text -->
                                                <template x-if="!images.length">
                                                    <div>
                                                        <p class="text-lg font-bold text-gray-800">Choose a file or
                                                            drag & drop it here</p>
                                                        <button type="button"
                                                            class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                            Browse File
                                                        </button>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>


                                        <!-- Image Preview Section (Always below box) -->
                                        <div x-show="images.length" class="flex flex-wrap gap-2 mt-3">
                                            <template x-for="(img, index) in images" :key="index">
                                                <div class="relative">
                                                    <img :src="img"
                                                        class="w-40 h-40 object-cover rounded-md border"
                                                        alt="Preview">
                                                    <button type="button" @click="removeImage(index)"
                                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                                                </div>
                                            </template>
                                        </div>


                                    </div>

                                    <input type="file" id="photoUpload" class="hidden" accept="image/*" multiple>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Title</label>
                                            <input type="text"
                                                class="w-full border border-gray-300 bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"
                                                placeholder="Enter title">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Sub Title</label>
                                            <input type="text"
                                                class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"
                                                placeholder="Enter sub title">
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label class="block text-sm font-medium mb-1">Description</label>
                                        <textarea class="w-full border border-[#C7AE6A] rounded p-2 h-[264px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"
                                            placeholder="Enter description"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Location</label>
                                            <input type="text" placeholder="Location"
                                                class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Open time</label>
                                            <input type="text" placeholder="Open time"
                                                class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                                        </div>
                                    </div>

                                    <div class="flex gap-6">
                                        <!-- Active -->
                                        <label class="relative flex items-center cursor-pointer">
                                            <input type="checkbox"
                                                class="peer w-4 h-4 border border-gray-300 rounded appearance-none checked:bg-[#C7AE6A] checked:border-[#C7AE6A] focus:ring-[#C7AE6A]">
                                            <span
                                                class="pointer-events-none absolute left-0 top-0 w-4 h-4 flex items-center justify-center text-white text-sm hidden peer-checked:flex">✔</span>
                                            <span class="ml-2 text-sm text-gray-700">Active</span>
                                        </label>

                                        <!-- Disable -->
                                        <label class="relative flex items-center cursor-pointer">
                                            <input type="checkbox"
                                                class="peer w-4 h-4 border border-gray-300 rounded appearance-none checked:bg-[#C7AE6A] checked:border-[#C7AE6A] focus:ring-[#C7AE6A]">
                                            <span
                                                class="pointer-events-none absolute left-0 top-0 w-4 h-4 flex items-center justify-center text-white text-sm hidden peer-checked:flex">✔</span>
                                            <span class="ml-2 text-sm text-gray-700">Disable</span>
                                        </label>
                                    </div>

                                    <div class="flex justify-center md:justify-start mt-6">
                                        <button
                                            class="px-8 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-opacity-90 transition-colors font-medium">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="border-t border-gray-200"></div>
    <div class="flex items-center justify-center space-x-2 my-6 flex-wrap">
        <!-- Previous Button (disabled) -->
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed"
            disabled>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button
            class="flex items-center justify-center w-8 h-8 rounded border-2 border-[#AD8945]  text-[#AD8945] font-medium text-sm">1</button>
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">2</button>
        <span class="flex items-center justify-center w-8 h-8 text-gray-500 text-sm">...</span>
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">9</button>
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">10</button>

        <!-- Next Button -->
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

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
