<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Mini Category</h2>
    <nav class=" sm:mt-8 ">
        @include('livewire.admin.category-management.navbar')
    </nav>

    <div x-data="{
        addMiniCategoryModal: @entangle('addMiniCategoryModal'),
        editMiniCategoryModal: @entangle('editMiniCategoryModal')
    }">

        <x-admin.searchbar page="Add " livewire_method="switchAddMiniCategoryModal" />

        <div x-show="addMiniCategoryModal" x-transition.opacity>
            <div class="fixed max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
                <div class="flex min-h-full items-center justify-center p-4">
                    <div @click.away="addMiniCategoryModal = false"
                        class="relative w-full max-w-[1200px] mx-auto rounded-lg shadow-lg bg-white p-6">
                        <button wire:click="switchAddMiniCategoryModal"
                            class="absolute cursor-pointer top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                            <flux:icon name="x-circle" class="h-6 w-6" />
                        </button>
                        <div class="flex items-center justify-between border-gray-200 pb-4">
                            <h1 class="text-4xl font-semibold text-gray-900">Add Mini Category</h1>
                        </div>

                        <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                            <form wire:submit.prevent="saveMiniSubCategories">
                                <div class="mb-6">
                                    <label for="parent-sub-category"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Parent Sub Category
                                    </label>
                                    <select id="parent-sub-category" wire:model.defer="subCategoryId"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                        <option value="">Select a parent sub category</option>
                                        @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory['id'] }}">{{ $subCategory['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label for="category-title"
                                        class="block text-sm font-medium text-gray-700 mb-2">Category Title</label>
                                    <input type="text" id="category-title" placeholder="Enter your title here"
                                        wire:model.defer="name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                </div>

                                <div class="mb-6">
                                    <label for="form-name" class="block text-sm font-medium text-gray-700 mb-2">Form
                                        Name</label>
                                    <textarea id="form-name-input" rows="4" placeholder="Enter your form name here" wire:model.defer="formName"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                                </div>

                                <div class="mb-6 space-y-4">
                                    <div>
                                        <label for="image-upload"
                                            class="block text-sm font-medium text-gray-700 mb-2">Category Image</label>
                                        <div
                                            class="relative flex items-center justify-center h-48 border-4 border-dashed rounded-md p-6 text-center transition-colors cursor-pointer border-[#C7AE6A]">
                                            <input id="image-upload" type="file" wire:model="image" accept="image/*"
                                                class="absolute inset-0 opacity-0 cursor-pointer">

                                            {{-- Show image preview --}}
                                            @if ($image)
                                                @if (is_object($image))
                                                    <img src="{{ $image->temporaryUrl() }}" alt="Category Image Preview"
                                                        class="w-full h-full object-cover rounded-md">
                                                @else
                                                    <img src="{{ asset('storage/' . $image) }}"
                                                        alt="Existing Category Image"
                                                        class="w-full h-full object-cover rounded-md">
                                                @endif
                                            @else
                                                <div class="flex flex-col items-center pointer-events-none">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                    </svg>
                                                    <p class="mt-1 text-sm text-gray-600">Choose a file or drag & drop
                                                        it
                                                        here</p>
                                                </div>
                                            @endif
                                        </div>
                                        @error('image')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex items-center justify-between py-2 mb-4">
                                    <label for="hasForm-toggle"
                                        class="text-lg font-semibold text-gray-700">hasForm</label>
                                    <div x-data="{ on: @entangle('hasForm') }" @click="on = !on"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#ad8945] focus:ring-offset-2"
                                        :class="{ 'bg-[#ad8945]': on, 'bg-gray-200': !on }">
                                        <span class="sr-only">Toggle hasForm</span>
                                        <span aria-hidden="true"
                                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                            :class="{ 'translate-x-5': on, 'translate-x-0': !on }"></span>
                                    </div>
                                </div>

                                <div class="flex justify-left ">
                                    <button type="submit"
                                        class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                                        Save Category
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg overflow-x-auto md:overflow-x-visible mt-14 mb-5">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-[#E7E7E7] hidden md:table-row">
                        <th class="p-4 text-left font-medium text-base w-[5%]">SL</th>

                        <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                            Image
                        </th>
                        <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                            Mini Category Name
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
                    @foreach ($miniSubCategories as $miniSubCategory)
                        <tr class="md:table-row grid grid-cols-1 md:grid-cols-none items-center transition relative">
                            <td class="p-4 text-left font-normal text-base">
                                <p class="text-black whitespace-nowrap">{{ $loop->iteration }}</p>
                            </td>

                            <td class="p-4">
                                <div class="w-20 h-20 overflow-hidden rounded shadow-sm">
                                    <img src="{{ asset($miniSubCategory['img']) }}" alt=""
                                        class="object-cover w-full h-full">
                                </div>
                            </td>
                            <td class="p-4 text-left font-normal text-base">
                                <p class="text-black font-medium">{{ $miniSubCategory['name'] }}</p>
                            </td>
                            <td class="p-4 text-left font-normal text-base">
                                <p class="text-gray-600">{{ $miniSubCategory['subCategory']['name'] }}</p>
                            </td>

                            <td class="p-4 text-right md:static absolute top-2 right-2">
                                <div class="relative inline-block text-left" x-data="{ open: false }"
                                    x-on:click.outside="open = false">
                                    <button x-on:click="open = !open"
                                        class="text-[#AD8945] rounded-full focus:outline-none" title="Settings">
                                        <flux:icon name="cog-6-tooth" class="text-[#C7AE6A] h-6 w-6" />
                                    </button>
                                    <div x-show="open" x-transition
                                        class="absolute right-0 mt-2 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                                        <button wire:click="switchEditMiniCategoryModal"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                            <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            Edit
                                        </button>
                                        <button
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                            <flux:icon name="check" class="text-[#6D6D6D] mr-2 h-4 w-4" /> Active
                                        </button>
                                        <button
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                            <flux:icon name="x-circle" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            Deactivate
                                        </button>
                                        <button
                                            wire:click="deleteMiniSubCategory('{{ encrypt($miniSubCategory['id']) }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                            <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" /> Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div x-show="editMiniCategoryModal" x-transition.opacity>
                <div class="fixed max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
                    <div class="flex min-h-full items-center justify-center p-4">
                        <div @click.away="editMiniCategoryModal = false"
                            class="relative w-full max-w-[1200px] mx-auto rounded-lg shadow-lg bg-white p-6">
                            <button wire:click="switchEditMiniCategoryModal"
                                class="absolute cursor-pointer top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                                &times;
                            </button>
                            <div class="flex items-center justify-between border-gray-200 pb-4">
                                <h1 class="text-4xl font-semibold text-gray-900">Edit Mini Category</h1>
                            </div>

                            <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                                <div class="mb-6">
                                    <label for="category-title"
                                        class="block text-sm font-medium text-gray-700 mb-2">Category
                                        Title</label>
                                    <input type="text" id="category-title" placeholder="Enter your title here"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                </div>

                                <div class="mb-6">
                                    <label for="category-description"
                                        class="block text-sm font-medium text-gray-700 mb-2">Category
                                        Description</label>
                                    <textarea id="category-description" rows="4" placeholder="Enter your description here"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                                </div>

                                <div class="mb-6 space-y-4">
                                    <div>
                                        <label for="hero-image-upload"
                                            class="block text-sm font-medium text-gray-700 mb-2">Category
                                            Image</label>
                                        <label for="hero-image-upload" x-data="{ heroImage: null, isDragging: false }"
                                            @dragover.prevent="isDragging = true"
                                            @dragleave.prevent="isDragging = false"
                                            @drop.prevent="isDragging = false;
                                                if (event.dataTransfer.files.length) {
                                                    const file = event.dataTransfer.files[0];
                                                    if (file.type.startsWith('image/')) {
                                                        const reader = new FileReader();
                                                        reader.onload = (e) => heroImage = e.target.result;
                                                        reader.readAsDataURL(file);
                                                    }
                                                }"
                                            class="relative flex items-center justify-center h-48 border-4 border-dashed rounded-md p-6 text-center transition-colors cursor-pointer"
                                            :class="{
                                                'border-blue-500': isDragging,
                                                'border-[#C7AE6A]': !isDragging
                                            }">
                                            <input id="hero-image-upload" type="file"
                                                @change="if (event.target.files.length) {
                                                    const file = event.target.files[0];
                                                    if (file.type.startsWith('image/')) {
                                                        const reader = new FileReader();
                                                        reader.onload = (e) => heroImage = e.target.result;
                                                        reader.readAsDataURL(file);
                                                    }
                                                }"
                                                class="hidden">

                                            <template x-if="heroImage">
                                                <div class="relative w-full h-full">
                                                    <img :src="heroImage" alt="Hero Image Preview"
                                                        class="w-full h-full object-cover rounded-md">
                                                    <button @click.prevent="heroImage = null"
                                                        class="absolute top-2 right-2 p-1 rounded-full bg-red-500 text-white hover:bg-red-700 focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </template>

                                            <template x-if="!heroImage">
                                                <div class="flex flex-col items-center pointer-events-none">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                    </svg>
                                                    <p class="mt-1 text-sm text-gray-600">Choose a
                                                        file or drag & drop it here
                                                    </p>
                                                </div>
                                            </template>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-2 mb-4">
                                    <label for="hasForm-toggle"
                                        class="text-lg font-semibold text-gray-700">hasForm</label>
                                    <div x-data="{ on: true }" @click="on = !on"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#ad8945] focus:ring-offset-2"
                                        :class="{ 'bg-[#ad8945]': on, 'bg-gray-200': !on }">
                                        <span class="sr-only">Toggle hasForm</span>
                                        <span aria-hidden="true"
                                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                            :class="{ 'translate-x-5': on, 'translate-x-0': !on }"></span>
                                    </div>
                                </div>

                                <div class="flex justify-left">
                                    <button x-on:click="switchAddMiniCategoryModal()"
                                        class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                                        Save Category
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
</section>
