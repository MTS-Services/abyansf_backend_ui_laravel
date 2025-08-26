<div class="container mx-auto px-4 py-6 max-w-[1200px] space-y-6">
    <!-- Header -->
    <div class="mb-4">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Attendance</h1>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-lg p-4 md:p-6 max-w-[1200px] min-h-[60px] relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <!-- User Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">User</label>
                <select class="w-full border-b border-gray-400 bg-transparent focus:outline-none focus:border-blue-500">
                    <option>All Users</option>
                    <option>Khalid Omar Al-Mansouri</option>
                    <option>Other User</option>
                </select>
            </div>

            <!-- Services Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Services</label>
                <select class="w-full border-b border-gray-400 bg-transparent focus:outline-none focus:border-blue-500">
                    <option>All Services</option>
                    <option>Breakfast</option>
                    <option>Lunch</option>
                    <option>Dinner</option>
                </select>
            </div>

            <!-- Date Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="date" class="w-full border-b border-gray-400 bg-transparent focus:outline-none focus:border-blue-500" placeholder="dd/mm/yyyy">
            </div>

            <!-- Apply Filters Button -->
            <div>
                <button class="w-full bg-[#C7AE6A] hover:bg-[#b49a5e] text-gray-800 font-medium py-2 px-4 rounded-md transition-colors duration-200">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg w-full overflow-hidden mt-4 lg:mt-8">
        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full">
                <thead class="border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Client Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">01</td>
                        <td class="px-6 py-4 text-sm text-gray-900">Khalid Omar Al-Mansouri</td>
                        <td class="px-6 py-4 text-sm text-gray-900">Breakfast</td>
                        <td class="flex px-6 py-4 text-sm text-gray-900 items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4.5 8-12c0-4.418-3.582-8-8-8s-8 3.582-8 8c0 7.5 8 12 8 12z"/>
                            </svg>
                            Jumeirah Beach Residence
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">01/06/2025</td>
                        <td class="px-6 py-4 text-sm text-gray-900">3:00 PM - 4:00 PM</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-regular rounded-full bg-[#22C55E] text-black">Confirmed</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <button class="text-[#C7AE6A]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22m-5-4H6a1 1 0 00-1 1v1h16V4a1 1 0 00-1-1z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards (Accordion) -->
        <div class="lg:hidden divide-y divide-gray-200 mt-4">
            <div x-data="{ open: false }" class="p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">Khalid Omar Al-Mansouri</h3>
                        <p class="text-xs text-gray-500">ID: 01</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-[#22C55E] text-black">Confirmed</span>
                        <button @click="open = !open" class="text-gray-600">
                            <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div x-show="open" x-cloak class="mt-3 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Service:</span>
                        <span class="text-gray-900">Breakfast</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Location:</span>
                        <span class="flex items-center gap-2 text-gray-900">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4.5 8-12c0-4.418-3.582-8-8-8s-8 3.582-8 8c0 7.5 8 12 8 12z"/>
                            </svg>
                            Jumeirah Beach Residence
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Date:</span>
                        <span class="text-gray-900">01/06/2025</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Time:</span>
                        <span class="text-gray-900">3:00 PM - 4:00 PM</span>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button class="text-[#C7AE6A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22m-5-4H6a1 1 0 00-1 1v1h16V4a1 1 0 00-1-1z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
