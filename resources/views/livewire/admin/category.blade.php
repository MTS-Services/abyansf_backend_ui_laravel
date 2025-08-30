<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <x-admin.searchbar page="Add" livewire_method="switchAddCategoryModal"/>

    <!--Add Category Modal-->
<div 
    x-data="{ open: @entangle('addCategoryModal') }" 
    x-show="open" 
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 bg-opacity-50"
    x-cloak
>
    <!-- Modal Box -->
    <div 
        class="relative max-w-[1200px] mx-auto w-full bg-white rounded-lg shadow-lg border border-gray-200 p-6 md:p-8 
               max-h-[90vh] overflow-y-auto" 
        @click.away="open = false"
    >
        <!-- Close Button -->
        <button 
            wire:click="switchAddCategoryModal"
            class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold"
        >
            &times;
        </button>

        <!-- Header -->
        <div class="flex items-center justify-between border-gray-200 pb-4">
            <h1 class="text-4xl font-semibold text-gray-900">Add Category</h1>
        </div>

        <!-- Form Content -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-900 mb-2 font-playfair">Category Title</label>
            <input type="text"
                x-model="categoryTitle"
                placeholder="Enter your title here"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors ">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-900 mb-2">Category Description</label>
            <textarea 
                x-model="categoryDescription"
                placeholder="Enter your description here"
                rows="4"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors resize-none">
            </textarea>
        </div>

        <!-- Image Upload -->
       <div x-data="fileUpload()" class="space-y-4">
    <!-- Upload Box -->
    <div class="h-[136px] sm:h-60 md:h-80 rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
        @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
        @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
        :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

        <!-- Hidden File Input -->
        <input type="file" x-ref="fileInput" multiple class="hidden" @change="handleFiles($event)">

        <!-- Placeholder Text -->
        <div class="text-center px-2">
            <div class="mb-4 flex items-center justify-center">
                <!-- Upload Icon -->
                <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                </svg>
            </div>
            <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop it here</p>
            <button type="button"
                class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Browse File
            </button>
        </div>
    </div>

    <!-- Image Preview Section -->
    <div x-show="images.length" class="overflow-x-auto mt-3">
        <div class="flex gap-2 min-w-max">
            <template x-for="(img, index) in images" :key="index">
                <div class="relative w-32 flex-shrink-0">
                    <img :src="img" class="w-full h-32 object-cover rounded-md border" alt="Preview">
                    <button type="button" @click="removeImage(index)"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">×</button>
                </div>
            </template>
        </div>
    </div>
</div>

<input type="file" id="photoUpload" class="hidden" accept="image/*" multiple>

        <!-- Subcategory Toggle -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-900">Create Sub-Category</label>
                <div class="flex items-center">
                    <span class="text-sm text-gray-500 mr-3" x-text="isSubCategory ? 'Active' : 'Inactive'"></span>
                    <div class="relative">
                        <input type="checkbox" x-model="isSubCategory"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-all duration-300">
                        <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer transition-all duration-300"
                            style="width: 44px;"></label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parent Category Dropdown -->
        <div class="mb-8" x-show="isSubCategory" x-transition>
            <label class="block text-sm font-medium text-gray-900 mb-2">Parent Categories</label>
            <select x-model="parentCategory"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition-colors ">
                <option value="">Select your parent categories</option>
                <option value="electronics">Electronics</option>
                <option value="clothing">Clothing</option>
                <option value="books">Books</option>
                <option value="home">Home & Garden</option>
            </select>
        </div>

        <!-- Save Button -->
        <button 
            @click="saveCategory()" 
            class="w-full md:w-auto px-8 py-3 bg-[#C7AE6A] hover:bg-amber-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 outline-none">
            Save Category
        </button>
    </div>
</div>

</div>

    <div class="bg-white  rounded-lg overflow-hidden mt-14 mb-5">
        <div class="hidden md:grid grid-cols-7 bg-[#E7E7E7] py-3 px-2">
            
            <div class="col-span-2 text-lg md:text-xl font-semibold text-black font-inter">
                Category Name
            </div>
            <div class="col-span-2 text-lg md:text-xl font-semibold text-black font-inter pl-1">
                Subcategory
            </div>
            <div class="col-span-1 text-lg md:text-xl font-semibold text-black font-inter pl-1">
                Status
            </div>
            <div class="col-span-2 text-right pr-6 md:pr-10 text-lg md:text-xl font-semibold text-black font-inter">
                Action
            </div>
        </div>


        <div class="divide-y divide-gray-200">
            @php
                $services = [
                    [
                        'name' => 'EUR/USD',
                        'image' => asset('image/listing (2).jpg'),
                        'status' => 'active',
                        'subcategory' => 'Desert Safaris',
                    ],
                    [
                        'name' => 'Single Buggy Ride',
                        'image' => asset('image/listing (3).jpg'),
                        'status' => 'active',
                        'subcategory' => 'Adventure Activities',
                    ],
                    [
                        'name' => 'Aura Sky Pool',
                        'image' => asset('image/listing (4).jpg'),
                        'status' => 'active',
                        'subcategory' => 'Wellness & Spa',
                    ],
                    [
                        'name' => 'Eva beach',
                        'image' => asset('image/listing (5).jpg'),
                        'status' => 'active',
                        'subcategory' => 'Water Sports',
                    ],
                    [
                        'name' => 'Super car',
                        'image' => asset('image/listing (6).jpg'),
                        'status' => 'active',
                        'subcategory' => 'Luxury Rentals',
                    ],
                    [
                        'name' => 'Helicopter tour',
                        'image' => asset('image/listing (7).jpg'),
                        'status' => 'active',
                        'subcategory' => 'Aerial Tours',
                    ],
                    [
                        'name' => 'Luxury Real Estate Consultant',
                        'image' => asset('image/listing (1).jpg'),
                        'status' => 'active',
                        'subcategory' => 'Consulting Services',
                    ],
                ];
            @endphp
            @foreach ($services as $service)
                <div class="grid grid-cols-1 md:grid-cols-7 items-center py-4 px-2 gap-4 transition">
                    <div class="flex items-start md:items-center col-span-2 space-x-3 md:space-x-4">
                        <div class="w-20 h-20 md:w-26 md:h-26 overflow-hidden rounded shadow-sm flex-shrink-0 ">
                            <img src="{{ $service['image'] }}" alt="{{ $service['name'] }}"
                                class="object-cover w-full h-full">
                        </div>

                        <div>
                            <div class=" text-gray-800 text-base md:text-xl font-inter">
                                {{ $service['name'] }}</div>
                        </div>
                    </div>

                    <div class="col-span-2 text-sm md:text-base text-gray-900 font-inter pl-1">
                        {{ $service['subcategory'] }}
                    </div>

                    <div class="col-span-1 relative w-full md:w-32 text-center mt-3 md:mt-0">
                        <div class="w-full md:w-24 h-[40px] bg-[#FEFDE8] rounded-full items-center pt-1 relative">
                            <option value="active" {{ $service['status'] === 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                        </div>
                    </div>
                    <div class="flex items-center justify-center col-span-2 space-x-2 mt-3 md:mt-0"
                        x-data="{ open: false }" @click.away="open = false">

                        <div class="relative inline-flex items-center space-x-2 text-left">


                            <!-- Gear Icon -->
                            <button @click="open = !open" type="button" class="text-gray-500 focus:outline-none"
                                aria-expanded="true" aria-haspopup="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#C7AE6A]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09c0-.66-.38-1.26-1-1.51a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06c.44-.44.58-1.1.33-1.82a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09c.66 0 1.26-.38 1.51-1a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06c.44.44 1.1.58 1.82.33.61-.25 1-0.85 1-1.51V3a2 2 0 014 0v.09c0 .66.38 1.26 1 1.51.72.25 1.38.11 1.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06c-.44.44-.58 1.1-.33 1.82.25.61.85 1 1.51 1H21a2 2 0 010 4h-.09c-.66 0-1.26.38-1.51 1z" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <a href="#" class="text-gray-700 flex px-4 py-2 text-sm hover:bg-gray-100"
                                        role="menuitem">
                                        ✏️ Edit
                                    </a>
                                    <a href="#" class="text-gray-700 flex px-4 py-2 text-sm hover:bg-gray-100"
                                        role="menuitem">
                                        ✅ Active
                                    </a>
                                    <a href="#" class="text-gray-700 flex px-4 py-2 text-sm hover:bg-gray-100"
                                        role="menuitem">
                                        ❌ Deactivate
                                    </a>
                                    <form method="POST" action="#" role="none">
                                        <button type="submit"
                                            class="text-gray-700 flex w-full px-4 py-2 text-sm hover:bg-gray-100"
                                            role="menuitem">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="border-t border-gray-200"></div>
    <div class="flex items-center justify-center space-x-2 my-6 flex-wrap">
        <!-- Previous Button (disabled) -->
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed"
            disabled>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button
            class="flex items-center justify-center w-8 h-8 rounded border-2 border-[#AD8945]  text-[#AD8945] font-medium text-sm">1</button>
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">2</button>
        <span class="flex items-center justify-center w-8 h-8 text-gray-500 text-sm">...</span>
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">9</button>
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium text-sm">10</button>

        <!-- Next Button -->
        <button
            class="flex items-center justify-center w-8 h-8 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

 <script>
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
    </script>
</section>
