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
                <flux:icon name="x-circle" class="h-6 w-6" />
            </button>

            <!-- Header -->
            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Category</h1>
            </div>

            <!-- Form Content -->
            <form wire:submit.prevent="saveCategory" class="mt-6">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-900 mb-2 font-playfair">
                        Category Title
                    </label>
                    <input type="text" wire:model="title" placeholder="Enter your title here"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors">
                </div>

                <!-- Save Button -->
                <button type="submit"
                    class="w-full md:w-auto px-8 py-3 bg-[#C7AE6A] text-white font-medium cursor-pointer rounded-lg transition-colors outline-none">
                    Save Categoryds sd
                </button>
            </form>

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
        <div x-data="{ open: @entangle('editCategoryModal') }" x-show="open"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 bg-opacity-50" x-cloak>
            <div class="relative max-w-[1200px] mx-auto w-full bg-white rounded-lg shadow-lg border border-gray-200 p-6 md:p-8 
                                     max-h-[90vh] overflow-y-auto"
                @click.away="open = false">
                <button wire:click="switchEditCategoryModel"
                    class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <div class="flex items-center justify-between border-gray-200 pb-4">
                    <h1 class="text-4xl font-semibold text-gray-900">Edit Category</h1>
                </div>

                    <div class="mb-6">
                        <label wire:model.defer="name"
                            class="block text-sm font-medium text-gray-900 mb-2 font-playfair">Category Name</label>
                        <input type="text" wire:model.defer="name" placeholder="Enter your title here"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors ">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
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
