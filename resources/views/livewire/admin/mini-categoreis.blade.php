<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Sub Category</h2>
    <nav class="sm:mt-8">
        <!-- Navigation links container -->
        @include('livewire.admin.category-management.navbar')
    </nav>

    <div class="bg-white rounded-lg overflow-y-visible mt-14 mb-5">
        <x-admin.searchbar />
    </div>

    <x-admin.data-table :items="$items" :columns="$columns" :actions="$actions" />


    {{-- Add Mini Category Modal    --}}

    {{-- Edit Mini Category Modal --}}

    <div x-data="{ show: @entangle('addMiniSubCategoryModal') }" x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
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

                    <div class="flex justify-between items-center pb-3">
                        <h3 class="text-xl font-semibold text-gray-900">Edit Mini Sub Category</h3>
                        <button wire:click="closeAddModal()"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form wire:submit.prevent="SaveMiniCategory">

                        <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                            <div class="mb-6">
                                <label for="category-title" class="block text-sm font-medium text-gray-700 mb-2">Mini
                                    Sub
                                    Category
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
                                <select id="parent-categories" wire:model="subCategoryId"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] ">
                                    <option>Select your sub category</option>
                                    @foreach ($subCategories as $item)
                                        <option value="{{ $item['id'] }}"
                                            @if ($subCategoryId == $item['id']) selected @endif> {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subCategoryId')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>




                            <div class="mb-6 space-y-4">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2"> Image</label>
                                    <div x-data="{ image: null, dragOver: false }" class="space-y-4">
                                        <div class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                                            @drop.prevent="image = $event.dataTransfer.files[0]"
                                            @click="$refs.mainImageInput.click()"
                                            :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                                            <input type="file" x-ref="mainImageInput" wire:model="image"
                                                class="hidden" @change="image = $event.target.files[0]">

                                            <div class="text-center px-2">
                                                <div class="mb-4 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-500"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop
                                                    it
                                                    here</p>
                                                <button type="button"
                                                    class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100">Browse
                                                    File</button>
                                            </div>

                                        </div>
                                        @error('image')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror

                                        <div x-show="image" class="mt-3">
                                            <div class="relative w-32 flex-shrink-0">
                                                <img :src="URL.createObjectURL(image)"
                                                    class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                                <button type="button" @click="image = null"
                                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="mb-6 space-y-4" x-data="{ on: $wire.entangle('hasForm') }">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Has Form</span>
                                    <div class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200"
                                        :class="on ? 'bg-[#C7AE6A]' : 'bg-gray-300'" @click="on = !on">
                                        <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200"
                                            :class="on ? 'translate-x-6' : 'translate-x-0'">
                                        </div>
                                    </div>
                                </div>

                                <!-- Input visible only when hasForm = true -->
                                <div class="mb-6" x-show="on" x-transition>
                                    <label for="Form Name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Mini Sub Form Name
                                    </label>
                                    <input wire:model="fromName" type="text" id="category-title"
                                        placeholder="Enter your title here"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                    @error('fromName')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="flex justify-center">
                                <button wire:click="SaveMiniCategory"
                                    class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                                    Update Mini Category
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Mini Category Modal --}}

    {{-- End Add Mini Category Modal    --}}


    {{-- Edit Mini Category Modal --}}

    <div x-data="{ show: @entangle('editMiniSubCategoryModal') }" x-show="show" x-cloak
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
                        <h3 class="text-xl font-semibold text-gray-900">Edit Mini Sub Category</h3>
                        <button wire:click="closeEditModal()"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form wire:submit.prevent="updateMiniCategory">

                        <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                            <div class="mb-6">
                                <label for="category-title" class="block text-sm font-medium text-gray-700 mb-2">Mini
                                    Sub
                                    Category
                                    Title</label>
                                <input wire:model="name" type="text" id="category-title"
                                    placeholder="Enter your title here"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="parent-categories"
                                    class="block text-sm font-medium text-gray-700 mb-2">Sub
                                    Categories</label>
                                <select id="parent-categories" wire:model="subCategoryId"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] ">
                                    <option>Select your sub category</option>
                                    @foreach ($subCategories as $item)
                                        <option value="{{ $item['id'] }}"
                                            @if ($subCategoryId == $item['id']) selected @endif> {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subCategoryId')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>




                            <div class="mb-6 space-y-4">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2"> Image</label>
                                    <div x-data="{ image: null, dragOver: false }" class="space-y-4">
                                        <div class="h-64 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                                            @drop.prevent="image = $event.dataTransfer.files[0]"
                                            @click="$refs.mainImageInput.click()"
                                            :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                                            <input type="file" x-ref="mainImageInput" wire:model="image"
                                                class="hidden" @change="image = $event.target.files[0]">

                                            <div class="text-center px-2">
                                                <div class="mb-4 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-500"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop
                                                    it
                                                    here</p>
                                                <button type="button"
                                                    class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100">Browse
                                                    File</button>
                                            </div>

                                        </div>
                                        @error('image')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror

                                        <div x-show="image" class="mt-3">
                                            <div class="relative w-32 flex-shrink-0">
                                                <img :src="URL.createObjectURL(image)"
                                                    class="w-full h-32 object-cover rounded-md border" alt="Preview">
                                                <button type="button" @click="image = null"
                                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="mb-6 space-y-4" x-data="{ on: $wire.entangle('hasForm') }">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Has Form</span>
                                    <div class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200"
                                        :class="on ? 'bg-[#C7AE6A]' : 'bg-gray-300'" @click="on = !on">
                                        <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200"
                                            :class="on ? 'translate-x-6' : 'translate-x-0'">
                                        </div>
                                    </div>
                                </div>

                                <!-- Input visible only when hasForm = true -->
                                <div class="mb-6" x-show="on" x-transition>
                                    <label for="Form Name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Mini Sub Form Name
                                    </label>
                                    <input wire:model="fromName" type="text" id="category-title"
                                        placeholder="Enter your title here"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                    @error('fromName')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="flex justify-center">
                                <button wire:click="updateMiniCategory"
                                    class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                                    Update Mini Category
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Mini Category Modal --}}


    {{-- Details Modal --}}

    <!-- Sub Category Details Modal -->
    <div x-data="{ show: @entangle('MiniSubCategoryDetailsModal') }" x-show="show" x-cloak
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
                    <img src="{{ $miniSubCategory['img'] ?? 'https://via.placeholder.com/150' }}"
                        alt="Category Image" class="w-20 h-20 rounded-lg object-cover shadow">
                    <div>

                        <h2 class="text-2xl font-semibold text-gray-800">
                            {{ $miniSubCategory['name'] ?? 'Unknown Mini Category' }}
                        </h2>
                        <p class="text-sm text-[#AD8945]">
                            {{ $miniSubCategory['subCategory']['name'] ?? '' }}
                        </p>
                    </div>
                </div>

                <!-- Category Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Mini Name</label>
                        <p class="text-gray-800 font-semibold">{{ $miniSubCategory['name'] ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Main Category</label>
                        <p class="text-gray-800 font-semibold">
                            {{ $miniSubCategory['subCategory']['mainCategory']['name`'] ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg md:col-span-2">
                        <label class="text-xs text-gray-500 font-medium mb-1">Description</label>
                        <p class="text-gray-800">
                            {{ $miniSubCategory['description']['content'] ?? 'No description available' }}</p>
                    </div>
                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg md:col-span-2">
                        <label class="text-xs text-gray-500 font-medium mb-1">Section Description</label>
                        <p class="text-gray-800">
                            {{ $miniSubCategory['description']['section'] ?? 'No description available' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Has Specific Category</label>
                        <p class="text-gray-800">
                            @if (isset($miniSubCategory['hasSpecificCategory']))
                                {{ $miniSubCategory['hasSpecificCategory'] ? 'Yes' : 'No' }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Contact WhatsApp</label>
                        <p class="text-gray-800">
                            @if (isset($subCategory['contractWhatsapp']))
                                {{ $miniSubCategory['contractWhatsapp'] ? 'Enabled' : 'Disabled' }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Created at</label>
                        <p class="text-gray-800">
                            @if (isset($miniSubCategory['createdAt']))
                                {{ $miniSubCategory['createdAt'] ? format_date_time($miniSubCategory['createdAt']) : 'Uknown' }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Updated at</label>
                        <p class="text-gray-800">
                            @if (isset($miniSubCategory['updatedAt']))
                                {{ $miniSubCategory['updatedAt'] ? format_date_time($miniSubCategory['updatedAt']) : 'Uknown' }}
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
    {{-- Details Modal End --}}


    <!-- Pagination -->
    @if (!empty($pagination) && ($pagination['pages'] ?? 1) > 1)
        <div class="flex items-center justify-center space-x-2 py-3 my-3 flex-wrap border-t border-slate-200 border-none">
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
