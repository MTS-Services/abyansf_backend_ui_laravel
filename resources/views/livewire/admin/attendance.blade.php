<div class="container mx-auto px-4 py-6 max-w-[1200px] space-y-6 font-poppins">
    <div class="mb-4 mt-12">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Attendance</h1>
    </div>

    <div class="bg-white rounded-lg max-w-[1200px] min-h-[60px] relative z-10 py-7">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-sm lg:text-base font-semibold text-black mb-2">User</label>
                <select
                    class="w-full border-b border-black text-base font-poppins bg-transparent focus:outline-none focus:border-[#C7AE6A]">
                    <option>All Users</option>
                    <option>Khalid Omar Al-Mansouri</option>
                    <option>Other User</option>
                </select>
            </div>

            <div>
                <label class="block text-sm lg:text-base font-medium text-black mb-2">Services</label>
                <select
                    class="w-full border-b border-black text-base font-poppins bg-transparent focus:outline-none focus:border-[#C7AE6A]">
                    <option>All Services</option>
                    <option>Breakfast</option>
                    <option>Lunch</option>
                    <option>Dinner</option>
                </select>
            </div>

            <div>
                <label class="block text-sm lg:text-base font-medium text-black mb-2">Date</label>
                <input type="date"
                    class="w-full border-b border-gray-400 text-base font-poppins bg-transparent focus:outline-none focus:border-[#C7AE6A]"
                    placeholder="dd/mm/yyyy">
            </div>

            <div>
                <button
                    class="w-full bg-[#C7AE6A] hover:bg-[#b49a5e] text-black text-sm font-playfair py-4 px-4 rounded-md transition-colors duration-200">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    @php
        // Dummy data
        $attendances = [
            [
                'id' => '01',
                'name' => 'Khalid Omar Al-Mansouri',
                'service' => 'Breakfast',
                'location' => 'Jumeirah Beach Residence',
                'date' => '01/06/2025',
                'time' => '3:00 PM - 4:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '02',
                'name' => 'Ali Hassan',
                'service' => 'Lunch',
                'location' => 'Dubai Marina',
                'date' => '02/06/2025',
                'time' => '12:00 PM - 1:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '03',
                'name' => 'Fatima Noor',
                'service' => 'Dinner',
                'location' => 'Downtown Dubai',
                'date' => '03/06/2025',
                'time' => '7:00 PM - 8:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '04',
                'name' => 'Khalid Omar Al-Mansouri',
                'service' => 'Breakfast',
                'location' => 'Jumeirah Beach Residence',
                'date' => '01/06/2025',
                'time' => '3:00 PM - 4:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '05',
                'name' => 'Ali Hassan',
                'service' => 'Lunch',
                'location' => 'Dubai Marina',
                'date' => '02/06/2025',
                'time' => '12:00 PM - 1:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '06',
                'name' => 'Fatima Noor',
                'service' => 'Dinner',
                'location' => 'Downtown Dubai',
                'date' => '03/06/2025',
                'time' => '7:00 PM - 8:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '07',
                'name' => 'Khalid Omar Al-Mansouri',
                'service' => 'Breakfast',
                'location' => 'Jumeirah Beach Residence',
                'date' => '01/06/2025',
                'time' => '3:00 PM - 4:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '08',
                'name' => 'Ali Hassan',
                'service' => 'Lunch',
                'location' => 'Dubai Marina',
                'date' => '02/06/2025',
                'time' => '12:00 PM - 1:00 PM',
                'status' => 'Confirmed',
            ],
            [
                'id' => '09',
                'name' => 'Fatima Noor',
                'service' => 'Dinner',
                'location' => 'Downtown Dubai',
                'date' => '03/06/2025',
                'time' => '7:00 PM - 8:00 PM',
                'status' => 'Confirmed',
            ],
        ];
    @endphp

    <div class="bg-white rounded-lg w-full overflow-hidden mt-4 lg:mt-8 mb-4 lg:mb-10">
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead class="border-b-2 border-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left text-base font-medium text-black">ID</th>
                        <th class="px-4 py-3 text-left text-base font-medium text-black">Name</th>
                        <th class="px-4 py-3 text-left text-base font-medium text-black">Service</th>
                        <th class="px-4 py-3 text-left text-base font-medium text-black">Location</th>
                        <th class="px-4 py-3 text-left text-base font-medium text-black">Date</th>
                        <th class="px-4 py-3 text-left text-base font-medium text-black">Time</th>
                        <th class="px-4 py-3 text-left text-base font-medium text-black">Client Status</th>
                        <th class="px-4 py-3 text-left text-base font-medium text-black">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300 ">
                    @foreach ($attendances as $attendance)
                        <tr class="border-b-2 border-gray-300">
                            <td class="px-4 py-6 text-sm text-gray-900">{{ $attendance['id'] }}</td>
                            <td class="px-4 py-6 text-sm text-gray-900">{{ $attendance['name'] }}</td>
                            <td class="px-4 py-6 text-sm text-gray-900">{{ $attendance['service'] }}</td>
                            <td class="flex px-4 py-6 text-sm text-gray-900 items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                                </svg>
                                {{ $attendance['location'] }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $attendance['date'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $attendance['time'] }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex px-2 py-1 text-xs rounded-full
                                    @if ($attendance['status'] === 'Confirmed') bg-[#22C55E] text-black
                                    @elseif($attendance['status'] === 'Pending') bg-yellow-400 text-black
                                    @else bg-red-400 text-white @endif">
                                    {{ $attendance['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <button class="text-[#C7AE6A]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
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

        <div class="md:hidden divide-y divide-gray-200 mt-4">
            @foreach ($attendances as $attendance)
                <div x-data="{ open: false }" class="p-4">
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">{{ $attendance['name'] }}</h3>
                            <p class="text-xs text-gray-500">ID: {{ $attendance['id'] }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span
                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if ($attendance['status'] === 'Confirmed') bg-[#22C55E] text-black
                                @elseif($attendance['status'] === 'Pending') bg-yellow-400 text-black
                                @else bg-red-400 text-white @endif">
                                {{ $attendance['status'] }}
                            </span>
                            <button @click="open = !open" class="text-gray-600">
                                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 12H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div x-show="open" x-cloak class="mt-3 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Service:</span>
                            <span class="text-gray-900">{{ $attendance['service'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Location:</span>
                            <span class="flex items-center gap-2 text-black">
                                <svg class="w-5 h-5 text-[#231F20]" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                                </svg>
                                {{ $attendance['location'] }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Date:</span>
                            <span class="text-gray-900">{{ $attendance['date'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Time:</span>
                            <span class="text-gray-900">{{ $attendance['time'] }}</span>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button class="text-[#C7AE6A]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 112 0v6a1 1 0 11-2 0V8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
