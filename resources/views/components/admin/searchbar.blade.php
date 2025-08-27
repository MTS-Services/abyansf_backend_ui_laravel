@props(['page' => '']) {{-- default "listing" --}}

<div class="flex flex-col md:flex-row md:items-center md:space-x-4 mt-10 px-4 md:px-0">
    <!-- Dropdown -->
    <div class="relative w-full md:w-1/4 mb-4 md:mb-0">
        <select class="block w-full font-semibold text-sm md:text-base px-4 py-2 text-gray-700 bg-[#F4F4F4] border border-gray-50 rounded-sm appearance-none focus:outline-none focus:ring-2 focus:ring-gray-300 custom-shadow">
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

    <!-- Search Bar -->
   <div class="relative flex-grow mb-4 md:mb-0 max-w-full ">
    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>
    <input 
        type="text" 
        placeholder="Search by services" 
        class="block font-semibold text-sm w-full lg:max-w-[600px] md:text-base px-4 py-2 pl-14 text-gray-700 bg-[#F4F4F4] border border-gray-50 rounded-sm focus:outline-none focus:ring-2 focus:ring-gray-300 custom-shadow"
    />
</div>


    <!-- Button -->
    <button class="flex items-center justify-center text-sm lg:text-base font-medium text-black px-4 py-2 rounded-sm hover:bg-[#b99b52] bg-[#C7AE6A] focus:outline-none focus:ring-2 focus:ring-amber-500 custom-shadow w-full sm:w-[120px] md:w-[132px] xl:w-[150px]">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        {{ ucfirst($page) }}
    </button>
</div>
