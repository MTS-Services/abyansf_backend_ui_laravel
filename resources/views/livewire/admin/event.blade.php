<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <x-admin.searchbar page="Add Event" livewire_method="switchAddEventModal" />

    <!-- Add Event Modal -->
    <div
        class="fixed inset-0 bg-black/70 {{ $addEventModal ? 'block' : 'hidden' }} z-50 overflow-auto flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">
            <!-- Close button -->
            <button wire:click="switchAddEventModal"
                class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;</button>

            <!-- Header -->
            <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Event</h1>
            </div>

            <!-- Form Content -->
            <div class="p-6 space-y-6">
                <!-- Photo Upload Area -->
                <div id="photoArea"
                    class="h-56 sm:h-72 md:h-[457px] rounded-lg flex items-center justify-center transition-colors cursor-pointer"
                    style="border: 4px dashed #C7AE6A;">
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

                        <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop it here</p>
                        <button
                            class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Browse File
                        </button>
                    </div>
                </div>

                <input type="file" id="photoUpload" accept="image/*" multiple class="hidden">

                <!-- Preview Slider -->
                <div id="previewSlider" class="flex gap-4 mt-4 overflow-x-auto"></div>

                <!-- Title and Max Person Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" placeholder="Title text"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 ">Max person</label>
                        <input type="number" placeholder="Max person"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea rows="6" placeholder="Enter description"
                        class="w-full px-3 py-2 h-[264px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                </div>

                <!-- Location, Time, and Date Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" placeholder="Location"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                    <div class="col-span-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                            <input type="time" placeholder="00:00 am"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] appearance-none">
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" placeholder="MM/DD/YYYY"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] appearance-none">
                        </div>
                    </div>
                </div>

                <!-- Checkboxes -->
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
                <div class="flex justify-center md:justify-start mt-6">
                    <button
                        class="px-6 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-opacity-90 transition-colors font-medium">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white rounded-lg overflow-hidden mt-14 mb-5">
        <!-- Table Header (Hidden on mobile) -->
        <div class="hidden md:grid grid-cols-6 py-3 px-2">
            <div class="col-span-3 text-lg md:text-xl font-semibold text-black font-playfair">Event Name</div>
            <div class="col-span-1 text-lg md:text-xl font-semibold text-black font-playfair pl-1">Status</div>
            <div class="col-span-2 text-right pr-4 md:pr-16 text-lg md:text-xl font-semibold text-black font-playfair">
                Action</div>
        </div>

        <!-- Services Loop -->
        <div class="divide-y divide-gray-200">
            @php
                $services = [
                    [
                        'name' => 'Breakfast',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/event (1).jpg'),
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Nightlife',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/event (2).jpg'),
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Breakfast',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/event (3).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Nightlife',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/event (4).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Breakfast',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/event (5).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Nightlife',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/event (6).jpg'),
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Breakfast',
                        'location' => 'Jumeirah Beach Residence',
                        'image' => asset('image/event (7).jpg'),
                        'status' => 'inactive',
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
                                class="block w-full text-center px-2 py-2 text-xs font-playfair md:text-[10px] text-black font-medium rounded-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#b99b52]">
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
                        <!-- Edit Button -->
                        <!-- Edit Button -->
                        <button wire:click="editEventModel"
                            class="bg-[#C7AE6A] hover:bg-[#b99b52] text-black cursor-pointer px-3 font-playfair md:px-4 py-2 rounded-sm flex items-center text-xs md:text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Edit
                        </button>

                        <button class="text-[#C7AE6A] p-1 hover:text-[#b99b52] cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </button>
                        <button class="text-[#C7AE6A] p-1 hover:text-[#b99b52] cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
            <!-- Modal -->
            <!-- Modal -->
            @if ($editEventModal)
                <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                    <div
                        class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">
                        <!-- Close button -->
                        <button wire:click="closeEditEventModal"
                            class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;</button>

                        <!-- Header -->
                        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                            <h1 class="text-2xl font-semibold text-gray-900">Edit Event</h1>
                        </div>

                        <!-- Content (just layout, no data) -->
                        <div class="p-6 space-y-6">
                            <div id="photoArea"
                                class="h-56 sm:h-72 md:h-[457px] bg-gray-200 rounded-lg flex items-center justify-center border-2 border-dashed cursor-pointer">
                                <div class="text-center px-2">
                                    <p class="text-gray-500 font-bold text-sm sm:text-base md:text-lg">Change Image</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <input type="text" placeholder="Title text"
                                        class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Max person</label>
                                    <input type="number" placeholder="Max person"
                                        class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea rows="6" placeholder="Enter description"
                                    class="w-full px-3 py-2 h-[264px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                    <input type="text" placeholder="Location"
                                        class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Time & Date</label>
                                    <input type="datetime-local" placeholder="Select time & date"
                                        class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                                </div>
                            </div>

                            <div class="flex gap-6">
                                <label class="flex items-center">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Active</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Disable</span>
                                </label>
                            </div>

                            <div class="flex justify-center md:justify-start mt-6">
                                <button
                                    class="px-6 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-opacity-90 transition-colors font-medium">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Hidden File Input -->
            <input type="file" id="photoUpload" accept="image/*" multiple class="hidden">

        </div>
    </div>
    </div>

    <!-- Scripts -->

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
</section>
