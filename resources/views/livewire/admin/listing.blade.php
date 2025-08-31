<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <x-admin.searchbar page="Add Listing" livewire_method="switchAddListingModal" />

    <!-- Add Listing Modal -->
    <div x-data x-init="$watch('$wire.addListingModal', value => document.body.classList.toggle('overflow-hidden', value))"
        class="fixed inset-0 bg-black/70 {{ $addListingModal ? 'block' : 'hidden' }} z-50 overflow-auto flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">




            <!-- Close button -->
            <button wire:click="switchAddListingModal"
                class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;
            </button>

            <!-- Header -->
            <div class="flex items-center justify-between  border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Listing</h1>
            </div>

            <!-- Add Photos Section -->
            <div x-data="fileUpload()" class="space-y-4">
                <!-- Upload Box -->
                <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                    @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                    @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
                    :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                    <!-- Hidden File Input -->
                    <input type="file" x-ref="fileInput" multiple class="hidden" @change="handleFiles($event)">

                    <!-- Placeholder Text (Always visible) -->
                    <div class="text-center px-2">
                        <div class="mb-4 flex items-center justify-center">
                            <!-- Upload Icon -->
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

                <!-- Image Preview Section -->
                <div x-show="images.length" class="overflow-x-auto mt-3">
                    <div class="flex gap-2 min-w-max">
                        <template x-for="(img, index) in images" :key="index">
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
                        class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
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
                <textarea
                    class="w-full border border-[#C7AE6A] rounded p-2 h-[264px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"
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

            <div class="col-span-2 text-right pr-4 md:pr-16 text-lg md:text-xl font-semibold text-black font-playfair">
                Action</div>
        </div>



        <!-- Services Loop -->
        <div class="divide-y divide-gray-200">
            @php
                $listing = [
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
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Aura Sky Pool',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (4).jpg'),
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Eva beach',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (5).jpg'),
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Super car',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (6).jpg'),
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Helicopter tour',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (7).jpg'),
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Luxury Real Estate Consultant',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/listing (1).jpg'),
                        'status' => 'active',
                    ],
                ];
            @endphp
            @foreach ($listings as $listing)
                <div class="grid grid-cols-1 md:grid-cols-6 items-center py-4 px-2 gap-4 transition">
                    <!-- Service Info -->
                    <div class="flex items-start md:items-center col-span-3 space-x-3 md:space-x-4">
                        <input type="checkbox"
                            class="w-4 h-4 text-[#C7AE6A] border-gray-300 rounded focus:ring-[#C7AE6A] mt-1 md:mt-0">

                        <div class="w-20 h-20 md:w-26 md:h-26 overflow-hidden rounded shadow-sm flex-shrink-0 ">
                            <img src="{{ $listing['main_image'] }}" alt="{{ $listing['name'] }}"
                                class="object-cover w-full h-full">
                        </div>

                        <div>
                            <div class="font-semibold text-gray-800 text-base md:text-xl font-playfair">
                                {{ $listing['name'] }}</div>
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
                    </div>


                    <!-- Actions -->
                    <div class="relative col-span-2 flex justify-end" x-data="{ open: false }"
                        @click.outside="open = false">
                        {{-- Main button to toggle the dropdown --}}
                        <button @click="open = ! open"
                            class="p-1 -mt-1 text-[#AD8945] rounded-full focus:outline-none hover:text-[#C7AE6A] transition-colors duration-200"
                            title="Settings">
                            {{-- Cog icon for settings --}}
                            <flux:icon name="cog-6-tooth" class="h-5 w-5" />
                        </button>

                        {{-- Dropdown menu --}}
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                {{-- Edit Option --}}
                                <a href="#" wire:click="switchEditListingModel"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150"
                                    role="menuitem" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 text-gray-500"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>

                                {{-- Delete Option --}}
                                <a href="#" wire:click="deleteListing('{{ encrypt($listing['id']) }}')"
                                    class="flex items-center px-4 py-2 text-sm  hover:bg-red-50 transition-colors duration-150"
                                    role="menuitem" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 "
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"></path>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div x-data x-init="$watch('$wire.editListingModal', value => document.body.classList.toggle('overflow-hidden', value))"
                        class="fixed inset-0 bg-black/70 bg-opacity-50 {{ $editListingModal ? 'block' : 'hidden' }} z-50 overflow-auto flex items-center justify-center p-4">

                        <div
                            class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 overflow-y-auto max-h-[90vh]">
                            <div class="flex justify-end">
                                <button wire:click="switchEditListingModel"
                                    class="text-gray-600 hover:text-gray-900 cursor-pointer text-xl font-bold">&times;</button>
                            </div>

                            <div class="flex items-center justify-between  border-gray-200 pb-4">
                                <h1 class="text-4xl font-semibold text-gray-900">Edit Listing</h1>
                            </div>

                            <div x-data="fileUpload()" class="space-y-4">
                                <!-- Upload Box -->
                                <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                                    @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                                    @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
                                    :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                                    <!-- Hidden File Input -->
                                    <input type="file" x-ref="fileInput" multiple class="hidden"
                                        @change="handleFiles($event)">

                                    <!-- Placeholder Text (Always visible) -->
                                    <div class="text-center px-2">
                                        <div class="mb-4 flex items-center justify-center">
                                            <!-- Upload Icon -->
                                            <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                        </div>

                                        <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop it
                                            here</p>
                                        <button type="button"
                                            class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                            Browse File
                                        </button>
                                    </div>
                                </div>

                                <!-- Image Preview Section -->
                                <div x-show="images.length" class="overflow-x-auto mt-3">
                                    <div class="flex gap-2 min-w-max">
                                        <template x-for="(img, index) in images" :key="index">
                                            <div class="relative w-32 flex-shrink-0">
                                                <img :src="img"
                                                    class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                                <button type="button" @click="removeImage(index)"
                                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                                            </div>
                                        </template>
                                    </div>
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
                                <textarea
                                    class="w-full border border-[#C7AE6A] rounded p-2 h-[264px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"
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

                            <div class="flex gap-6 mt-4">
                                <label class="relative flex items-center cursor-pointer">
                                    <input type="checkbox"
                                        class="peer w-4 h-4 border border-gray-300 rounded appearance-none checked:bg-[#C7AE6A] checked:border-[#C7AE6A] focus:ring-[#C7AE6A]">
                                    <span
                                        class="pointer-events-none absolute left-0 top-0 w-4 h-4 flex items-center justify-center text-white text-sm hidden peer-checked:flex">✔</span>
                                    <span class="ml-2 text-sm text-gray-700">Active</span>
                                </label>

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

                </div>
            @endforeach
        </div>
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
