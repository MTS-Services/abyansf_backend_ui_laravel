<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Spacific Category</h2>
    <nav class=" sm:mt-8 ">


        <!-- Navigation links container -->
        @include('livewire.admin.category-management.navbar')
    </nav>



    <x-admin.searchbar page="Add " livewire_method="switchAddSpacificCategoryModal" />

    <div x-show="addSpacificCategoryModal" x-transition.opacity>
        <div class="fixed  max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
            <div class="flex min-h-full  items-center justify-center p-4">
                <div @click.away="addSpacificCategoryModal = false"
                    class="relative w-full max-w-[1200px] mx-auto  rounded-lg shadow-lg bg-white p-6">
                    <!-- Close Button -->
                    <button wire:click="switchAddSpacificCategoryModal"
                        class="absolute cursor-pointer top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                        &times;
                    </button>
                    <!-- Header -->
                    <div class="flex items-center justify-between border-gray-200 pb-4">
                        <h1 class="text-4xl font-semibold text-gray-900">Add Spacific Category</h1>
                    </div>

                    <div class="bg-white p-10 rounded-lg shadow-md w-[550px]">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Sub-Categories</h2>
                            <div class="relative">
                                <select
                                    class="block w-full px-4 py-3 pr-8 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500 transition-colors cursor-pointer appearance-none">
                                    <option class="text-gray-400" disabled selected>Select your sub categories</option>
                                    <option value="cat1">Category 1</option>
                                    <option value="cat2">Category 2</option>
                                    <option value="cat3">Category 3</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Category Title</h2>
                            <div class="flex items-center space-x-2 mb-4">
                                <input type="text" placeholder="Enter your title here"
                                    class="w-full px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                <button
                                    class="bg-amber-700 text-white font-medium py-3 px-6 rounded-md hover:bg-amber-800 transition-colors">Remove</button>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="text" placeholder="Enter your title here"
                                    class="w-full px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                <button
                                    class="bg-amber-700 text-white font-medium py-3 px-8 rounded-md hover:bg-amber-800 transition-colors">Add</button>
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
    <!-- Add Event Modal -->

    <div class="bg-white rounded-lg overflow-x-auto md:overflow-x-visible mt-14 mb-5">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-[#E7E7E7] hidden md:table-row">
                    <th class="p-4 text-left font-medium text-base w-[5%]">SL</th>

                    <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Category Name
                    </th>
                    <th class="p-4 text-left font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Sub Category
                    </th>

                    <th class="p-4 text-right font-semibold text-black font-playfair text-base md:text-lg w-[25%]">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($specificCategories as $specificCategory)
           
                    <tr class="md:table-row grid grid-cols-1 md:grid-cols-none items-center transition relative">
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-black whitespace-nowrap">{{ $loop->iteration }}</p>
                        </td>

                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-black font-medium">{{ $specificCategory['name'] }}</p>
                        </td>
                        <td class="p-4 text-left font-normal text-base">
                            <p class="text-gray-600">{{ $specificCategory['subCategory']['name'] }}</p>
                        </td>

                        <td class="p-4 text-right md:static absolute top-2 right-2">
                            <div class="relative inline-block text-left" x-data="{ open: false }"
                                x-on:click.outside="open = false">
                                <button x-on:click="open = !open" class="text-[#AD8945] rounded-full focus:outline-none"
                                    title="Settings">
                                    <flux:icon name="cog-6-tooth" class="text-[#C7AE6A] h-6 w-6" />
                                </button>
                                <div x-show="open" x-transition
                                    class="absolute right-0 mt-2 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                                    <button wire:click="switchEditSpacificCategoryModal"
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
                                    <button wire:click="deleteSpacificCategory('{{encrypt($specificCategory['id'])}}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" /> Delete
                                    </button>
                                </div>
                  
                </td>
                </tr>
                   @endforeach
            </tbody>

        </table>

        <div x-show="editSpacificCategoryModal" x-transition.opacity>
            <div class="fixed  max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
                <div class="flex min-h-full  items-center justify-center p-4">
                    <div @click.away="editSpacificCategoryModal = false"
                        class="relative w-full max-w-[1200px] mx-auto  rounded-lg shadow-lg bg-white p-6">
                        <!-- Close Button -->
                        <button wire:click="switchEditSpacificCategoryModal"
                            class="absolute cursor-pointer top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                            &times;
                        </button>
                        <!-- Header -->
                        <div class="flex items-center justify-between border-gray-200 pb-4">
                            <h1 class="text-4xl font-semibold text-gray-900">Add Spacific Category
                            </h1>
                        </div>

                        <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">





                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sub-Categories</label>
                                <select
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gold-500">
                                    <option>Select your sub categories</option>
                                </select>
                            </div>

                            <!-- Category Title Inputs -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category
                                    Title</label>

                                <!-- First Input + Remove Button -->
                                <div class="flex items-center mb-2">
                                    <input type="text" placeholder="Enter your title here"
                                        class="flex-grow border border-gray-300 rounded-md px-3 py-2 mr-2 focus:outline-none focus:ring-2 focus:ring-gold-500" />
                                    <button
                                        class="bg-[#C7AE6A] text-white px-4 py-2 rounded-md hover:bg-gold-600">Remove</button>
                                </div>

                                <!-- Second Input + Add Button -->
                                <div class="flex items-center">
                                    <input type="text" placeholder="Enter your title here"
                                        class="flex-grow border border-gray-300 rounded-md px-3 py-2 mr-2 focus:outline-none focus:ring-2 focus:ring-gold-500" />
                                    <button
                                        class="bg-[#C7AE6A] text-white px-4 py-2 rounded-md hover:bg-gold-600">Add</button>
                                </div>
                            </div>




                            <div class="flex justify-left">
                                <button x-on:click="switchAddSpacificCategoryModal()"
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

    <!-- Edit Category Modal -->
    {{-- <div x-show="editSubCategoryModal" x-transition.opacity>
        <div class="fixed  max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
            <div class="flex min-h-full  items-center justify-center p-4">
                <div @click.away="editMiniCategoryModal = false"
                    class="relative w-full max-w-[1200px] mx-auto  rounded-lg shadow-lg bg-white p-6">
                    <!-- Close Button -->
                    <button wire:click="switchEditMiniCategoryModal"
                        class="absolute cursor-pointer top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                        &times;
                    </button>
                    <!-- Header -->
                    <div class="flex items-center justify-between border-gray-200 pb-4">
                        <h1 class="text-4xl font-semibold text-gray-900">Edit Category</h1>
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
                                class="block text-sm font-medium text-gray-700 mb-2">Category
                                Description</label>
                            <textarea id="category-description" rows="4" placeholder="Enter your description here"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
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
    </div> --}}



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
