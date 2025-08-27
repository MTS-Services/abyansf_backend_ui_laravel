<section class="bg-white font-playfair">
    @php
        $bookings = [
            [
                'id' => '01',
                'member' => 'Jonh',
                'service' => 'Super Car',
                'date' => '01/06/2025 - 03/06/2025',
                'time' => '3:00 PM - 6:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '02',
                'member' => 'Jane Doe',
                'service' => 'Motorcycle',
                'date' => '05/06/2025 - 05/06/2025',
                'time' => '10:00 AM - 12:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '03',
                'member' => 'Peter Jones',
                'service' => 'Bike Care',
                'date' => '10/06/2025 - 11/06/2025',
                'time' => '9:00 AM - 1:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '04',
                'member' => 'Susan Miller',
                'service' => 'Truck Wash',
                'date' => '15/06/2025 - 15/06/2025',
                'time' => '2:00 PM - 5:00 PM',
                'status' => 'Confirmed',
            ],
        ];
    @endphp

    <section class="sm:max-w-7xl lg:w-[1200px] mx-auto p-4 font-poppins">
        <div class="booking_h2">
            <h2 class="font-semibold mb-6 text-balck text-2xl sm:text-3xl">Booking Management</h2>

            <div class="bg-white rounded-lg p-4  max-w-[1200px] min-h-[60px] relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm lg:text-base font-semibold text-gray-700 mb-2">User</label>
                        <select
                            class="w-full border-b border-gray-400 text-base font-poppins bg-transparent focus:outline-none focus:border-blue-500">
                            <option>All Users</option>
                            <option>Khalid Omar Al-Mansouri</option>
                            <option>Other User</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2">Services</label>
                        <select
                            class="w-full border-b border-gray-400 text-base font-poppins bg-transparent focus:outline-none focus:border-blue-500">
                            <option>All Services</option>
                            <option>Breakfast</option>
                            <option>Lunch</option>
                            <option>Dinner</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2">Date</label>
                        <input type="date"
                            class="w-full border-b border-gray-400 text-base font-poppins bg-transparent focus:outline-none focus:border-blue-500"
                            placeholder="dd/mm/yyyy">
                    </div>

                    <div>
                        <button
                            class="w-full bg-[#C7AE6A] hover:bg-[#b49a5e] text-black text-sm font-playfair  py-4 px-4 rounded-md transition-colors duration-200">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-6">
                <div class="block lg:hidden">
                    <div class="divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                            <div class="p-4 space-y-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-semibold text-balck">ID: {{ $booking['id'] }}</p>
                                        <p class="text-base font-poppins font-normal text-balck">
                                            {{ $booking['member'] }}</p>
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
                                    <p class="text-sm font-medium text-balck">{{ $booking['service'] }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Date & Time</p>
                                    <p class="text-sm font-medium text-balck">{{ $booking['date'] }}</p>
                                    <p class="text-xs text-gray-600">{{ $booking['time'] }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Status</p>
                                    <select
                                        class="bg-gray-200 px-2 py-1 w-full text-sm border font-poppins border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-lg shadow-sm">
                                        <option @if ($booking['status'] == 'Confirmed') selected @endif>Confirmed</option>
                                        <option @if ($booking['status'] == 'Pending') selected @endif>Pending</option>
                                        <option @if ($booking['status'] == 'Cancelled') selected @endif>Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3   text-left text-base font-semibold text-balck uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-5 py-3   text-left text-base font-semibold text-balck uppercase tracking-wider">
                                    MEMBER</th>
                                <th
                                    class="px-5 py-3   text-left text-base font-semibold text-balck uppercase tracking-wider">
                                    SERVICE</th>
                                <th
                                    class="px-5 py-3   text-left text-base font-semibold text-balck uppercase tracking-wider">
                                    TIME & DATE</th>
                                <th
                                    class="px-5 py-3   text-left text-base font-semibold text-balck uppercase tracking-wider">
                                    STATUS</th>
                                <th
                                    class="px-5 py-3   text-right text-base font-semibold text-balck uppercase tracking-wider">
                                    ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td class="px-5 py-5 border-b  bg-white text-sm">
                                        <p class="text-balck whitespace-nowrap">{{ $booking['id'] }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b  bg-white text-sm">
                                        <p class="text-balck whitespace-nowrap font-poppins font-normal">
                                            {{ $booking['member'] }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b  bg-white text-sm">
                                        <p class="text-balck whitespace-nowrap font-poppins font-normal">
                                            {{ $booking['service'] }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b  bg-white text-sm">
                                        <p class="text-balck whitespace-nowrap font-poppins font-normal">
                                            {{ $booking['date'] }}</p>
                                        <p class="font-poppins font-normal text-black whitespace-nowrap text-xs mt-1">
                                            {{ $booking['time'] }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b bg-white text-sm font-poppins">
                                        <div class="relative inline-block text-left booking-dropdown">
                                            <button type="button"
                                                class="bg-[#E7E7E7] text-black py-1 font-poppins pl-4 pr-10 rounded-full appearance-none leading-tight focus:outline-none focus:ring-2 focus:ring-black focus:border-black cursor-pointer shadow-sm w-32 booking-toggle">
                                                <span class="selected-status">{{ $booking['status'] }}</span>
                                                <div
                                                    class="pointer-events-none absolute -top-1.5 right-0 flex items-center px-2 text-black font-bold">
                                                    <svg class="fill-current h-7 w-7" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.293 12.95l-.707.707L12 16.207l3.707-3.707-.707-.707L12 14.793z" />
                                                    </svg>
                                                </div>
                                            </button>

                                            <ul class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-sm ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none booking-options"
                                                style="display: none;">
                                                @php
                                                    $statuses = ['Confirmed', 'Pending', 'Cancelled'];
                                                @endphp
                                                @foreach ($statuses as $status)
                                                    <li data-value="{{ $status }}"
                                                        class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9 hover:bg-gray-100 font-poppins">
                                                        {{ $status }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b  bg-white text-sm text-right">
                                        <button class="text-[#C7AE6A] hover:text-red-500 transition-colors duration-200"
                                            title="Delete Booking">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</section>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.booking-dropdown');

            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.booking-toggle');
                const optionsList = dropdown.querySelector('.booking-options');
                const selectedStatus = dropdown.querySelector('.selected-status');
                const options = optionsList.querySelectorAll('li');

                // Toggle dropdown visibility
                toggle.addEventListener('click', function() {
                    optionsList.style.display = optionsList.style.display === 'none' ? 'block' :
                        'none';
                });

                // Handle option selection
                options.forEach(option => {
                    option.addEventListener('click', function() {
                        const value = this.getAttribute('data-value');
                        selectedStatus.textContent = value;
                        optionsList.style.display = 'none';
                    });
                });

                // Close dropdown if clicked outside
                document.addEventListener('click', function(event) {
                    if (!dropdown.contains(event.target)) {
                        optionsList.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
