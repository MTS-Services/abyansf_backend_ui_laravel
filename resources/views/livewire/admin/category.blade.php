<section class="mx-auto max-w-[1200px]  font-playfair">
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
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-900 mb-2 font-playfair">Category Title</label>
                <input type="text" x-model="categoryTitle" placeholder="Enter your title here"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors ">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-900 mb-2">Category Description</label>
                <textarea x-model="categoryDescription" placeholder="Enter your description here" rows="4"
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
                                <img :src="img" class="w-full h-32 object-cover rounded-md border"
                                    alt="Preview">
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
                            <label
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer transition-all duration-300"
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
            <button @click="saveCategory()"
                class="w-full md:w-auto px-8 py-3 bg-[#C7AE6A] hover:bg-amber-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 outline-none">
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
                    <tr wire:key="booking-{{ $category['id'] }}" x-data="{ dropdownOpen: false }" class="border-b border-gray-200">
                         <td class="p-4 text-left font-normal text-base">
                            <p class="text-black whitespace-nowrap">{{ $category['id'] }}</p>
                        </td>
                        <td class="p-4 text-left font-normal text-base">
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

                                    <button
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

                                    <button 
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
