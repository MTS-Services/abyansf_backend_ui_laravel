

 <div class="bg-gray-50">
     <main class="sm:max-w-7xl lg:w-[1200px] mx-auto p-4 sm:p-6 lg:p-8 font-poppins">
         <div class="booking_h2">
             <h2 class="font-semibold mb-6 text-gray-900 text-2xl sm:text-3xl">Booking Management</h2>

             <!-- Filter Section -->
             <div class="bg-white p-4 sm:p-6 mb-6 sm:mb-8 rounded-lg shadow-sm">
                 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 items-end">
                     <div class="w-full">
                         <label for="user" class="block text-sm font-semibold text-gray-900 mb-1">User</label>
                         <select id="user" name="user"
                             class="w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-md shadow-sm">
                             <option>All Users</option>
                         </select>
                     </div>

                     <div class="w-full">
                         <label for="services" class="block text-sm font-semibold text-gray-700 mb-1">Services</label>
                         <select id="services" name="services"
                             class="w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-md shadow-sm">
                             <option>All Services</option>
                         </select>
                     </div>

                     <div class="w-full">
                         <label for="date" class="block text-sm font-semibold text-gray-700 mb-1">Date</label>
                         <input type="date" id="date" name="date"
                             class="w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-md shadow-sm">
                     </div>

                     <div class="w-full">
                         <button type="button"
                             class="font-playfair w-full px-6 py-3 border border-transparent rounded-md text-base font-medium text-black bg-[#C7AE6A] hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-900 transition-colors duration-200">
                             Apply Filters
                         </button>
                     </div>
                 </div>
             </div>



             <!-- Table Section -->
             <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                 <!-- Mobile Card View (hidden on desktop) -->
                 <div class="block lg:hidden">
                     <div class="divide-y divide-gray-200">
                         <!-- Mobile Card 1 -->
                         <div class="p-4 space-y-3">
                             <div class="flex justify-between items-start">
                                 <div>
                                     <p class="text-sm font-semibold text-gray-900">ID: 01</p>
                                     <p class="text-lg font-medium text-gray-900">John Doe</p>
                                 </div>
                                 <button class="text-[#AD8945] hover:text-red-500 transition-colors duration-200"
                                     title="Delete Booking">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path fill-rule="evenodd"
                                             d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                             clip-rule="evenodd" />
                                     </svg>
                                 </button>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600">Service</p>
                                 <p class="text-sm font-medium text-gray-900">Super Car Detail</p>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600">Date & Time</p>
                                 <p class="text-sm font-medium text-gray-900">01/06/2025 - 03/06/2025</p>
                                 <p class="text-xs text-gray-600">3:00 PM - 6:00 PM</p>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600 mb-1">Status</p>
                                 <select
                                     class="bg-gray-200 px-2 py-1 w-full text-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-lg shadow-sm">
                                     <option>Confirmed</option>
                                     <option>Pending</option>
                                     <option>Cancelled</option>
                                 </select>
                             </div>
                         </div>

                         <!-- Mobile Card 2 -->
                         <div class="p-4 space-y-3">
                             <div class="flex justify-between items-start">
                                 <div>
                                     <p class="text-sm font-semibold text-gray-900">ID: 02</p>
                                     <p class="text-lg font-medium text-gray-900">John Doe</p>
                                 </div>
                                 <button class="text-[#AD8945] hover:text-red-500 transition-colors duration-200"
                                     title="Delete Booking">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path fill-rule="evenodd"
                                             d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                             clip-rule="evenodd" />
                                     </svg>
                                 </button>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600">Service</p>
                                 <p class="text-sm font-medium text-gray-900">Super Car Detail</p>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600">Date & Time</p>
                                 <p class="text-sm font-medium text-gray-900">01/06/2025 - 03/06/2025</p>
                                 <p class="text-xs text-gray-600">3:00 PM - 6:00 PM</p>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600 mb-1">Status</p>
                                 <select
                                     class="bg-gray-200 px-2 py-1 w-full text-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-lg shadow-sm">
                                     <option>Confirmed</option>
                                     <option>Pending</option>
                                     <option>Cancelled</option>
                                 </select>
                             </div>
                         </div>

                         <!-- Mobile Card 3 -->
                         <div class="p-4 space-y-3">
                             <div class="flex justify-between items-start">
                                 <div>
                                     <p class="text-sm font-semibold text-gray-900">ID: 03</p>
                                     <p class="text-lg font-medium text-gray-900">John Doe</p>
                                 </div>
                                 <button class="text-[#AD8945] hover:text-red-500 transition-colors duration-200"
                                     title="Delete Booking">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path fill-rule="evenodd"
                                             d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                             clip-rule="evenodd" />
                                     </svg>
                                 </button>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600">Service</p>
                                 <p class="text-sm font-medium text-gray-900">Super Car Detail</p>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600">Date & Time</p>
                                 <p class="text-sm font-medium text-gray-900">01/06/2025 - 03/06/2025</p>
                                 <p class="text-xs text-gray-600">3:00 PM - 6:00 PM</p>
                             </div>
                             <div>
                                 <p class="text-sm text-gray-600 mb-1">Status</p>
                                 <select
                                     class="bg-gray-200 px-2 py-1 w-full text-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-lg shadow-sm">
                                     <option>Confirmed</option>
                                     <option>Pending</option>
                                     <option>Cancelled</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                 </div>



                 <!-- Desktop Table View (hidden on mobile) -->
                 <div class="hidden lg:block overflow-x-auto">
                     <table class="min-w-full leading-normal">
                         <thead>
                             <tr>
                                 <th
                                     class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                     ID</th>
                                 <th
                                     class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                     MEMBER</th>
                                 <th
                                     class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                     SERVICE</th>
                                 <th
                                     class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                     TIME & DATE</th>
                                 <th
                                     class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                     STATUS</th>
                                 <th
                                     class="px-5 py-3 border-b-2 border-gray-200 text-right text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                     ACTIONS</th>
                             </tr>
                         </thead>
                         <tbody>
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
                                         class="bg-gray-200 px-2 py-1 w-full text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-lg shadow-sm">
                                         <option>Confirmed</option>
                                         <option>Pending</option>
                                         <option>Cancelled</option>
                                     </select>
                                 </td>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                     <button class="text-[#AD8945] hover:text-red-500 transition-colors duration-200"
                                         title="Delete Booking">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             fill="currentColor">
                                             <path fill-rule="evenodd"
                                                 d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                                 clip-rule="evenodd" />
                                         </svg>
                                     </button>
                                 </td>
                             </tr>
                             <tr>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                     <p class="text-gray-900 whitespace-nowrap">02</p>
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
                                         class="bg-gray-200 px-2 py-1 w-full text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-lg shadow-sm">
                                         <option>Confirmed</option>
                                         <option>Pending</option>
                                         <option>Cancelled</option>
                                     </select>
                                 </td>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                     <button class="text-[#AD8945] hover:text-red-500 transition-colors duration-200"
                                         title="Delete Booking">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             fill="currentColor">
                                             <path fill-rule="evenodd"
                                                 d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                                 clip-rule="evenodd" />
                                         </svg>
                                     </button>
                                 </td>
                             </tr>
                             <tr>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                     <p class="text-gray-900 whitespace-nowrap">03</p>
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
                                         class="bg-gray-200 px-2 py-1 w-full text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-lg shadow-sm">
                                         <option>Confirmed</option>
                                         <option>Pending</option>
                                         <option>Cancelled</option>
                                     </select>
                                 </td>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                     <button class="text-[#AD8945] hover:text-red-500 transition-colors duration-200"
                                         title="Delete Booking">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             fill="currentColor">
                                             <path fill-rule="evenodd"
                                                 d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                                 clip-rule="evenodd" />
                                         </svg>
                                     </button>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </main>
 </div>

 