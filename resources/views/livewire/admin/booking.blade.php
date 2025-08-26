<main class="container mx-auto p-4 sm:p-6 lg:p-8 max-w-7xl">

    <div class="booking_h2">
        <h2 class="text-2xl font-medium mb-6 text-gray-800">Booking Management</h2>

        <!-- Filter Section -->
        <div
            class="bg-white p-6 rounded-lg shadow-sm mb-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">

            <!-- User -->
            <div class="w-full">
                <label for="user" class="block text-sm font-medium text-gray-700">User</label>
                <select id="user" name="user"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-black focus:border-black sm:text-sm rounded-md shadow-sm">
                    <option>All Users</option>
                </select>
            </div>

            <!-- Services -->
            <div class="w-full">
                <label for="services" class="block text-sm font-medium text-gray-700">Services</label>
                <select id="services" name="services"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-black focus:border-black sm:text-sm rounded-md shadow-sm">
                    <option>All Services</option>
                </select>
            </div>

            <!-- Date -->
            <div class="w-full">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <div class="relative mt-1">
                    <input type="date" id="date" name="date"
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-black focus:border-black sm:text-sm rounded-md shadow-sm">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="w-full lg:w-auto">
                <button type="button"
                    class="w-full px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#C7AE6A] hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-900 transition-colors duration-200">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-sm overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            MEMBER</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            SERVICE</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            TIME & DATE</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            STATUS</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row Example -->
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-nowrap">01</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-nowrap">John Doe</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-nowrap">Super Car Detail</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-nowrap">01/06/2025 - 03/06/2025</p>
                            <p class="text-gray-600 whitespace-nowrap text-xs mt-1">3:00 PM - 6:00 PM</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <select
                                class="block w-full text-base border-gray-300 focus:outline-none focus:ring-black focus:border-black sm:text-sm rounded-md shadow-sm">
                                <option>Confirmed</option>
                                <option>Pending</option>
                                <option>Cancelled</option>
                            </select>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button class="text-gray-600 hover:text-red-500 transition-colors duration-200"
                                    title="Delete Booking">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Repeat more rows... -->
                </tbody>
            </table>
        </div>


    </div>
</main>
