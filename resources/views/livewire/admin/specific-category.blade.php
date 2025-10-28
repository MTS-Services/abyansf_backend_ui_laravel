<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Specific Category</h2>
    <nav class="sm:mt-8">
        <!-- Navigation links container -->
        @include('livewire.admin.category-management.navbar')
    </nav>


    <x-admin.searchbar :dropdowns="$dropdowns" :buttons="$buttons" />

    <!-- Add Sub Category Modal -->
    <div x-data="{ show: @entangle('addSpecificCategoryModal') }" x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
        x-transition.opacity>
        <div class="fixed max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="show" @click.away="$wire.closeAddModal()" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative w-full max-w-[1200px] mx-auto rounded-lg shadow-lg bg-white p-6">
                    <form wire:submit.prevent="saveSpecificCategory">

                        <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                            <div class="mb-6">
                                <label for="category-title" class="block text-sm font-medium text-gray-700 mb-2">Edit
                                    Specific Category Title</label>
                                <input wire:model="name" type="text" id="category-title" title="Separate each category by comma"
                                    placeholder="Enter your title here and separate each by comma ',' "
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-6">
                                <label for="parent-categories" class="block text-sm font-medium text-gray-700 mb-2">Sub
                                    Categories</label>
                                <select id="parent-categories" wire:model="sub_category_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] ">
                                    <option>Select your sub category</option>
                                    @foreach ($subCategories as $item)
                                        <option value="{{ $item['id'] }}"
                                            @if ($sub_category_id == $item['id']) selected @endif> {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="flex justify-center">
                                <button wire:click="saveSpecificCategory"
                                    class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                                    Add Specific Category
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


    {{-- Edit Category Modal --}}

    <div x-data="{ show: @entangle('editSpecificCategoryModal') }" x-show="show" x-cloak
        x-effect="document.body.classList.toggle('overflow-hidden', show)" x-transition.opacity>
        <div class="fixed max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="show" @click.away="$wire.closeEditModal()" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative w-full max-w-[1200px] mx-auto rounded-lg shadow-lg bg-white p-6">

                    <div class="flex justify-between items-center pb-3">
                        <h3 class="text-xl font-semibold text-gray-900">Edit Specific Category</h3>
                        <button wire:click="closeEditModal"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form wire:submit.prevent="updateSpecificCategory">

                        <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                            <div class="mb-6">
                                <label for="category-title" class="block text-sm font-medium text-gray-700 mb-2">Edit
                                    Specific Category
                                    Title</label>
                                <input wire:model="name" type="text" id="category-title"
                                    placeholder="Enter your title here"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-6">
                                <label for="parent-categories" class="block text-sm font-medium text-gray-700 mb-2">Sub
                                    Categories</label>
                                <select id="parent-categories" wire:model="sub_category_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] ">
                                    <option>Select your sub category</option>
                                    @foreach ($subCategories as $item)
                                        <option value="{{ $item['id'] }}"
                                            @if ($sub_category_id == $item['id']) selected @endif> {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subCategoryId')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="flex justify-center">
                                <button wire:click="updateSpecificCategory"
                                    class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                                    Update Specific Category
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- End Sub Category Edit Modal --}}

    <!-- Sub Categories Table -->
    <div class="bg-white rounded-lg overflow-y-visible mt-14 mb-5">

        <x-admin.data-table :items="$specificCategories" :columns="$columns" :actions="$actions" />


    </div>

    <!-- Specific Category Details Modal -->
    <div x-data="{ show: @entangle('SpecificCategoryDetailsModal') }" x-show="show" x-cloak
        x-effect="document.body.classList.toggle('overflow-hidden', show)" class="fixed inset-0 z-50 overflow-y-auto">

        <div class="flex items-center justify-center min-h-screen px-4 py-8">

            <!-- Backdrop -->
            <div x-show="show" x-cloak x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"
                wire:click="closeDetailModal">
            </div>

            <!-- Modal Content -->
            <div x-show="show" x-cloak x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-6 scale-95"
                class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full p-8 sm:p-10" wire:click.stop>

                <!-- Close Button -->
                <button wire:click="closeDetailModal"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <!-- Header -->
                <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                    
                    <div>

                        <h2 class="text-2xl font-semibold text-gray-800">
                            {{ $specificCategory['name'] ?? 'Unknown Category' }}
                        </h2>
                    </div>
                </div>

                <!-- Category Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Created at</label>
                        <p class="text-gray-800">
                            @if (isset($specificCategory['createdAt']))
                                {{ $specificCategory['createdAt'] ? format_date_time($specificCategory['createdAt']) : 'Uknown' }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Updated at</label>
                        <p class="text-gray-800">
                            @if (isset($specificCategory['updatedAt']))
                                {{ $specificCategory['updatedAt'] ? format_date_time($specificCategory['updatedAt']) : 'Uknown' }}
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



</section>
