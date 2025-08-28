<main class="font-family">

    <div class="#">
        <div class="w-[1200px] mx-auto p-4 mt-5">
            <h2 class=" font-medium text-3xl text-black mb-4 ">User Management</h2>
            <div class="overflow-hidden">
                <!-- Table Container: Adds horizontal scroll for small devices if needed -->
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal hidden sm:table">
                        <thead>
                            <tr class="bg-[#e7e7e7] text-black font-medium ">
                                <th class="p-4 text-left font-medium text-base ">ID</th>
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
                        <tbody class="text-balck text-sm
                        ">
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
                                <flux:icon name="cog-6-tooth" class="text-[#C7AE6A]" />
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">

                                        <div class="flex justify-center">
                                            <div class="absolute inline-block text-left">
                                                <!-- Trigger Button -->
                                                <button id="dropdownBtn"
                                                    class="-mt-1 text-[#AD8945]  rounded-full focus:outline-none"
                                                    title="Settings">
                                                    <!-- Settings Icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>

                                                </button>

                                                <!-- Dropdown Menu -->
                                                <div id="dropdownMenu"
                                                    class="hidden absolute right-3 -mt-1 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">

                                                    <button
                                                        class="w-full flex items-center px-3 text-sm hover:bg-gray-100 cursor-pointer">
                                                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M11 4H4a2 2 0 0 0-2 2v14l4-4h9a2 2 0 0 0 2-2v-2M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" />
                                                        </svg>
                                                        Edit
                                                    </button>

                                                    <button
                                                        class="w-full flex items-center px-3 py-2 text-sm hover:bg-gray-100 cursor-pointer">


                                                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m5 13 4 4L19 7" />
                                                        </svg>
                                                        Active
                                                    </button>

                                                    <button
                                                        class="w-full flex items-center px-3 py-2 text-sm hover:bg-gray-100 cursor-pointer">
                                                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <circle cx="12" cy="12" r="10" />
                                                        </svg>
                                                        Deactivate
                                                    </button>

                                                    <button
                                                        class="w-full flex items-center px-3 py-2 text-sm text-red-600 hover:bg-red-50 cursor-pointer">
                                                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M3 6h18M9 6v12a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V6m-6 0V4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
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
<script>
    const dropdownBtn = document.getElementById("dropdownBtn");
    const dropdownMenu = document.getElementById("dropdownMenu");

    dropdownBtn.addEventListener("click", () => {
        dropdownMenu.classList.toggle("hidden");
    });

    document.addEventListener("click", (e) => {
        if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add("hidden");
        }
    });
</script>
