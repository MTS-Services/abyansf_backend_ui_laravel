<main>

    <div class="#">
        <div class="w-[1200px] mx-auto p-4 mt-10">
            <h2 class=" font-medium text-3xl text-black mb-8">User Management</h2>
            <div class="overflow-hidden">
                <!-- Table Container: Adds horizontal scroll for small devices if needed -->
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal hidden sm:table">
                        <thead>
                            <tr class="bg-[#e7e7e7] text-black font-medium ">
                                <th class="p-4 text-left font-medium text-base">ID</th>
                                <th class="p-4 text-left font-medium text-base">Name</th>
                                <th class="p-4 text-left font-medium text-base">Email</th>
                                <th class="p-4 text-left font-medium text-base">Number</th>
                                <th class="p-4 text-left font-medium text-base">Join Date</th>
                                <th class="p-4 text-left font-medium text-base">Password</th>
                                <th class="p-4 text-left font-medium text-base">Status</th>
                                <th class="p-4 text-left font-medium text-base">Payment Link</th>
                                <th class="p-4 text-center font-medium text-base">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-balck text-sm ">
                            <!-- Desktop row 1 -->
                            <tr class="#">
                                <td class="p-4 text-left whitespace-nowrap font-normal">01</td>
                                <td class="p-4 text-left font-normal text-base">John</td>
                                <td class="p-4 text-left font-normal text-base">john@gmail.com</td>
                                <td class="p-4 text-left font-normal text-base">+6842341354</td>
                                <td class="p-4 text-left font-normal text-base">01/05/2025</td>
                                <td class="p-4 text-left font-normal text-base">**********</td>
                                <td class="p-4 text-left font-normal text-base">Pending</td>
                                <td class="p-4 text-left font-normal text-base">
                                    <a href="#" class="text-[#AD8945] ">Send</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-[#AD8945] hover:text-blue-700" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="text-[#AD8945] hover:text-green-700" title="Confirm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="text-[#AD8945] hover:text-red-700" title="Delete">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>

                                        </button>
                                        <button class="text-[#AD8945] hover:text-red-700" title="Delete">
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
                            <!-- Desktop row 2 -->
                            <tr class="pl-2">
                                <td class="p-4 text-left whitespace-nowrap font-normal">01</td>
                                <td class="p-4 text-left font-normal text-base">John</td>
                                <td class="p-4 text-left font-normal text-base">john@gmail.com</td>
                                <td class="p-4 text-left font-normal text-base">+6842341354</td>
                                <td class="p-4 text-left font-normal text-base">01/05/2025</td>
                                <td class="p-4 text-left font-normal text-base">**********</td>
                                <td class="p-4 text-left font-normal text-base">Pending</td>
                                <td class="p-4 text-left font-normal text-base">
                                    <a href="#" class="text-[#AD8945] ">Send</a>
                                </td>
                                <td class="py-3 px-6 text-center pl-12">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-[#AD8945] hover:text-blue-700" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <button class="text-[#AD8945]  hover:text-red-700" title="Delete">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>

                                        </button>
                                        <button class="text-[#AD8945] hover:text-red-700" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
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
