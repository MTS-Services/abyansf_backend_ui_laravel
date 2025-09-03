<section class="mx-auto max-w-[1200px] p-4 font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">Sub Category</h2>
     <nav class=" sm:mt-8 ">


        <!-- Navigation links container -->
       @include('livewire.admin.category-management.navbar')
    </nav>
    <x-admin.searchbar page="Add Event" livewire_method="switchAddSubCategoryModal" />

    <div x-show="addSubCategoryModal" x-transition.opacity>
    <div class="fixed  max-auto inset-0 z-50 overflow-y-auto bg-black/70 bg-opacity-50">
        <div class="flex min-h-full  items-center justify-center p-4">
            <div @click.away="addSubCategoryModal = false" class="relative w-full max-w-[1200px] mx-auto  rounded-lg shadow-lg bg-white p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-xl font-semibold text-gray-900">Add New Category</h3>
                    <button @click="addSubCategoryModal = false" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="p-6 bg-white rounded-lg max-w-5xl mx-auto my-10 font-playfair">
                    <div class="mb-6">
                        <label for="category-title" class="block text-sm font-medium text-gray-700 mb-2">Category Title</label>
                        <input type="text" id="category-title" placeholder="Enter your title here"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>

                    <div class="mb-6">
                        <label for="category-description" class="block text-sm font-medium text-gray-700 mb-2">Category Description</label>
                        <textarea id="category-description" rows="4" placeholder="Enter your description here"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                    </div>

                    <div class="mb-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hero Image</label>
                            <div class="flex items-center justify-center h-48 border-4 border-dashed border-[#C7AE6A] rounded-md p-6 text-center transition-colors">
                                <div>
                                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">Choose a file or drag & drop it here</p>
                                    <button type="button" class="mt-2 px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-100">
                                        Browse File
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category Image</label>
                            <div class="flex items-center justify-center h-48 border-4 border-dashed border-[#C7AE6A] rounded-md p-6 text-center transition-colors">
                                <div>
                                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">Choose a file or drag & drop it here</p>
                                    <button type="button" class="mt-2 px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-100">
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
                        <label for="parent-categories" class="block text-sm font-medium text-gray-700 mb-2">Parent Categories</label>
                        <select id="parent-categories"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] ">
                            <option>Select your parent categories</option>
                            <option>Category 1</option>
                            <option>Category 2</option>
                        </select>
                    </div>

                    <div class="flex justify-center">
                        <button x-on:click="switchAddSubCategoryModal()"
                            class="px-6 py-2 bg-[#C7AE6A] text-white font-medium rounded-md shadow-sm hover:bg-opacity-90 transition-colors">
                            Save Category
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Add Event Modal -->
    <!-- Add Event Modal -->
    {{-- <div x-data x-init="$watch('$wire.addEventModal', value => document.body.classList.toggle('overflow-hidden', value))"
        class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 {{ $addEventModal ? '' : 'hidden' }}">

        <div class="bg-white w-full max-w-[1200px] mx-auto rounded-lg p-6 relative max-h-[90vh] overflow-y-auto">

            <button wire:click="switchAddEventModal"
                class="absolute top-4 right-4 text-gray-600 cursor-pointer hover:text-gray-900 text-2xl font-bold">&times;
            </button>

            <div class="flex items-center justify-between border-gray-200 pb-4">
                <h1 class="text-4xl font-semibold text-gray-900">Add Event</h1>
            </div>

            <form wire:submit.prevent="saveEvent" class="p-6 space-y-6">
                <div x-data="fileUpload()" class="space-y-4">
                    <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                        @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                        @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
                        :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                        <input type="file" x-ref="fileInput" class="hidden" wire:model="image"
                            @change="handleFiles($event)">

                        <div class="text-center px-2">
                            <div class="mb-4 flex items-center justify-center">
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

                    <div x-show="image.length" class="overflow-x-auto mt-3">
                        <div class="flex gap-2 min-w-max">
                            <template x-for="(img, index) in image" :key="index">
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" placeholder="Title text" wire:model="title"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Max person</label>
                        <input type="number" placeholder="Max person" wire:model="max_person"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea rows="6" placeholder="Enter description" wire:model="description"
                        class="w-full px-3 py-2 h-[264px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A] resize-none"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" placeholder="Location" wire:model="location"
                            class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                    </div>
                    <div class="col-span-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                            <input type="time" wire:model="time"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" wire:model="date"
                                class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-[#C7AE6A]">
                        </div>
                    </div>
                </div>

                <div class="flex justify-center md:justify-start mt-6">

                    <button type="submit"
                        class="px-6 py-2 bg-[#C7AE6A] text-black rounded-md cursor-pointer hover:bg-opacity-90 transition-colors font-medium">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div> --}}

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
            <tr class="md:table-row grid grid-cols-1 md:grid-cols-none items-center transition">
                <!-- SL -->
                <td class="p-4 text-left font-normal text-base">
                    <p class="text-black whitespace-nowrap">1</p>
                </td>

                <!-- Category Image -->
                <td class="p-4">
                    <div class="w-20 h-20 overflow-hidden rounded shadow-sm">
                        <img src="/assets/images/rrr.jpg" alt="Category" class="object-cover w-full h-full">
                    </div>
                </td>

                <!-- Category Name -->
                <td class="p-4 text-left font-normal text-base">
                    <p class="text-black font-medium">Wedding Events</p>
                </td>

                <!-- Parent Category -->
                <td class="p-4 text-left font-normal text-base">
                    <p class="text-gray-600">Events</p>
                </td>

                <!-- Action -->
                <td class="p-4 text-right">
                    <div class="relative inline-block text-left" x-data="{ open: false }" x-on:click.outside="open = false">
                        <button x-on:click="open = !open"
                            class="text-[#AD8945] rounded-full focus:outline-none" title="Settings">
                            <flux:icon name="cog-6-tooth" class="text-[#C7AE6A]" />
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" x-transition
                            class="absolute right-3 mt-2 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">

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


</section>
