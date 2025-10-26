@props([
    'page' => '',
    'route' => null,
    'id' => '',
    'livewire_method' => null,
    'filter_method' => null,
    'categories' => null,
    'search' => true,
    'location' => true,
]) {{-- default "listing" --}}

<div class="flex flex-col  justify-between md:flex-row md:items-center md:space-x-4 mt-10 px-4 md:px-0 font-playfair">
    <!-- Dropdown -->
    <div class="relative w-full md:w-1/4 mb-4 md:mb-0">

        <select wire:model="specificCategoryId"
            class="block w-full font-semibold font-playfair text-sm md:text-base px-4 py-3 text-gray-700 bg-[#F4F4F4] rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] custom-shadow">
            <option value="" selected>Categories</option>
            @empty(!$categories)
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            @endempty
        </select>

        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>
    {{-- Search default is true, but if you don't need this just pass value :serach="fasle" as attribute in the component when you call --}}

    @if ($search)
        <!-- Search Bar -->
        <div class="relative flex-grow mb-4 md:mb-0 max-w-full rounded-sm ">
            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input wire:model="listing_name" type="text" placeholder="Search by name"
                class="block font-semibold  font-playfair text-sm w-full lg:max-w-[600px] md:text-base px-4 py-3 pl-14 text-gray-700 bg-[#F4F4F4]    rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] custom-shadow" />
        </div>
    @endif


    @if ($location)
        <!-- Location Serach Bar -->
        <div class="relative flex-grow mb-4 md:mb-0 max-w-full rounded-sm ">
            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input wire:model="location" type="text" placeholder="Search by Location"
                class="block font-semibold  font-playfair text-sm w-full lg:max-w-[600px] md:text-base px-4 py-3 pl-14 text-gray-700 bg-[#F4F4F4]    rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] custom-shadow" />
        </div>
    @endif

    <a id="{{ $id !== null ? $id : '' }}" {{ $filter_method !== null ? 'wire:click=' . $filter_method : '' }}
        class="flex items-center justify-center text-sm lg:text-base font-playfair cursor-pointer font-medium text-black px-4 py-2.5 rounded-sm hover:bg-[#b99b52] bg-[#C7AE6A] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] custom-shadow w-full sm:w-[120px] md:w-[132px] xl:w-[150px]">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        {{ __('Filter') }}
    </a>

    <!-- Button -->
    @if ($page)
        <a id="{{ $id !== null ? $id : '' }}" {{ $livewire_method !== null ? 'wire:click=' . $livewire_method : '' }}
            class="flex items-center justify-center cursor-pointer text-sm lg:text-base font-playfair font-medium text-black px-4 py-2.5 rounded-sm hover:bg-[#b99b52] bg-[#C7AE6A] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] custom-shadow w-full sm:w-[120px] md:w-[132px] xl:w-[150px]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            {{ ucfirst($page) }}
        </a>
    @endif
</div>
