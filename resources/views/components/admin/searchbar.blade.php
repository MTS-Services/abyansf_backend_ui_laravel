@props(['page' => '']) {{-- default "listing" --}}

<div class="flex items-center space-x-4 p-4">
    <!-- Service Dropdown -->
    <div class="relative w-[282px]">
        <select
            class="block w-full font-semibold text-base px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-sm appearance-none focus:outline-none focus:ring-2 focus:ring-gray-300 custom-shadow">
            <option value="Services" disabled selected>Services</option>
            <option value="Service 1">Service 1</option>
            <option value="Service 2">Service 2</option>
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    <!-- Search -->
    <div class="relative flex-grow">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <input type="text" placeholder="Search by services"
               class="block font-semibold text-base w-[668px] px-4 py-2 pl-10 text-gray-700 bg-gray-100 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-gray-300 custom-shadow"/>
    </div>

    <!-- Dynamic Button -->
    <button
        class="flex items-center text-base font-medium text-black px-4 py-2 rounded-sm hover:bg-[#e7ae12] bg-[#C7AE6A] focus:outline-none focus:ring-2 focus:ring-amber-500 custom-shadow">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        {{ ucfirst($page)  }}
    </button>
</div>
