<main>

    <div class="p-4 md:p-8">
        <div class="sm:max-w-7xl lg:w-[1200px] mx-auto  lg:pr-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">User Management</h2>
            <div class="  overflow-hidden">
                <!-- Table Container: Adds horizontal scroll for small devices if needed -->
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal hidden sm:table">
                        <thead>
                            <tr class="bg-[#e7e7e7] text-gray-600 uppercase text-sm leading-normal font-bold">
                                <th class="py-4 px-6 text-left">ID</th>
                                <th class="py-4 px-6 text-left">Name</th>
                                <th class="py-4 px-6 text-left">Email</th>
                                <th class="py-4 px-6 text-left">Number</th>
                                <th class="py-4 px-6 text-left">Join Date</th>
                                <th class="py-4 px-6 text-left">Password</th>
                                <th class="py-4 px-6 text-left">Status</th>
                                <th class="py-4 px-6 text-left">Payment Link</th>
                                <th class="py-4 px-6 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-bold">
                            <!-- Desktop row 1 -->
                            <tr class="hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">01</td>
                                <td class="py-3 px-6 text-left">John</td>
                                <td class="py-3 px-6 text-left">john@gmail.com</td>
                                <td class="py-3 px-6 text-left">+6842341354</td>
                                <td class="py-3 px-6 text-left">01/05/2025</td>
                                <td class="py-3 px-6 text-left">**********</td>
                                <td class="py-3 px-6 text-left">Pending</td>
                                <td class="py-3 px-6 text-left">
                                    <a href="#" class="text-[#AD8945] hover:underline">Send</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-green-500 hover:text-green-700" title="Confirm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="text-blue-500 hover:text-blue-700" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Desktop row 2 -->
                            <tr class=" border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">02</td>
                                <td class="py-3 px-6 text-left">Jane</td>
                                <td class="py-3 px-6 text-left">jane@gmail.com</td>
                                <td class="py-3 px-6 text-left">+6842341354</td>
                                <td class="py-3 px-6 text-left">01/05/2025</td>
                                <td class="py-3 px-6 text-left">***********</td>
                                <td class="py-3 px-6 text-left">Confirmed</td>
                                <td class="py-3 px-6 text-left">
                                    <a href="#" class="text-[#AD8945] hover:underline">Send</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-green-500 hover:text-green-700" title="Confirm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="text-blue-500 hover:text-blue-700" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="sm:hidden p-4">
                    <!-- Mobile Card 1 -->
                    <div class="mobile-card-row">
                        <div class="mobile-card-cell" data-label="ID">
                            <span class="text-gray-800">01</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Name">
                            <span class="text-gray-800">John</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Email">
                            <span class="text-gray-800">john@gmail.com</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Number">
                            <span class="text-gray-800">+6842341354</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Join Date">
                            <span class="text-gray-800">01/05/2025</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Password">
                            <span class="text-gray-800">**********</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Status">
                            <span class="text-gray-800">Pending</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Payment Link">
                            <a href="#" class="text-blue-500 hover:underline">Send</a>
                        </div>
                        <div class="mobile-card-cell" data-label="Action">
                            <div class="flex items-center justify-end space-x-2 w-full">
                                <button class="text-green-500 hover:text-green-700" title="Confirm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="text-blue-500 hover:text-blue-700" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Card 2 -->
                    <div class="mobile-card-row">
                        <div class="mobile-card-cell" data-label="ID">
                            <span class="text-gray-800">02</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Name">
                            <span class="text-gray-800">Jane</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Email">
                            <span class="text-gray-800">jane@gmail.com</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Number">
                            <span class="text-gray-800">+6842341354</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Join Date">
                            <span class="text-gray-800">01/05/2025</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Password">
                            <span class="text-gray-800">***********</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Status">
                            <span class="text-gray-800">Confirmed</span>
                        </div>
                        <div class="mobile-card-cell" data-label="Payment Link">
                            <a href="#" class="text-blue-500 hover:underline">Send</a>
                        </div>
                        <div class="mobile-card-cell" data-label="Action">
                            <div class="flex items-center justify-end space-x-2 w-full">
                                <button class="text-green-500 hover:text-green-700" title="Confirm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="text-blue-500 hover:text-blue-700" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
