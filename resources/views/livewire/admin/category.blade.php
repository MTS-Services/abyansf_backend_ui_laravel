<section class="mx-auto max-w-[1200px] min-h-[80vh] bg-white  font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Category Management</h2>

    <nav class=" sm:mt-8 ">


        <!-- Navigation links container -->
        @include('livewire.admin.category-management.navbar')
    </nav>

    <x-admin.searchbar />

    <!--Add Category Modal-->
    <div x-data="{ open: @entangle('addCategoryModal') }" x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 bg-opacity-50" x-cloak>
        <!-- Modal Box -->
        <div class="relative max-w-[1200px] mx-auto w-full bg-white rounded-lg shadow-lg border border-gray-200 p-6 md:p-8 
               max-h-[90vh] overflow-y-auto"
            @click.away="open = false">
            <!-- Close Button -->
            <button wire:click="closeAddModal"
                class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold">
                &times;
            </button>

            <!-- Header -->
            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Category</h1>
            </div>

            <form action="" wire:submit.prevent="saveCategory">
                <!-- Form Content -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-900 mb-2 font-playfair">Category Title</label>
                    <input type="text" wire:model="category_title" x-model="categoryTitle" placeholder="Enter your title here"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors ">
                        @error('category_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>



                <!-- Save Button -->
                <button wire:click="saveCategory"
                    class="w-full md:w-auto px-8 py-3 bg-[#C7AE6A]  text-white font-medium  cursor-pointer rounded-lg transition-colors  outline-none">
                    Save Category
                </button>
            </form>
        </div>
    </div>

    </div>

    <div class="bg-white rounded-lg overflow-y-visible mt-14 mb-5">

        {{-- Start the data table --}}
        <x-admin.data-table :items="$items" :columns="$columns" :actions="$actions" />
        {{-- End The Data Table --}}



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

               <form action="" wire:submit.prevent="updateCategory">
                 <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-900 mb-2 font-playfair">Category
                        Title</label>
                    <input type="text" wire:model.defer="category_title" placeholder="Enter your title here"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C7AE6A] focus:border-[#C7AE6A] outline-none transition-colors ">
                </div>

                <button wire:click="updateCategory"
                    class="w-full md:w-auto px-8 py-3 bg-[#C7AE6A] text-white font-medium cursor-pointer rounded-lg transition-colors outline-none">
                    Update Category
                </button>
               </form>
            </div>
        </div>
    </div>
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
