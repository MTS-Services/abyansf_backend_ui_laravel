<section class="mx-auto max-w-[1200px]  font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Listing Management</h2>

    <x-admin.searchbar page="Add Listing" livewire_method="switchAddListingModal" filter_method="applyFilters"
        :categories="$categories" />

    <div x-data x-init="$watch('$wire.addListingModal', value => document.body.classList.toggle('overflow-hidden', value))"
        class="fixed inset-0 bg-black/70 {{ $addListingModal ? 'block' : 'hidden' }} z-50 overflow-auto flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">

            <button wire:click="switchAddListingModal"
                class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;
            </button>

            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Listing</h1>
            </div>

            <form wire:submit.prevent="saveListing" class="space-y-6">

                <!-- Row 1: Category, Name, Location -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Specific Category *</label>
                        <select wire:model="specificCategoryId"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                            <option value="">Select a category</option>
                            @foreach ($specificCategories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                        @error('specificCategoryId')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 font-playfair">Name *</label>
                        <input wire:model="name" type="text" placeholder="Name"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 font-playfair">Location *</label>
                        <input wire:model="location" type="text" placeholder="Location"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                        @error('location')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium mb-2 font-playfair">Description</label>
                    <textarea wire:model="description" placeholder="Enter description"
                        class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[120px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"></textarea>
                </div>

                <!-- Row 2: Hours, Contact WhatsApp -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2 font-playfair">Hours</label>
                        <input wire:model="hours" type="text" placeholder="e.g., Sunday:6:00 AM - 11:00 PM"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2 font-playfair">Contact WhatsApp *</label>
                        <div class="flex items-center space-x-4 h-[50px]">
                            <label class="inline-flex items-center">
                                <input wire:model.live="contractWhatsapp" type="radio" value="true"
                                    class="form-radio text-[#C7AE6A] h-4 w-4">
                                <span class="ml-2 text-gray-700">Yes</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input wire:model.live="contractWhatsapp" type="radio" value="false"
                                    class="form-radio text-[#C7AE6A] h-4 w-4">
                                <span class="ml-2 text-gray-700">No</span>
                            </label>
                        </div>
                        @error('contractWhatsapp')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Conditional Fields: From Name and Has Form (shown only when Contract WhatsApp is No/0) -->
                    @if ($contractWhatsapp === 'false' || $contractWhatsapp === false)
                        <div>
                            <label class="block text-sm font-medium mb-2 font-playfair">From Name</label>
                            <input wire:model="fromName" type="text" placeholder="From Name"
                                class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                            @error('fromName')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 font-playfair">Has Form *</label>
                            <div class="flex items-center space-x-4 h-[50px]">
                                <label class="inline-flex items-center">
                                    <input wire:model="hasForm" type="radio" value="true"
                                        class="form-radio text-[#C7AE6A] h-4 w-4">
                                    <span class="ml-2 text-gray-700">Yes</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input wire:model="hasForm" type="radio" value="false"
                                        class="form-radio text-[#C7AE6A] h-4 w-4">
                                    <span class="ml-2 text-gray-700">No</span>
                                </label>
                            </div>
                            @error('hasForm')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>



                <!-- Image Upload Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Main Image -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium mb-1">Main Image (Single) *</label>
                        <div
                            class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4">
                            <input type="file" wire:model="main_image" class="hidden" accept="image/*"
                                id="mainImageInput">
                            <label for="mainImageInput"
                                class="cursor-pointer w-full h-full flex flex-col items-center justify-center">
                                <div class="text-center px-2">
                                    <div class="mb-4 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-800">Choose a file or drag & drop it here</p>
                                    <button type="button"
                                        class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 text-sm">
                                        Browse File
                                    </button>
                                </div>
                            </label>
                        </div>

                        @if ($main_image)
                            <div class="mt-3">
                                <div class="relative w-32 flex-shrink-0">
                                    <img src="{{ $main_image->temporaryUrl() }}"
                                        class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                    <button type="button" wire:click="$set('main_image', null)"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 text-sm flex items-center justify-center hover:bg-red-600">×</button>
                                </div>
                            </div>
                        @endif

                        <div wire:loading wire:target="main_image" class="text-sm text-blue-600">
                            Uploading...
                        </div>

                        @error('main_image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Menu Images -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium mb-1">Menu Images</label>
                        <div
                            class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4">
                            <input type="file" wire:model="menu_images" multiple class="hidden" accept="image/*"
                                id="menuImagesInput">
                            <label for="menuImagesInput"
                                class="cursor-pointer w-full h-full flex flex-col items-center justify-center">
                                <div class="text-center px-2">
                                    <div class="mb-4 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-800">Choose files or drag & drop them here
                                    </p>
                                    <button type="button"
                                        class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 text-sm">
                                        Browse Files
                                    </button>
                                </div>
                            </label>
                        </div>

                        @if ($menu_images && count($menu_images) > 0)
                            <div class="overflow-x-auto mt-3">
                                <div class="flex gap-2 min-w-max">
                                    @foreach ($menu_images as $index => $menuImage)
                                        <div class="relative w-32 flex-shrink-0">
                                            <img src="{{ $menuImage->temporaryUrl() }}"
                                                class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                            <button type="button"
                                                wire:click="removeNewImage('menu_images', {{ $index }})"
                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 text-sm flex items-center justify-center hover:bg-red-600">×</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div wire:loading wire:target="menu_images" class="text-sm text-blue-600">
                            Uploading...
                        </div>

                        @error('menu_images.*')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sub Images -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium mb-1">Sub Images</label>
                        <div
                            class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4">
                            <input type="file" wire:model="sub_images" multiple class="hidden" accept="image/*"
                                id="subImagesInput">
                            <label for="subImagesInput"
                                class="cursor-pointer w-full h-full flex flex-col items-center justify-center">
                                <div class="text-center px-2">
                                    <div class="mb-4 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-800">Choose files or drag & drop them here
                                    </p>
                                    <button type="button"
                                        class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 text-sm">
                                        Browse Files
                                    </button>
                                </div>
                            </label>
                        </div>

                        @if ($sub_images && count($sub_images) > 0)
                            <div class="overflow-x-auto mt-3">
                                <div class="flex gap-2 min-w-max">
                                    @foreach ($sub_images as $index => $subImage)
                                        <div class="relative w-32 flex-shrink-0">
                                            <img src="{{ $subImage->temporaryUrl() }}"
                                                class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                            <button type="button"
                                                wire:click="removeNewImage('sub_images', {{ $index }})"
                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 text-sm flex items-center justify-center hover:bg-red-600">×</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div wire:loading wire:target="sub_images" class="text-sm text-blue-600">
                            Uploading...
                        </div>

                        @error('sub_images.*')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center md:justify-start pt-6">
                    <button type="submit"
                        class="px-8 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-opacity-90 transition-colors font-medium">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-white rounded-lg overflow-y-visible mt-14 mb-5 ">
        <table class="min-w-full table-fixed border-collapse">
            <thead>
                <tr class="hidden md:table-row bg-[#E7E7E7]">
                    <th class="p-4 text-left font-medium text-base">SL</th>
                    <th class="py-3 px-2 text-left text-lg md:text-xl font-semibold text-black font-playfair w-[70%]">
                        Service Name
                    </th>
                    <th class="p-4 text-right font-medium text-base md:text-lg text-black font-playfair w-[30%]">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 mt-4 md:mt-2">
                @foreach ($listings as $listing)
                    <tr wire:key="booking-{{ $listing['id'] }}" x-data="{ dropdownOpen: false }"
                        class="flex flex-col md:table-row items-start md:items-center py-4 px-2 gap-4 transition relative md:static">
                        <div class="flex flex-col md:flex-row w-full md:w-auto items-start md:items-center">
                            <td class="p-4 text-left font-normal text-base block md:table-cell" data-label="SL">
                                <span class="font-medium text-gray-500 md:hidden">SL: </span>
                                <p class="text-black whitespace-nowrap inline-block md:block">{{ $listing['id'] }}</p>
                            </td>
                            <td class="flex items-start md:items-center space-x-3 md:space-x-4">
                                <p
                                    class="w-20 h-15 mt-6 mb-2 md:w-26 md:h-26 overflow-hidden rounded shadow-sm flex-shrink-0 ">
                                    <img src="{{ $listing['main_image'] }}" alt="{{ $listing['name'] }}"
                                        class="object-cover w-full h-20 md:h-26 ">
                                </p>
                                <div>
                                    <div class="font-semibold text-gray-800 text-base md:text-xl font-playfair">
                                        <span class="font-medium text-gray-500 md:hidden">Service Name: </span>
                                        {{ $listing['name'] }}
                                    </div>
                                    <div class="my-2 md:my-5"></div>
                                    <div class="flex items-center text-xs md:text-sm text-black font-playfair">
                                        <svg class="w-4 h-4 mr-1 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $listing['location'] }}
                                    </div>
                                </div>
                            </td>
                        </div>

                        <td class="py-3 px-6 text-left md:text-right absolute top-4 right-4 md:static">
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
                                    class="absolute right-3 -mt-1 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                                    <button wire:click="listingDtls('{{ encrypt($listing['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="eye" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Details
                                    </button>
                                    <button wire:click="switchEditListingModal('{{ encrypt($listing['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Edit
                                    </button>
                                    <button wire:click="confirmDelete('{{ encrypt($listing['id']) }}')"
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
        {{-- listing details modal --}}
        <div x-data="{ show: @entangle('listingDetailsModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto">

            <div class="flex items-center justify-center min-h-screen px-4 py-8">

                <!-- Backdrop -->
                <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeEditModal">
                </div>

                <!-- Modal Content -->
                <div x-show="show" x-cloak x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-6 scale-95"
                    class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full p-8 sm:p-10" wire:click.stop>

                    <!-- Close Button -->
                    <button wire:click="closeEditModal"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                        <flux:icon name="x-circle" class="h-6 w-6" />
                    </button>

                    <!-- Header -->
                    <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                        <img src="{{ $listingMainImage ?? 'https://via.placeholder.com/150' }}" alt="Listing Image"
                            class="w-20 h-20 rounded-lg object-cover shadow">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $name ?? 'Unknown Listing' }}
                            </h2>
                            <p class="text-sm text-[#AD8945]">{{ $mainCategoryName ?? '' }}</p>
                        </div>
                    </div>

                    <!-- User & Booking Details -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Listing Name</label>
                            <p class="text-gray-800 font-semibold">{{ $name ?? '' }}</p>
                        </div>

                        {{-- <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">WhatsApp</label>
                            <p class="text-gray-800 font-semibold">{{ $contractWhatsapp ?? '' }}</p>
                        </div> --}}

                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Location</label>
                            <p class="text-gray-800">{{ $location ?? '' }}</p>
                        </div>
                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Member Privileges</label>
                            @forelse ($privileges as $previlege)
                                <p class="text-gray-800">{{ $previlege ?? '' }}</p>
                            @empty
                                <p class="text-gray-800">No Privileges</p>
                            @endforelse

                        </div>

                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Hours</label>
                            {{-- <p class="text-gray-800">{{ $listingHours ?? '' }}</p> --}}
                            @forelse ($listingHours as $listingHour)
                                <p class="text-gray-800">{{ $listingHour ?? '' }}</p>
                            @empty
                                <p class="text-gray-800">No Hours</p>
                            @endforelse
                        </div>

                        {{-- <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Specific Category Id</label>
                            <p class="text-gray-800">{{ $specificCategoryId ?? '' }}</p>
                        </div> --}}

                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Status</label>
                            {{-- <p class="text-gray-800">{{ $status_label ?? '' }}</p> --}}
                            @if ($isActive == 1)
                                <p
                                    class="inline-block w-fit px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                                    Active</p>
                            @else
                                <p
                                    class="inline-block w-fit px-3 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full">
                                    Inactive</p>
                            @endif
                        </div>


                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Menu Images</label>
                            @forelse ($menuImages as $menuImage)
                                <img src="{{ $menuImage ?? '' }}" alt="">
                            @empty
                                <p class="text-gray-800">No Image ablavile</p>
                            @endforelse
                        </div>

                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Listing Type of Service</label>
                            @forelse ($listingTypeofServices as $listingTypeofService)
                                <p class="text-gray-800">{{ $listingTypeofService ?? '' }}</p>
                            @empty
                                <p class="text-gray-500 italic">Not provided</p>
                            @endforelse
                        </div>


                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Listing Venue Name</label>
                            @forelse ($listingVenueNames as $listingVenueName)
                                <p class="text-gray-800">{{ $listingVenueName ?? '' }}</p>
                            @empty
                                <p class="text-gray-500 italic">No venue name available.</p>
                            @endforelse
                        </div>


                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">From Name</label>
                            <p class="text-gray-800">{{ $fromName ?? '' }}</p>
                        </div>

                        {{-- <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Has From</label>
                            <p class="text-gray-800">{{ $hasForm ?? '' }}</p>
                        </div> --}}


                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Specific Category</label>
                            <p class="text-gray-800">{{ $specificCategoriesss ?? '' }}</p>
                        </div>
                    </div>


                    <div class="mt-6 grid grid-cols-1 gap-5">
                        <div class="flex  bg-gray-100 p-4 gap-4 flex-wrap rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Bookings</label>
                            @forelse ($bookings as $booking)
                                <div class="bg-white p-3 rounded mb-2 border border-gray-200">
                                    <p class="text-gray-800 font-semibold">{{ $booking['name'] ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">Status: {{ $booking['status'] ?? 'N/A' }}</p>
                                    @if (isset($booking['user']))
                                        <p class="text-xs text-gray-500">User: {{ $booking['user']['name'] ?? 'N/A' }}
                                        </p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500 italic">No bookings available</p>
                            @endforelse
                        </div>
                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Member Privileges Description</label>
                            <p class="text-gray-800">{{ $member_privileges_description ?? '' }}</p>
                        </div>

                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Description</label>
                            <p class="text-gray-800">{{ $description ?? '' }}</p>
                        </div>

                        <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Sub Images</label>
                            @forelse ($listing_sub_images as $listing_sub_image)
                                <img class="mb-5" src="{{ $listing_sub_image ?? '' }}" alt="">
                            @empty
                                <p class="text-gray-800 font-semibold">No Image Available</p>
                            @endforelse
                        </div>
                    </div>


                    <!-- Footer -->
                    <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end">
                        <button wire:click="closeEditModal"
                            class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#AD8945] to-amber-600 hover:from-[#9c7a3d] hover:to-amber-700 rounded-lg shadow transition transform hover:scale-[1.02]">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div x-data="{ open: @entangle('editListingModal') }" x-show="open" x-cloak x-init="$watch('open', value => document.body.classList.toggle('overflow-hidden', value));" x-on:click.self="open = false"
            class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 transition-opacity duration-300 ease-in-out"
            x-transition:enter="opacity-0" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="opacity-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">

                <button wire:click="closeEditModal"
                    class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;</button>

                <div class="flex items-center justify-between border-gray-200 pb-4">
                    <h1 class="text-4xl font-semibold text-gray-900">Edit Listing</h1>
                </div>

                <form wire:submit.prevent="updateListing" class="space-y-6">

                    <!-- Row 1: Category, Name, Location -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Specific Category *</label>
                            <select wire:model="specificCategoryId"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                <option value="">Select a category</option>
                                @if (!empty($specificCategories))
                                    @foreach ($specificCategories as $category)
                                        <option value="{{ $category['id'] }}"
                                            @if ($specificCategoryId == $category['id']) selected @endif>
                                            {{ $category['name'] }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No categories available</option>
                                @endif
                            </select>
                            @error('specificCategoryId')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 font-playfair">Name *</label>
                            <input wire:model="name" type="text" placeholder="Name"
                                class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 font-playfair">Location *</label>
                            <input wire:model="location" type="text" placeholder="Location"
                                class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                            @error('location')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium mb-2 font-playfair">Description</label>
                        <textarea wire:model="description" placeholder="Enter description"
                            class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[120px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]"></textarea>
                    </div>

                    <!-- Row 2: Hours, Contact WhatsApp -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2 font-playfair">Hours</label>
                            <input wire:model="hours" type="text" placeholder="e.g., Sunday:6:00 AM - 11:00 PM"
                                class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 font-playfair">Contact WhatsApp *</label>
                            <div class="flex items-center space-x-4 h-[50px]">
                                <label class="inline-flex items-center">
                                    <input wire:model.live="contractWhatsapp" type="radio" value="true"
                                        class="form-radio text-[#C7AE6A] h-4 w-4">
                                    <span class="ml-2 text-gray-700">Yes</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input wire:model.live="contractWhatsapp" type="radio" value="false"
                                        class="form-radio text-[#C7AE6A] h-4 w-4">
                                    <span class="ml-2 text-gray-700">No</span>
                                </label>
                            </div>
                            @error('contractWhatsapp')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Conditional Fields: From Name and Has Form -->
                        @if ($contractWhatsapp === 'false' || $contractWhatsapp === false)
                            <div>
                                <label class="block text-sm font-medium mb-2 font-playfair">From Name</label>
                                <input wire:model="fromName" type="text" placeholder="From Name"
                                    class="w-full border border-[#C7AE6A] bg-[#F8F6EE] rounded p-2 h-[50px] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]" />
                                @error('fromName')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 font-playfair">Has Form *</label>
                                <div class="flex items-center space-x-4 h-[50px]">
                                    <label class="inline-flex items-center">
                                        <input wire:model="hasForm" type="radio" value="true"
                                            class="form-radio text-[#C7AE6A] h-4 w-4">
                                        <span class="ml-2 text-gray-700">Yes</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input wire:model="hasForm" type="radio" value="false"
                                            class="form-radio text-[#C7AE6A] h-4 w-4">
                                        <span class="ml-2 text-gray-700">No</span>
                                    </label>
                                </div>
                                @error('hasForm')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Image Upload Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Main Image -->
                        <div class="space-y-4">
                            <label class="block text-sm font-medium mb-1">Main Image (Single)</label>

                            {{-- Show existing main image if no new upload --}}
                            @if (!$main_image && $existing_main_image)
                                <div class="relative w-full h-64 mb-3">
                                    <img src="{{ $existing_main_image }}"
                                        class="w-full h-full object-cover rounded-md border"
                                        alt="Existing Main Image">
                                    <button type="button" wire:click="removeExistingImage('main_image', '')"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold hover:bg-red-600">&times;</button>
                                </div>
                            @endif

                            {{-- Show new upload preview --}}
                            @if ($main_image)
                                <div class="relative w-full h-64 mb-3">
                                    <img src="{{ $main_image->temporaryUrl() }}"
                                        class="w-full h-full object-cover rounded-md border" alt="Main Image Preview">
                                    <button type="button" wire:click="$set('main_image', null)"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold hover:bg-red-600">&times;</button>
                                </div>
                            @endif

                            {{-- Upload area (show only if no image) --}}
                            @if (!$main_image && !$existing_main_image)
                                <div
                                    class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4">
                                    <input type="file" wire:model="main_image" class="hidden" accept="image/*"
                                        id="mainImageInputEdit">
                                    <label for="mainImageInputEdit"
                                        class="cursor-pointer w-full h-full flex flex-col items-center justify-center">
                                        <div class="text-center px-2">
                                            <div class="mb-4 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                            </div>
                                            <p class="text-sm font-bold text-gray-800">Choose a file or drag & drop it
                                                here</p>
                                            <button type="button"
                                                class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 text-sm">
                                                Browse File
                                            </button>
                                        </div>
                                    </label>
                                </div>
                            @endif

                            {{-- Change image button when image exists --}}
                            @if ($main_image || $existing_main_image)
                                <label for="mainImageInputEdit"
                                    class="block w-full mt-2 px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 text-center cursor-pointer">
                                    Change Image
                                </label>
                                <input type="file" wire:model="main_image" class="hidden" accept="image/*"
                                    id="mainImageInputEdit">
                            @endif

                            <div wire:loading wire:target="main_image" class="text-sm text-blue-600">Uploading...
                            </div>
                        </div>

                        <!-- Menu Images -->
                        <div class="space-y-4">
                            <label class="block text-sm font-medium mb-1">Menu Images</label>
                            <div
                                class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4">
                                <input type="file" wire:model="menu_images" multiple class="hidden"
                                    accept="image/*" id="menuImagesInputEdit">
                                <label for="menuImagesInputEdit"
                                    class="cursor-pointer w-full h-full flex flex-col items-center justify-center">
                                    <div class="text-center px-2">
                                        <div class="mb-4 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-bold text-gray-800">Choose files or drag & drop them
                                            here</p>
                                        <button type="button"
                                            class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 text-sm">
                                            Browse Files
                                        </button>
                                    </div>
                                </label>
                            </div>

                            {{-- Show existing and new menu images --}}
                            @if (!empty($existing_menu_images) || (!empty($menu_images) && count($menu_images) > 0))
                                <div class="mt-4 overflow-x-auto">
                                    <div class="flex gap-2 min-w-max">
                                        {{-- Existing images --}}
                                        @if (!empty($existing_menu_images))
                                            @foreach ($existing_menu_images as $image)
                                                <div class="relative w-32 flex-shrink-0">
                                                    @php
                                                        $imageUrl = is_array($image)
                                                            ? $image['url'] ?? ($image['image'] ?? '')
                                                            : $image;
                                                        $imageId = is_array($image) ? $image['id'] ?? '' : '';
                                                    @endphp
                                                    @if ($imageUrl)
                                                        <img src="{{ $imageUrl }}"
                                                            class="w-full h-32 object-cover rounded-md border"
                                                            alt="Existing Menu Image">
                                                        <button type="button"
                                                            wire:click="removeExistingImage('menu_images', '{{ $imageId }}')"
                                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold hover:bg-red-600">&times;</button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                        {{-- New uploaded images --}}
                                        @if (!empty($menu_images))
                                            @foreach ($menu_images as $index => $newImage)
                                                <div class="relative w-32 flex-shrink-0">
                                                    <img src="{{ $newImage->temporaryUrl() }}"
                                                        class="w-full h-32 object-cover rounded-md border"
                                                        alt="New Menu Image Preview">
                                                    <button type="button"
                                                        wire:click="removeNewImage('menu_images', {{ $index }})"
                                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold hover:bg-red-600">&times;</button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div wire:loading wire:target="menu_images" class="text-sm text-blue-600">Uploading...
                            </div>
                        </div>

                        <!-- Sub Images -->
                        <div class="space-y-4">
                            <label class="block text-sm font-medium mb-1">Sub Images</label>
                            <div
                                class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4">
                                <input type="file" wire:model="sub_images" multiple class="hidden"
                                    accept="image/*" id="subImagesInputEdit">
                                <label for="subImagesInputEdit"
                                    class="cursor-pointer w-full h-full flex flex-col items-center justify-center">
                                    <div class="text-center px-2">
                                        <div class="mb-4 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-bold text-gray-800">Choose files or drag & drop them
                                            here</p>
                                        <button type="button"
                                            class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 text-sm">
                                            Browse Files
                                        </button>
                                    </div>
                                </label>
                            </div>

                            {{-- Show existing and new sub images --}}
                            @if (!empty($existing_sub_images) || (!empty($sub_images) && count($sub_images) > 0))
                                <div class="mt-4 overflow-x-auto">
                                    <div class="flex gap-2 min-w-max">
                                        {{-- Existing images --}}
                                        @if (!empty($existing_sub_images))
                                            @foreach ($existing_sub_images as $image)
                                                <div class="relative w-32 flex-shrink-0">
                                                    @php
                                                        $imageUrl = is_array($image)
                                                            ? $image['url'] ?? ($image['image'] ?? '')
                                                            : $image;
                                                        $imageId = is_array($image) ? $image['id'] ?? '' : '';
                                                    @endphp
                                                    @if ($imageUrl)
                                                        <img src="{{ $imageUrl }}"
                                                            class="w-full h-32 object-cover rounded-md border"
                                                            alt="Existing Sub Image">
                                                        <button type="button"
                                                            wire:click="removeExistingImage('sub_images', '{{ $imageId }}')"
                                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold hover:bg-red-600">&times;</button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                        {{-- New uploaded images --}}
                                        @if (!empty($sub_images))
                                            @foreach ($sub_images as $index => $newImage)
                                                <div class="relative w-32 flex-shrink-0">
                                                    <img src="{{ $newImage->temporaryUrl() }}"
                                                        class="w-full h-32 object-cover rounded-md border"
                                                        alt="New Sub Image Preview">
                                                    <button type="button"
                                                        wire:click="removeNewImage('sub_images', {{ $index }})"
                                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold hover:bg-red-600">&times;</button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div wire:loading wire:target="sub_images" class="text-sm text-blue-600">Uploading...
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center md:justify-start pt-6">
                        <button type="submit"
                            class="px-8 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-opacity-90 transition-colors font-medium">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-data="{ open: @entangle('deleteConfirmModal') }" x-show="open" x-cloak x-init="$watch('open', value => document.body.classList.toggle('overflow-hidden', value));"
            x-on:click.self="$wire.cancelDelete()"
            class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 transition-opacity duration-300 ease-in-out"
            x-transition:enter="opacity-0" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="opacity-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-white w-full max-w-md mx-auto rounded-lg p-6 relative">

                <!-- Close Button -->
                <button wire:click="cancelDelete"
                    class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;</button>

                <!-- Icon -->
                <div class="flex items-center justify-center mb-4">
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h2 class="text-2xl font-bold text-gray-900 text-center mb-2">Delete Listing</h2>

                <!-- Message -->
                <p class="text-gray-600 text-center mb-6">
                    Are you sure you want to delete this listing? This action cannot be undone.
                </p>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="button" wire:click="cancelDelete"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors font-medium">
                        Cancel
                    </button>
                    <button type="button" wire:click="deleteListing"
                        class="flex-1 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors font-medium">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if (!empty($pagination) && ($pagination['pages'] ?? 1) > 1)
        <div class="flex items-center justify-center space-x-2 py-3 my-3 flex-wrap border-t border-slate-200">
            <button wire:click="previousPage" @disabled(!$hasPrevious) @class([
                'flex items-center justify-center w-8 h-8 rounded border border-slate-300',
                'bg-slate-100 text-slate-400 cursor-not-allowed' => !$hasPrevious,
                'bg-white text-slate-700 hover:bg-slate-50' => $hasPrevious,
            ])>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            @foreach ($pages as $page)
                @if ($page === '...')
                    <span class="flex items-center justify-center w-8 h-8 text-slate-500 text-sm">...</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" @class([
                        'flex items-center justify-center w-8 h-8 rounded border font-medium text-sm',
                        'border-2 border-[#AD8945] text-[#AD8945]' => $page == $currentPage,
                        'border-slate-300 bg-white text-slate-700 hover:bg-slate-50' =>
                            $page != $currentPage,
                    ])>
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            <button wire:click="nextPage" @disabled(!$hasNext) @class([
                'flex items-center justify-center w-8 h-8 rounded border border-slate-300',
                'bg-slate-100 text-slate-400 cursor-not-allowed' => !$hasNext,
                'bg-white text-slate-700 hover:bg-slate-50' => $hasNext,
            ])>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    @endif

    {{-- <script>
        function fileUpload() {
            return {
                dragOver: false,
                images: [],
                handleFiles(event) {
                    for (let file of event.target.files) {
                        this.preview(file);
                    }
                },
                handleDrop(event) {
                    for (let file of event.dataTransfer.files) {
                        this.preview(file);
                    }
                    this.dragOver = false;
                },
                preview(file) {
                    const reader = new FileReader();
                    reader.onload = e => this.images.push(e.target.result);
                    reader.readAsDataURL(file);
                },
                removeImage(index) {
                    this.images.splice(index, 1);
                }
            }
        }
    </script> --}}
</section>
