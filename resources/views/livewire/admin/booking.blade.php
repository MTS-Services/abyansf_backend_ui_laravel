<section class="font-playfair">

    <h2 class="font-medium mt-6 mb-6 font-playfair text-black text-2xl sm:text-3xl">Booking Management</h2>

    <div class="mb-5">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-base lg:text-base font-semibold text-[#5D5D5D] mb-2">User</label>
                <input type="text" placeholder="Users/Email"
                    class="w-full border-b border-gray-400 text-[#5D5D5D] text-base font-normal font-poppins bg-transparent focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-base lg:text-base font-semibold text-[#5D5D5D] mb-2">Services</label>
                <input type="text" placeholder="All Services"
                    class="w-full border-b border-gray-400 text-[#5D5D5D] text-base font-normal font-poppins bg-transparent focus:outline-none focus:border-blue-500">
            </div>


            <div>
                <label
                    class="block text-base lg:text-base font-semibold text-[#5D5D5D] mb-2 text-[#5D5D5D]">Date</label>
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
                            <span
                                class="{{ [
                                    'pending' => 'bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium',
                                    'confirmed' => 'bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium',
                                    'cancelled' => 'bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium',
                                    'complete' => 'bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium',
                                ][strtolower($booking['status'] ?? '')] ?? 'bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium' }}">
                                {{ ucfirst($booking['status'] ?? '') }}
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


                                    @if ($booking['type'] === 'listing')
                                        <button wire:click="listingBookingDtls('{{ encrypt($booking['id']) }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                            <flux:icon name="eye" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            Details
                                        </button>
                                    @elseif($booking['type'] === 'subcategory')
                                        <button wire:click="editSubcategoryBooking('{{ encrypt($booking['id']) }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                            <flux:icon name="eye" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            Details
                                        </button>
                                    @endif
                                    @if ($booking['type'] === 'listing')
                                        <button wire:click="editListingBooking('{{ encrypt($booking['id']) }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                            <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            Edit
                                        </button>
                                    @elseif($booking['type'] === 'subcategory')
                                        <button wire:click="editSubcategoryBooking('{{ encrypt($booking['id']) }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                            <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            Edit
                                        </button>
                                    @endif
                                    @if ($booking['type'] === 'listing')
                                        <button wire:click="deleteListingBooking('{{ encrypt($booking['id']) }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                            <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            Delete
                                        </button>
                                    @elseif ($booking['type'] === 'subcategory')
                                        <button wire:click="deleteSubcategoryBooking('{{ encrypt($booking['id']) }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                            <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- listing booking details modal --}}
    <div x-data="{ show: @entangle('listingDetailsModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto">

        <div class="flex items-center justify-center min-h-screen px-4 py-8">

            <!-- Backdrop -->
            <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal">
            </div>

            <!-- Modal Content -->
            <div x-show="show" x-cloak x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-6 scale-95"
                class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full p-8 sm:p-10" wire:click.stop>

                <!-- Close Button -->
                <button wire:click="closeModal"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <!-- Header -->
                <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                    <img src="{{ $listingImage ?? 'https://via.placeholder.com/150' }}" alt="Listing Image"
                        class="w-20 h-20 rounded-lg object-cover shadow">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $listingName ?? 'Unknown Listing' }}</h2>
                        <p class="text-sm text-[#AD8945]">{{ $mainCategoryName ?? '' }}</p>
                    </div>
                </div>

                <!-- User & Booking Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Customer Name</label>
                        <p class="text-gray-800 font-semibold">{{ $name ?? '' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Email</label>
                        <p class="text-gray-800">{{ $email ?? '' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">WhatsApp</label>
                        <p class="text-gray-800">{{ $whatsapp ?? '' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Venue</label>
                        <p class="text-gray-800">{{ $venueName ?? '' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Service Type</label>
                        <p class="text-gray-800">{{ $typeofservice ?? '' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Guests</label>
                        <p class="text-gray-800">{{ $numberofguest_adult ?? 0 }} Adults,
                            {{ $numberofguest_child ?? 0 }} Children</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Booking Date</label>
                        <p class="text-gray-800">
                            {{ $bookingDate ? \Carbon\Carbon::parse($bookingDate)->format('d M Y') : '' }}
                        </p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Booking Time</label>
                        <p class="text-gray-800">
                            {{ $bookingTime ? \Carbon\Carbon::parse($bookingTime)->format('h:i A') : '' }}
                        </p>
                    </div>
                    <div class="mt-6 flex flex-wrap gap-3">
                        
                        @php $statusLower = strtolower($status ?? '') @endphp

                        <span
                            class="inline-flex items-center rounded-full px-4 py-2 text-sm font-medium
    {{ $statusLower === 'pending'
        ? 'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-600/20'
        : ($statusLower === 'confirmed'
            ? 'bg-green-50 text-green-700 ring-1 ring-green-600/20'
            : ($statusLower === 'cancelled'
                ? 'bg-red-50 text-red-700 ring-1 ring-red-600/20'
                : ($statusLower === 'complete'
                    ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-600/20'
                    : 'bg-gray-50 text-gray-600 ring-1 ring-gray-500/10'))) }}">
                            {{ ucfirst($status) }}
                        </span>


                    </div>
                </div>


                <!-- Footer -->
                <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end">
                    <button wire:click="closeModal"
                        class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#AD8945] to-amber-600 hover:from-[#9c7a3d] hover:to-amber-700 rounded-lg shadow transition transform hover:scale-[1.02]">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>


    {{-- listing modal --}}
    <div x-data="{ show: @entangle('listingBookingEditModal') }" x-show="show" x-cloak class="fixed inset-0 overflow-y-auto z-50">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 bg-opacity-50" wire:click="closeModal"></div>

            <div x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-xl shadow-lg max-w-5xl px-10 w-full p-6" wire:click.stop>

                <button wire:click="closeModal"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 rounded-full focus:outline-none">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <form wire:submit.prevent="updateListingBooking" class="mt-4 space-y-5">

                    <!-- Listing ID -->
                    <div>
                        <label for="listingId" class="block text-gray-700 text-sm font-medium mb-2">Listing
                            ID</label>
                        <input type="text" wire:model="listingId" id="listingId"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#C7AE6A]">
                    </div>

                    <div>
                        <label for="bookingDate" class="block text-gray-700 text-sm font-medium mb-2">Booking
                            Date</label>
                        <input type="date" wire:model="bookingDate" id="bookingDate"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div>
                        <label for="bookingTime" class="block text-gray-700 text-sm font-medium mb-2">Booking
                            Time</label>
                        <input type="time" wire:model="bookingTime" id="bookingTime"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div>
                        <label for="typeofservice" class="block text-gray-700 text-sm font-medium mb-2">Type of
                            Service</label>
                        <input type="text" wire:model="typeofservice" id="typeofservice"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div>
                        <label for="venueName" class="block text-gray-700 text-sm font-medium mb-2">Venue
                            Name</label>
                        <input type="text" wire:model="venueName" id="venueName"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div>
                        <label for="numberofguest_adult" class="block text-gray-700 text-sm font-medium mb-2">Number
                            of Adult Guests</label>
                        <input type="number" wire:model="numberofguest_adult" id="numberofguest_adult"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div>
                        <label for="numberofguest_child" class="block text-gray-700 text-sm font-medium mb-2">Number
                            of Child Guests</label>
                        <input type="number" wire:model="numberofguest_child" id="numberofguest_child"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div>
                        <label for="status" class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                        <select wire:model="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                            <option value="Confirmed">Confirmed</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Complete">Complete</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>

                    <div class="flex justify-center md:justify-start pt-6">
                        <button type="submit"
                            class="px-8 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-[#eec44f] transition-colors font-medium cursor-pointer">
                            <span wire:loading.remove wire:target="updateBooking">Save</span>
                            <span wire:loading wire:target="updateBooking">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- sub category modal --}}
    <div x-data="{ show: @entangle('subBookingEditModal') }" x-show="show" x-cloak class="fixed inset-0 overflow-y-auto z-50">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 bg-opacity-50" wire:click="closeModal"></div>

            <div x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-xl shadow-lg max-w-5xl px-10 w-full p-6" wire:click.stop>

                <button wire:click="closeModal"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 rounded-full focus:outline-none">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <form wire:submit.prevent="updateSubBooking" class="mt-4 space-y-5">

                    <!-- Sub Category -->
                    <div>
                        <label for="subCategoryId" class="block text-gray-700 text-sm font-medium mb-2">Sub
                            Category</label>
                        <input type="text" wire:model="subCategoryId" id="subCategoryId"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Type of Accommodation -->
                    <div>
                        <label for="typeOfAccommodation" class="block text-gray-700 text-sm font-medium mb-2">Type of
                            Accommodation</label>
                        <input type="text" wire:model="typeOfAccommodation" id="typeOfAccommodation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-gray-700 text-sm font-medium mb-2">Location</label>
                        <input type="text" wire:model="location" id="location"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Name of Hotel -->
                    <div>
                        <label for="nameOfHotel" class="block text-gray-700 text-sm font-medium mb-2">Name of
                            Hotel</label>
                        <input type="text" wire:model="nameOfHotel" id="nameOfHotel"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Check In Date -->
                    <div>
                        <label for="checkInDate" class="block text-gray-700 text-sm font-medium mb-2">Check-In
                            Date</label>
                        <input type="date" wire:model="checkInDate" id="checkInDate"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Check Out Date -->
                    <div>
                        <label for="checkOutDate" class="block text-gray-700 text-sm font-medium mb-2">Check-Out
                            Date</label>
                        <input type="date" wire:model="checkOutDate" id="checkOutDate"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Guests: Adults -->
                    <div>
                        <label for="guests_adults" class="block text-gray-700 text-sm font-medium mb-2">Number of
                            Adults</label>
                        <input type="number" wire:model="guests_adults" id="guests_adults"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Guests: Children -->
                    <div>
                        <label for="guests_children" class="block text-gray-700 text-sm font-medium mb-2">Number of
                            Children</label>
                        <input type="number" wire:model="guests_children" id="guests_children"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                        <select wire:model="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                            <option value="Confirmed">Confirmed</option>
                            <option value="Complete">Complete</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Contact -->
                    <div>
                        <label for="contact" class="block text-gray-700 text-sm font-medium mb-2">Contact</label>
                        <input type="text" wire:model="contact" id="contact"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-center md:justify-start pt-6">
                        <button type="submit"
                            class="px-8 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-[#eec44f] transition-colors font-medium cursor-pointer">
                            <span wire:loading.remove wire:target="updateListingBooking">Save</span>
                            <span wire:loading wire:target="updateListingBooking">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
