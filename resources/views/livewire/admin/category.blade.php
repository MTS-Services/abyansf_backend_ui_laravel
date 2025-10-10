<section class="mx-auto max-w-[1200px]  font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Category Management</h2>

    <nav class=" sm:mt-8 ">


        <!-- Navigation links container -->
        @include('livewire.admin.category-management.navbar')
    </nav>
    <x-admin.searchbar page="Add" livewire_method="switchAddCategoryModal" />

    <!--Add Category Modal-->
    <div x-data="{ open: @entangle('addCategoryModal') }" x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 bg-opacity-50" x-cloak>
        <!-- Modal Box -->
        <div class="relative max-w-[1200px] mx-auto w-full bg-white rounded-lg shadow-lg border border-gray-200 p-6 md:p-8 
               max-h-[90vh] overflow-y-auto"
            @click.away="open = false">
            <!-- Close Button -->
            <button wire:click="switchAddCategoryModal"
                class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                &times;
            </button>

            <!-- Header -->
            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Category</h1>
            </div>

            <!-- Form Content -->
            {{-- <div class="mb-6">
                <label class="block text-sm font-medium text-gray-900 mb-2 font-playfair">Category Title</label>
                <input type="text" x-model="categoryTitle" placeholder="Enter your title here"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors ">
            </div> --}}



            <!-- Save Button -->
            <button @click="saveCategory()"
                class="w-full md:w-auto px-8 py-3 bg-[#C7AE6A]  text-white font-medium  cursor-pointer rounded-lg transition-colors  outline-none">
                Save Category
            </button>
        </div>
    </div>

    </div>

    <div class="bg-white rounded-lg overflow-hidden mt-14 mb-5">

        <table class="min-w-full w-auto border-collapse">
            <thead>
                <tr class="bg-[#e7e7e7] text-black font-medium">
                    <th class="p-4 text-left font-medium text-base">SL</th>
                    <th class="p-4 text-left font-medium text-base">Catygory Name</th>
                    <th class="p-4 text-right font-medium text-base">Action</th>
                </tr>
            </thead>

            <tbody class="w-full">
                @foreach ($mainCategories as $category)
                    <tr wire:key="booking-{{ $category['id'] }}" x-data="{ dropdownOpen: false }"
                        class="border-b border-gray-200">
                        <td class="p-4 text-left font-playfair text-base">
                            <p class="text-black whitespace-nowrap">{{ $category['id'] }}</p>
                        </td>
                        <td class="p-4 text-left font-playfair text-base">
                            <p class="text-black whitespace-nowrap">{{ $category['name'] }}</p>
                        </td>

                        <td class="py-3 px-6 text-right">
                            <!-- Actions -->
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

                                    <button wire:click="categoryDtls('{{ encrypt($category['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="eye" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Deatils
                                    </button>

                                    <button wire:click="openEditCategoryModal"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Edit
                                    </button>


                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="check" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Active
                                    </button>

                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="x-circle" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Deactivate
                                    </button>

                                    <button wire:click="deleteCategory('{{ encrypt($category['id']) }}')"
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
    {{-- event details modal --}}
    <div x-data="{ show: @entangle('categoryDetailsModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <!-- Backdrop -->
            <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeCategoryModal">
            </div>

            <!-- Modal Content -->
            <div x-show="show" x-cloak x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-6 scale-95"
                class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full p-8 sm:p-10" wire:click.stop>

                <!-- Close Button -->
                <button wire:click="closeCategoryModal"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <!-- Header -->
                <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                    {{-- <img src="{{ $detailImage ?? 'https://via.placeholder.com/150' }}" alt="Event Image"
                        class="w-20 h-20 rounded-lg object-cover shadow"> --}}
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $detailName ?? 'Category Details' }}</h2>
                    </div>
                </div>

                <!-- Event Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Name</label>
                        <p class="text-gray-800 font-semibold">{{ $detailName ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Sub Categories</label>
                        {{-- <p class="text-gray-800 font-semibold">{{ $detailSubCategories ?? 'N/A' }}</p> --}}
                        @forelse ($detailSubCategories as $detailSubCategory)
                            <p class="text-gray-800 font-semibold">{{ $detailSubCategory['name'] ?? 'N/A' }}</p>
                        @empty
                            <p class="text-gray-800 font-semibold">No Sub Categories</p>
                        @endforelse
                    </div>

                    {{-- <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Specific Categories</label>
                        <p class="text-gray-800">{{ $detailLocation ?? 'N/A' }}</p>
                        @forelse ($detailSubCategories as $subCategory)
                            @if (isset($subCategory['specificCategories']) && count($subCategory['specificCategories']) > 0)
                                @foreach ($subCategory['specificCategories'] as $specificCategory)
                                    <p class="text-gray-800">{{ $specificCategory['name'] ?? 'N/A' }}</p>
                                @endforeach
                            @endif
                        @empty
                            <p class="text-gray-800">No Specific Categories</p>
                        @endforelse

                    </div> --}}

                    {{-- <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Date</label>
                        <p class="text-gray-800">{{ $detailDate ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Time</label>
                        <p class="text-gray-800">{{ $detailTime ?? 'N/A' }}</p>
                    </div> --}}

                    {{-- <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Status</label>
                            <span
                                class="inline-block px-3 py-1 text-sm font-semibold rounded-full w-fit
                        {{ $detailStatus == 'Active' ? 'text-green-800 bg-green-200' : 'text-red-800 bg-red-200' }}">
                                {{ $detailStatus ?? 'N/A' }}
                            </span>
                        </div> --}}
                </div>

                <div class="mt-6 grid grid-cols-1 gap-5">
                    {{-- <div class="flex  bg-gray-100 p-4 gap-4 flex-wrap rounded-lg">
                            <label class="text-xs text-gray-500 font-medium mb-1">Bookings</label>
                            @forelse ($detailBookings as $booking)
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
                        </div> --}}
                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Description</label>
                        <p class="text-gray-800">{{ $detailDescription ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end">
                    <button wire:click="closeCategoryModal"
                        class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#AD8945] to-amber-600 hover:from-[#9c7a3d] hover:to-amber-700 rounded-lg shadow transition transform hover:scale-[1.02]">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: @entangle('editCategoryModal') }" x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 bg-opacity-50" x-cloak>
        <div class="relative max-w-[1200px] mx-auto w-full bg-white rounded-lg shadow-lg border border-gray-200 p-6 md:p-8 
                                     max-h-[90vh] overflow-y-auto"
            @click.away="open = false">
            <button wire:click="switchEditCategoryModel"
                class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                &times;
            </button>

            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Edit Category</h1>
            </div>

            {{-- <div class="mb-6">
                <label class="block text-sm font-medium text-gray-900 mb-2 font-playfair">Category
                    Title</label>
                <input type="text" wire:model.defer="categoryTitle" placeholder="Enter your title here"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors ">
            </div> --}}

            <button wire:click="saveCategory"
                class="w-full md:w-auto px-8 py-3 bg-[#C7AE6A] text-white font-medium cursor-pointer rounded-lg transition-colors outline-none">
                Save Category
            </button>
        </div>
    </div>
    </div>
    <!-- Pagination -->
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


</section>
