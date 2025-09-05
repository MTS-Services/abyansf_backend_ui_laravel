<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Sub Category</h2>
    <nav class=" sm:mt-8 ">


        <!-- Navigation links container -->
        @include('livewire.admin.category-management.navbar')
    </nav>
    <x-admin.searchbar page="Add " livewire_method="switchAddSubCategoryModal" />
    <!---Add Sub Category Model-->
    <div x-data="{ open: @entangle('addSubCategoryModal') }" x-show="open">
        <div class="fixed max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
            <div class="flex min-h-full items-center justify-center p-4">
                <div @click.away="addSubCategoryModal = false"
                    class="relative w-full max-w-[1200px] mx-auto rounded-lg shadow-lg bg-white p-6">
                    <button wire:click="switchAddSubCategoryModal"
                        class="absolute cursor-pointer top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                        <flux:icon name="x-circle" class="h-6 w-6" />
                    </button>
                    <div class="flex items-center justify-between border-gray-200 pb-4">
                        <h1 class="text-4xl font-semibold text-gray-900">Add Category</h1>
                    </div>

                    <form wire:submit.prevent="saveSubCategory">
                        <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                            {{-- SubCategory Title --}}
                            <div class="mb-6">
                                <label for="category-title"
                                    class="block text-sm font-medium text-gray-700 mb-2">SubCategory Title</label>
                                <input type="text" id="category-title" placeholder="Enter your title here"
                                    wire:model.defer="name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Sub Category Description --}}
                            <div class="mb-6">
                                <label for="category-description"
                                    class="block text-sm font-medium text-gray-700 mb-2">Sub Category
                                    Description</label>
                                <textarea id="category-description" rows="4" placeholder="Enter your description here"
                                    wire:model.defer="description"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Image Uploads --}}
                            <div class="mb-6 space-y-4">
                                <div>
                                    <label for="image-upload" class="block text-sm font-medium text-gray-700 mb-2">Sub
                                        Category Image</label>
                                    <input id="image-upload" type="file" wire:model="image" class="hidden">
                                    <label for="image-upload"
                                        class="relative flex items-center justify-center h-48 border-4 border-dashed rounded-md p-6 text-center transition-colors cursor-pointer border-[#C7AE6A]">
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" alt="Image Preview"
                                                class="w-full h-full object-cover rounded-md">
                                        @else
                                            <div class="flex flex-col items-center pointer-events-none">
                                                <svg class="mx-auto h-12 w-12 text-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                                <p class="mt-1 text-sm text-gray-600">Choose a file or drag & drop it
                                                    here</p>
                                            </div>
                                        @endif
                                    </label>
                                    @error('image')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="hero-image-upload"
                                        class="block text-sm font-medium text-gray-700 mb-2">Hero Image</label>
                                    <input id="hero-image-upload" type="file" wire:model="heroImage" class="hidden">
                                    <label for="hero-image-upload"
                                        class="relative flex items-center justify-center h-48 border-4 border-dashed rounded-md p-6 text-center transition-colors cursor-pointer border-[#C7AE6A]">
                                        @if ($heroImage)
                                            <img src="{{ $heroImage->temporaryUrl() }}" alt="Hero Image Preview"
                                                class="w-full h-full object-cover rounded-md">
                                        @else
                                            <div class="flex flex-col items-center pointer-events-none">
                                                <svg class="mx-auto h-12 w-12 text-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 003 3h10a3 3 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                                <p class="mt-1 text-sm text-gray-600">Choose a file or drag & drop it
                                                    here</p>
                                            </div>
                                        @endif
                                    </label>
                                    @error('heroImage')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Toggle Switches and Input Field --}}
                            <div class="mb-6 space-y-4">
                            <div class="flex items-center justify-between w-full">
                                <span class="text-sm font-medium text-gray-700">hasSpecificCategory</span>
                                <label
                                    class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200"
                                    x-data="{ hasSpecificCategory: @entangle('hasSpecificCategory') }"
                                    :class="{ 'bg-[#C7AE6A]': hasSpecificCategory, 'bg-gray-200': !hasSpecificCategory }">
                                    <input type="checkbox" wire:model="hasSpecificCategory" class="hidden">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200"
                                        :class="{ 'translate-x-6': hasSpecificCategory, 'translate-x-0': !hasSpecificCategory }">
                                    </div>
                                </label>
                            </div>

                            <div class="flex items-center justify-between w-full">
                                <span class="text-sm font-medium text-gray-700">ContractWhatsapp</span>
                                <label
                                    class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200"
                                    x-data="{ contractWhatsappSubCategory: @entangle('contractWhatsappSubCategory') }"
                                    :class="{ 'bg-[#C7AE6A]': contractWhatsappSubCategory, 'bg-gray-200': !
                                            contractWhatsappSubCategory }">
                                    <input type="checkbox" wire:model="contractWhatsappSubCategory" class="hidden">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200"
                                        :class="{ 'translate-x-6': contractWhatsappSubCategory, 'translate-x-0': !
                                                contractWhatsappSubCategory }">
                                    </div>
                                </label>
                            </div>

                            <div class="flex items-center justify-between w-full">
                                <span class="text-sm font-medium text-gray-700">hasMiniSubCategory</span>
                                <label
                                    class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200"
                                    x-data="{ hasMiniSubCategory: @entangle('hasMiniSubCategory') }"
                                    :class="{ 'bg-[#C7AE6A]': hasMiniSubCategory, 'bg-gray-200': !hasMiniSubCategory }">
                                    <input type="checkbox" wire:model="hasMiniSubCategory" class="hidden">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200"
                                        :class="{ 'translate-x-6': hasMiniSubCategory, 'translate-x-0': !hasMiniSubCategory }">
                                    </div>
                                </label>
                            </div>
                            </div>
                            {{-- Parent Category Select --}}
                            <div class="mb-6">
                                <label for="parent-categories"
                                    class="block text-sm font-medium text-gray-700 mb-2">Parent Categories</label>
                                <select id="parent-categories" wire:model.defer="mainCategoryId"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                    <option value="">Select your parent categories</option>
                                    {{-- Assuming you have a property to hold your parent categories --}}
                                    @foreach ($mainCategories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('mainCategoryId')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-left">
                                <button type="submit"
                                    class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                                    Save Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Event Modal -->

    <div class="bg-white rounded-lg overflow-x-auto md:overflow-x-visible mt-14 mb-5">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-[#E7E7E7] hidden md:table-row">
                    <th class="p-4 text-left font-medium text-base w-[5%]">SL</th>
                    <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[20%]">
                        Image
                    </th>
                    <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Sub Category Name
                    </th>
                    <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Main Category Name
                    </th>
                    <th class="p-4 text-right font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($subCategories as $subCategory)
                    <tr class="md:table-row grid grid-cols-1 md:grid-cols-none items-center transition relative">
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-black whitespace-nowrap">{{ $loop->iteration }}</p>
                        </td>
                        <td class="p-4">
                            <div class="w-20 h-20 overflow-hidden rounded shadow-sm">
                                <img src="{{ asset($subCategory['img']) }}" alt=""
                                    class="object-cover w-full h-full">
                            </div>
                        </td>
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-black font-medium">{{ $subCategory['name'] }}</p>
                        </td>
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-black font-medium">{{ $subCategory['mainCategory']['name'] }}</p>
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
                                    <button wire:click="openEditSubCategory('{{ encrypt($subCategory['id']) }}')"
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
                                    <button wire:click="deleteSubCategory('{{ encrypt($subCategory['id']) }}')"
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
    </div>

    <!-- Edit Category Modal -->
    <div x-data="{ open: @entangle('editSubCategoryModal') }" x-show="open" x-transition.opacity>
        <div class="fixed  max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
            <div class="flex min-h-full  items-center justify-center p-4">
                <div @click.away="editSubCategoryModal = false"
                    class="relative w-full max-w-[1200px] mx-auto  rounded-lg shadow-lg bg-white p-6">
                    <!-- Close Button -->
                    <button wire:click="switchEditSubCategoryModal"
                        class="absolute cursor-pointer top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                        <flux:icon name="x-circle" class="h-6 w-6" />
                    </button>
                    <!-- Header -->
                    <div class="flex items-center justify-between border-gray-200 pb-4">
                        <h1 class="text-4xl font-semibold text-gray-900">Edit Category</h1>
                    </div>

                    <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                        <form wire:submit.prevent="updateSubCategory" class="space-y-6">
                        <div  class="mb-6">
                            <label for="category-title" class="block text-sm font-medium text-gray-700 mb-2">Category
                                Title</label>
                            <input type="text" wire:model='name' id="category-title" placeholder="Enter your title here"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>

                        <div class="mb-6">
                            <label for="category-description"
                                class="block text-sm font-medium text-gray-700 mb-2">Category
                                Description</label>
                            <textarea id="category-description" rows="4" placeholder="Enter your description here"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none " wire:model='description'></textarea>
                        </div>

                        <div class="mb-6 space-y-4">
                            <div>
                                <label for="hero-image-upload"
                                    class="block text-sm font-medium text-gray-700 mb-2">Category
                                    Image</label>
                                <label for="hero-image-upload" x-data="{ heroImage: null, isDragging: false }"
                                    @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
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
                                        'border-[#C7AE6A]': !
                                            isDragging
                                    }">

                                    <input id="hero-image-upload" type="file" wire:model="img" accept="image/*" x-ref="image"
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
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                            </svg>
                                            <p class="mt-1 text-sm text-gray-600">Choose a file
                                                or drag & drop it here
                                            </p>
                                        </div>
                                    </template>
                                </label>
                            </div>

                            <div>
                                <label for="category-image-upload"
                                    class="block text-sm font-medium text-gray-700 mb-2">Hero
                                    Image</label>
                                <label for="category-image-upload" x-data="{ categoryImage: null, isDragging: false }"
                                    @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                    @drop.prevent="isDragging = false;
                                                                if (event.dataTransfer.files.length) {
                                                                    const file = event.dataTransfer.files[0];
                                                                    if (file.type.startsWith('image/')) {
                                                                        const reader = new FileReader();
                                                                        reader.onload = (e) => categoryImage = e.target.result;
                                                                        reader.readAsDataURL(file);
                                                                    }
                                                                }"
                                    class="relative flex items-center justify-center h-48 border-4 border-dashed rounded-md p-6 text-center transition-colors cursor-pointer"
                                    :class="{
                                        'border-blue-500': isDragging,
                                        'border-[#C7AE6A]': !
                                            isDragging
                                    }">

                                    <input id="category-image-upload" type="file" wire:model="heroImage" accept="image/*" x-ref="heroImage"
                                        @change="if (event.target.files.length) {
                                                              const file = event.target.files[0];
                                                              if (file.type.startsWith('image/')) {
                                                                  const reader = new FileReader();
                                                                  reader.onload = (e) => categoryImage = e.target.result;
                                                                  reader.readAsDataURL(file);
                                                              }
                                                          }"
                                        class="hidden">

                                    <template x-if="categoryImage">
                                        <div class="relative w-full h-full">
                                            <img :src="categoryImage" alt="Category Image Preview"
                                                class="w-full h-full object-cover rounded-md">
                                            <button @click.prevent="categoryImage = null"
                                                class="absolute top-2 right-2 p-1 rounded-full bg-red-500 text-white hover:bg-red-700 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>

                                    <template x-if="!categoryImage">
                                        <div class="flex flex-col items-center pointer-events-none">
                                            <svg class="mx-auto h-12 w-12 text-gray-400"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                            </svg>
                                            <p class="mt-1 text-sm text-gray-600">Choose a file
                                                or drag & drop it here
                                            </p>
                                        </div>
                                    </template>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">hasSpecificCategory</span>
                                <div class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200 bg-[#C7AE6A]" wire:model="hasSpecificCategory"
                                    x-data="{ on: true }" @click="on = !on" :class="{ 'bg-gray-200': !on }">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200" wire:model="hasSpecificCategory"
                                        :class="{ 'translate-x-6': on, 'translate-x-0': !on }">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">contactWhatsapp</span>
                                <div class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200 bg-[#C7AE6A]" wire:model="contactWhatsapp"
                                    x-data="{ on: true }" @click="on = !on" :class="{ 'bg-gray-200': !on }">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200" wire:model="contactWhatsapp"
                                        :class="{ 'translate-x-6': on, 'translate-x-0': !on }">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Create
                                    Mini-Category</span>
                                <div class="relative inline-block w-12 h-6 rounded-full cursor-pointer transition-colors duration-200 bg-[#C7AE6A]" wire:model="hasMiniSubCategory"
                                    x-data="{ on: true }" @click="on = !on" :class="{ 'bg-gray-200': !on }">
                                    <div class="absolute left-0 inline-block w-6 h-6 transform bg-white rounded-full shadow-lg transition-transform duration-200" wire
                                        :class="{ 'translate-x-6': on, 'translate-x-0': !on }">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Parent Category Select --}}
                            <div class="mb-6">
                                <label for="parent-categories"
                                    class="block text-sm font-medium text-gray-700 mb-2">Parent Categories</label>
                                <select id="parent-categories" wire:model="mainCategoryId"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                                    <option value="">Select your parent categories</option>
                                    {{-- Assuming you have a property to hold your parent categories --}}
                                    @foreach ($mainCategories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('mainCategoryId')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                        <div class="flex justify-left">
                            <button x-on:click="switchAddSubCategoryModal()"
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
