@props([
    'buttons' => [
                 [
                    'method' => 'switchAddCategoryModal',
                    'text' => 'Add',
                    'icon' => 'plus',
                    'id' => 'add_category_button',
                ]
              ],
    'fields' => [],
    'dropdowns' => [],
])

<div class="flex flex-col  justify-end md:flex-row md:items-center bg-white md:space-x-4 mt-10 px-4 md:px-0 font-playfair">

    <!-- Dropdown -->
    @foreach ($dropdowns as $dropdown)
        <div class="relative w-full md:w-1/4 mb-4 md:mb-0">

            <select wire:model="{{ $dropdown['name'] }}"
                class="block w-full font-semibold font-playfair text-sm md:text-base px-4 py-3 text-gray-700 bg-[#F4F4F4] rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] custom-shadow">
                <option value="" selected>{{ $dropdown['default'] }}</option>

                @foreach ($dropdown['options'] as $option)
                    <option value="{{ $option['id'] ?? $option['label'] }}">{{ $option['name'] ?? $option['label'] }}
                    </option>
                @endforeach

            </select>

            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    @endforeach

    @foreach ($fields as $field)
        <div class="relative flex-grow mb-4 md:mb-0 max-w-full rounded-sm ">
            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input wire:model="{{ $field['name'] }}" type="text"
                placeholder="{{ $field['placeholder'] ?? 'Search by ' . $field['name'] }}"
                class="block font-semibold  font-playfair text-sm w-full lg:max-w-[600px] md:text-base px-4 py-3 pl-14 text-gray-700 bg-[#F4F4F4]    rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] custom-shadow" />
        </div>
    @endforeach

    @foreach ($buttons as $button)
        <a id="{{ $button['id'] !== null ? $button['id'] : '' }}"
            {{ $button['method'] !== null ? 'wire:click=' . $button['method'] : '' }}
            class="flex items-center justify-center text-sm lg:text-base font-playfair font-medium text-black px-4 py-2.5 rounded-sm hover:bg-[#b99b52] bg-[#C7AE6A] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] custom-shadow w-full sm:w-[120px] md:w-[132px] xl:w-[150px]">

            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>

            {{ ucfirst($button['text']) }}
        </a>
    @endforeach

</div>
