<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Sub Category</h2>
    <nav class="sm:mt-8">
        <!-- Navigation links container -->
        @include('livewire.admin.category-management.navbar')
    </nav>

    <x-admin.searchbar page="Add Event" livewire_method="switchAddSubCategoryModal" />

    <!-- Add Sub Category Modal -->
    <div x-data="{ show: @entangle('addSubCategoryModal') }" 
         x-show="show" 
         x-cloak
         x-effect="document.body.classList.toggle('overflow-hidden', show)"
         x-transition.opacity>
        <div class="fixed max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="show"
                     @click.away="$wire.closeAddModal()"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative w-full max-w-[1200px] mx-auto rounded-lg shadow-lg bg-white p-6">
                    
                    <div class="flex justify-between items-center pb-3">
                        <h3 class="text-xl font-semibold text-gray-900">Add New Sub Category</h3>
                        <button wire:click="closeAddModal"
                                class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                        <div class="mb-6">
                            <label for="category-title" class="block text-sm font-medium text-gray-700 mb-2">Category
                                Title</label>
                            <input type="text" id="category-title" placeholder="Enter your title here"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>

                        <div class="mb-6">
                            <label for="category-description"
                                class="block text-sm font-medium text-gray-700 mb-2">Category Description</label>
                            <textarea id="category-description" rows="4" placeholder="Enter your description here"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                        </div>

                        <div class="mb-6 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hero Image</label>
                                <div
                                    class="flex items-center justify-center h-48 border-4 border-dashed border-[#C7AE6A] rounded-md p-6 text-center transition-colors">
                                    <div>
                                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <p class="mt-1 text-sm text-gray-600">Choose a file or drag & drop it here</p>
                                        <button type="button"
                                            class="mt-2 px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-100">
                                            Browse File
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category Image</label>
                                <div
                                    class="flex items-center justify-center h-48 border-4 border-dashed border-[#C7AE6A] rounded-md p-6 text-center transition-colors">
                                    <div>
                                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <p class="mt-1 text-sm text-gray-600">Choose a file or drag & drop it here</p>
                                        <button type="button"
                                            class="mt-2 px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-100">
                                            Browse File
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">hasSpecificCategory</span>
                                <div class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200 bg-[#C7AE6A]"
                                    x-data="{ on: true }" @click="on = !on" :class="{ 'bg-gray-200': !on }">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200"
                                        :class="{ 'translate-x-6': on, 'translate-x-0': !on }"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">contactWhatsapp</span>
                                <div class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200 bg-[#C7AE6A]"
                                    x-data="{ on: true }" @click="on = !on" :class="{ 'bg-gray-200': !on }">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200"
                                        :class="{ 'translate-x-6': on, 'translate-x-0': !on }"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Create Mini-Category</span>
                                <div class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200 bg-[#C7AE6A]"
                                    x-data="{ on: true }" @click="on = !on" :class="{ 'bg-gray-200': !on }">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200"
                                        :class="{ 'translate-x-6': on, 'translate-x-0': !on }"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="parent-categories" class="block text-sm font-medium text-gray-700 mb-2">Parent
                                Categories</label>
                            <select id="parent-categories"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] ">
                                <option>Select your parent categories</option>
                                <option>Category 1</option>
                                <option>Category 2</option>
                            </select>
                        </div>

                        <div class="flex justify-center">
                            <button wire:click="closeAddModal"
                                class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                                Save Category
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub Categories Table -->
    <div class="bg-white rounded-lg overflow-hidden mt-14 mb-5">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-[#E7E7E7] hidden md:table-row">
                    <th class="p-4 text-left font-medium text-base w-[5%]">SL</th>
                    <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[20%]">
                        Category Image
                    </th>
                    <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Category Name
                    </th>
                    <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Parent-Category
                    </th>
                    <th class="p-4 text-right font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($subCategoreis as $index => $subCategory)
                    <tr class="md:table-row grid grid-cols-1 md:grid-cols-none items-center transition">
                        <!-- SL -->
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-black whitespace-nowrap">
                                {{ $index + 1 }}
                            </p>
                        </td>

                        <!-- Category Image -->
                        <td class="p-4">
                            <div class="w-20 h-20 overflow-hidden rounded shadow-sm">
                                <img src="{{ $subCategory['img'] }}" alt="{{ $subCategory['name'] }}" 
                                     class="object-cover w-full h-full">
                            </div>
                        </td>

                        <!-- Category Name -->
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-black font-medium">
                                {{ $subCategory['name'] }}
                            </p>
                        </td>

                        <!-- Parent Category -->
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-gray-600">
                                {{ $subCategory['mainCategory']['name'] ?? 'N/A' }}
                            </p>
                        </td>

                        <!-- Action -->
                        <td class="p-4 text-right">
                            <div class="relative inline-block text-left" x-data="{ open: false }"
                                x-on:click.outside="open = false">
                                <button x-on:click="open = !open"
                                    class="text-[#AD8945] rounded-full focus:outline-none" title="Settings">
                                    <flux:icon name="cog-6-tooth" class="text-[#C7AE6A]" />
                                </button>

                                <!-- Dropdown -->
                                <div x-show="open" 
                                     x-transition
                                     x-cloak
                                     class="absolute right-3 mt-2 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">

                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer" 
                                        wire:click="SubCategoryDetails('{{ encrypt($subCategory['id']) }}')">
                                        <flux:icon name="eye" class="text-[#6D6D6D] mr-2 h-4 w-4" /> Details
                                    </button>

                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" /> Edit
                                    </button>

                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="check" class="text-[#6D6D6D] mr-2 h-4 w-4" /> Active
                                    </button>

                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="x-circle" class="text-[#6D6D6D] mr-2 h-4 w-4" /> Deactivate
                                    </button>

                                    <button
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" /> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">No categories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Sub Category Details Modal -->
    <div x-data="{ show: @entangle('SubCategoryDetailsModal') }" 
         x-show="show" 
         x-cloak 
         x-effect="document.body.classList.toggle('overflow-hidden', show)"
         class="fixed inset-0 z-50 overflow-y-auto">

        <div class="flex items-center justify-center min-h-screen px-4 py-8">

            <!-- Backdrop -->
            <div x-show="show" 
                 x-cloak
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" 
                 wire:click="closeDetailModal">
            </div>

            <!-- Modal Content -->
            <div x-show="show" 
                 x-cloak
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-6 scale-95"
                 class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full p-8 sm:p-10" 
                 wire:click.stop>

                <!-- Close Button -->
                <button wire:click="closeDetailModal"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <!-- Header -->
                <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                    <img src="{{ $subCategory['img'] ?? 'https://via.placeholder.com/150' }}" 
                         alt="Category Image"
                         class="w-20 h-20 rounded-lg object-cover shadow">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">
                            {{ $subCategory['name'] ?? 'Unknown Category' }}
                        </h2>
                        <p class="text-sm text-[#AD8945]">
                            {{ $subCategory['mainCategory']['name'] ?? '' }}
                        </p>
                    </div>
                </div>

                <!-- Category Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Category Name</label>
                        <p class="text-gray-800 font-semibold">{{ $subCategory['name'] ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Parent Category</label>
                        <p class="text-gray-800 font-semibold">{{ $subCategory['mainCategory']['name'] ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg md:col-span-2">
                        <label class="text-xs text-gray-500 font-medium mb-1">Description</label>
                        <p class="text-gray-800">{{ $subCategory['description'] ?? 'No description available' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Has Specific Category</label>
                        <p class="text-gray-800">
                            @if(isset($subCategory['hasSpecificCategory']))
                                {{ $subCategory['hasSpecificCategory'] ? 'Yes' : 'No' }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Contact WhatsApp</label>
                        <p class="text-gray-800">
                            @if(isset($subCategory['contactWhatsapp']))
                                {{ $subCategory['contactWhatsapp'] ? 'Enabled' : 'Disabled' }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                </div>

                <!-- Footer -->
                <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end">
                    <button wire:click="closeDetailModal"
                        class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#AD8945] to-amber-600 hover:from-[#9c7a3d] hover:to-amber-700 rounded-lg shadow transition transform hover:scale-[1.02]">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Pagination -->
    {{-- @if (!empty($pagination) && ($pagination['pages'] ?? 1) > 1)
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
    @endif --}}

</section>