<section class="font-playfair">

    <h2 class="font-medium mt-6 mb-6 font-playfair text-black text-2xl sm:text-3xl">Booking Management</h2>

    <div class="mb-5">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-base lg:text-base font-semibold text-[#5D5D5D] mb-2">User</label>
                <select
                    class="w-full border-b border-gray-400 text-[#5D5D5D] text-base font-normal font-poppins bg-transparent focus:outline-none focus:border-blue-500">
                    <option>All Users</option>
                </select>
            </div>

            <div>
                <label class="block text-base lg:text-base font-semibold text-[#5D5D5D] mb-2">Services</label>
                <select
                    class="w-full border-b border-gray-400 text-[#5D5D5D] text-base font-normal font-poppins bg-transparent focus:outline-none focus:border-blue-500">
                    <option>All Services</option>
                </select>
            </div>

            <div>
                <label class="block text-base lg:text-base font-semibold text-[#5D5D5D] mb-2 text-[#5D5D5D]">Date</label>
                <input type="date"
                    class="w-full border-b border-gray-400 text-[#5D5D5D] text-base font-normal font-poppins bg-transparent focus:outline-none focus:border-blue-500"
                    placeholder="dd/mm/yyyy">
            </div>

            <div>
                <button
                    class="w-full bg-[#C7AE6A] hover:bg-[#b49a5e] text-black font-medium font-playfair text-base py-4 px-4 rounded-md transition-colors duration-200">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>


    {{-- <div class="block md:hidden">
            <div class="divide-y divide-gray-200">

                <div class="p-4 space-y-3" x-data="{ open: false, status: '{{ $booking['status'] }}' }">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold text-black">ID: {{ $booking['id'] }}</p>
                            <p class="text-base font-poppins font-normal text-black">
                                {{ $booking['member'] }}</p>
                        </div>
                        <button @click="open = !open" class="text-[#AD8945] transition-transform duration-200">
                            <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                    </div>

                    <div x-show="open" class="space-y-3 pt-2" x-transition>
                        <div>
                            <p class="text-sm text-gray-600">Service</p>
                            <p class="text-sm font-medium text-black">{{ $booking['service'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Date & Time</p>
                            <p class="text-sm font-medium text-black">{{ $booking['date'] }}</p>
                            <p class="text-xs text-gray-600">{{ $booking['time'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Status</p>
                            <select x-model="status"
                                class="bg-gray-200 px-2 py-1 w-full text-sm border font-poppins border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-black rounded-lg shadow-sm">
                                <option value="Confirmed">Confirmed</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="pt-2">
                            <button
                                class="w-full bg-[#C7AE6A] text-black py-2 rounded-md font-playfair hover:bg-[#b49a5e] transition-colors duration-200">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div> --}}

    <div class="overflow-x-auto md:overflow-x-visible">
        <table class="leading-normal table">
            <thead>
                <tr class="bg-[#e7e7e7] text-black font-medium">
                    <th class="p-4 text-left font-medium text-base"> SL </th>
                    <th class="p-4 text-left font-medium text-base">MEMBER</th>
                    <th class="p-4 text-left font-medium text-base">SERVICE</th>
                    <th class="p-4 text-left font-medium text-base">TIME & DATE</th>
                    <th class="p-4 text-left font-medium text-base">STATUS</th>

                    <th class="p-4 text-right font-medium text-base">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($bookings) --}}
                @foreach ($bookings as $booking)
                    <tr wire:key="booking-{{ $booking['id'] }}" x-data="{ dropdownOpen: false }"
                        class="border-b border-gray-200">
                        <td class="p-4 text-left font-normal font-playfair text-base">
                            <p class="text-black whitespace-nowrap">{{ $loop->iteration }}</p>
                        </td>

                        <td class="p-4 text-left font-normal font-playfair text-base">
                            <p class="text-black whitespace-nowrap font-playfair font-normal ">
                                {{ $booking['customerInfo']['name'] ?? 'N/A' }}</p>
                        </td>
                        <td class="p-4 text-left font-normal font-playfair text-base">
                            @if ($booking['type'] === 'listing' && !empty($booking['listing']['name']))
                                <p class="text-black whitespace-nowrap font-playfair font-normal ">
                                    {{ $booking['listing']['name'] }}
                                </p>
                            @elseif($booking['type'] === 'subcategory')
                                @if (!empty($booking['subCategory']['name']))
                                    <p class="text-black whitespace-nowrap font-playfair font-normal ">
                                        {{ $booking['subCategory']['name'] }}
                                    </p>
                                @elseif(!empty($booking['miniSubCategory']['name']))
                                    <p class="text-black whitespace-nowrap font-playfair font-normal ">
                                        {{ $booking['miniSubCategory']['name'] }}
                                    </p>
                                @endif
                            @endif
                        </td>


                        <td class="p-4 text-left font-normal font-playfair text-base">
                            @if ($booking['type'] === 'listing')
                                @if (!empty($booking['bookingDate']))
                                    <p class="text-black whitespace-nowrap font-playfair font-normal ">
                                        Booking Date:
                                        {{ \Carbon\Carbon::parse($booking['bookingDate'])->format('d/m/Y') }}
                                    </p>
                                @endif

                                @if (!empty($booking['bookingTime']))
                                    <p class="font-playfair font-normal text-black whitespace-nowrap text-xs mt-1">
                                        Booking Time:
                                        {{ $booking['bookingTime'] }}
                                    </p>
                                @endif
                            @elseif($booking['type'] === 'subcategory')
                                @if (!empty($booking['bookingInfo']['checkInDate']))
                                    <p class="text-black whitespace-nowrap font-playfair font-normal">
                                        Check-in:
                                        {{ \Carbon\Carbon::parse($booking['bookingInfo']['checkInDate'])->format('d/m/Y') }}
                                    </p>
                                @endif

                                @if (!empty($booking['bookingInfo']['checkOutDate']))
                                    <p class="text-black whitespace-nowrap font-playfair font-normal text-xs mt-1">
                                        Check-out:
                                        {{ \Carbon\Carbon::parse($booking['bookingInfo']['checkOutDate'])->format('d/m/Y') }}
                                    </p>
                                @endif
                            @endif
                        </td>

                        <td class="p-4 text-left font-normal text-base">
                            @php
                                $status = strtolower($booking['status']);
                                $statusClasses = match ($status) {
                                    'pending'
                                        => 'bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium',
                                    'confirmed'
                                        => 'bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium',
                                    'complete'
                                        => 'bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium',
                                    'cancelled' => 'bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium',
                                    default => 'bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium',
                                };
                            @endphp

                            <span class="{{ $statusClasses }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>

                        <td class="py-3 px-6 text-right">
                            <div class="relative inline-block text-left" x-data="{ open: false }"
                                x-on:click.outside="open = false">
                                <button x-on:click="open = ! open"
                                    class="-mt-1 text-[#AD8945] rounded-full focus:outline-none" title="Settings">
                                    <flux:icon name="cog-6-tooth" class="text-[#C7AE6A]" />
                                </button>

                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 md:right-3 -mt-1 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20 md:origin-top-right">
                                    

                                    <button wire:click="editBooking('{{ encrypt($booking['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Edit
                                    </button>
                                    <button wire:click="deleteBooking('{{ encrypt($booking['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</section>
