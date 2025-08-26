<section class="mx-auto max-w-[1200px] p-4">
    <x-admin.searchbar page="Add Event" />

    <div class="bg-white rounded-lg overflow-hidden mt-14 mb-5">
        <!-- Table Header -->
        <div class="grid grid-cols-6 py-3 ">
            <div class="col-span-3 text-xl  text-black">Event Name</div>
            <div class="col-span-1 text-xl  text-black">Status</div>
            <div class="col-span-2 text-right pr-12 text-xl  text-black">Action</div>
        </div>

        <!-- Services Loop -->
        <div class="divide-y divide-gray-200">
            @php
                $services = [
                    [
                        'name' => 'Camel Camp',
                        'location' => 'Jumeirah Beach Residence',
                        'image' =>
                            'https://images.unsplash.com/photo-1544498522-6b0f1a90c0a3?q=80&w=2070&auto=format&fit=crop',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Single Buggy Ride',
                        'location' => 'Jumeirah Beach Residence',
                        'image' =>
                            'https://images.unsplash.com/photo-1541094892418-e395383501a3?q=80&w=2070&auto=format&fit=crop',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Aura Sky Pool',
                        'location' => 'Jumeirah Beach Residence',
                        'image' =>
                            'https://images.unsplash.com/photo-1596426543167-7b83c2a38622?q=80&w=2071&auto=format&fit=crop',
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Aura Sky Pool',
                        'location' => 'Jumeirah Beach Residence',
                        'image' =>
                            'https://images.unsplash.com/photo-1596426543167-7b83c2a38622?q=80&w=2071&auto=format&fit=crop',
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Aura Sky Pool',
                        'location' => 'Jumeirah Beach Residence',
                        'image' =>
                            'https://images.unsplash.com/photo-1596426543167-7b83c2a38622?q=80&w=2071&auto=format&fit=crop',
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Aura Sky Pool',
                        'location' => 'Jumeirah Beach Residence',
                        'image' =>
                            'https://images.unsplash.com/photo-1596426543167-7b83c2a38622?q=80&w=2071&auto=format&fit=crop',
                        'status' => 'inactive',
                    ],
                    [
                        'name' => 'Aura Sky Pool',
                        'location' => 'Jumeirah Beach Residence',
                        'image' =>
                            'https://images.unsplash.com/photo-1596426543167-7b83c2a38622?q=80&w=2071&auto=format&fit=crop',
                        'status' => 'inactive',
                    ],
                ];
            @endphp

            @foreach ($services as $service)
                <div class="grid grid-cols-6 items-center py-4  transition">
                    <!-- Service Info -->
                    <div class="flex items-center col-span-3 space-x-4">
                        <input type="checkbox"
                            class="w-4 h-4 text-[#C7AE6A] border-gray-300 border-2! rounded focus:ring-[#C7AE6A]">
                        <div class="w-26 h-26 overflow-hidden rounded-sm shadow-sm">
                            <img src="{{ $service['image'] }}" alt="{{ $service['name'] }}"
                                class="object-cover w-full h-full">
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 text-xl">{{ $service['name'] }}</div>
                            <div class="my-5"></div>
                            <div class="flex items-center text-xs text-black">
                                <svg class="w-4 h-4 mr-1 text-black" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $service['location'] }}
                            </div>
                        </div>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="col-span-1 relative w-32 text-center">
                        <div class="w-20 h-[40px] bg-[#F4F4F4] items-center pt-1">
                            <select
                                class="block w-full text-center  px-2 py-2 text-[10px] text-black font-medium  rounded-sm appearance-none focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="active" {{ $service['status'] === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive" {{ $service['status'] === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                            <!-- Status indicator (green circle) -->
                            <span
                                class="absolute left-3 bottom-2 transform -translate-y-1/2 w-2 h-2 rounded-full {{ $service['status'] === 'active' ? 'bg-lime-500' : 'bg-gray-400' }}"></span>

                            <!-- Dropdown arrow -->
                            <div class="absolute right-14 top-3.5  text-black pointer-events-none">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end col-span-2 space-x-1.5">
                        <button
                            class="bg-[#C7AE6A] hover:bg-[#b99b52] text-black px-4 py-2 rounded-sm flex items-center text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Edit
                        </button>
                        <button class="text-[#C7AE6A] p-1 hover:text-[#b99b52]">
                            <svg class="w-5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </button>
                        <button class="text-[#C7AE6A] p-1 hover:text-[#b99b52]">
                            <svg class="w-5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="border-t border-gray-200"></div>
    <!-- Added pagination component matching the design from the image -->
    <div class="flex items-center justify-center space-x-2 my-9">
        <!-- Previous Button (disabled) -->
        <button class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed" disabled>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- Page Numbers -->
        <!-- Current Page (1) -->
        <button class="flex items-center justify-center w-8 h-8 rounded border-2 border-[#C7AE6A] bg-[#C7AE6A] text-white font-medium text-sm">
            1
        </button>

        <!-- Page 2 -->
        <button class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">
            2
        </button>

        <!-- Ellipsis -->
        <span class="flex items-center justify-center w-8 h-8 text-gray-500 text-sm">
            ...
        </span>

        <!-- Page 9 -->
        <button class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">
            9
        </button>

        <!-- Page 10 -->
        <button class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">
            10
        </button>

        <!-- Next Button -->
        <button class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
</section>
