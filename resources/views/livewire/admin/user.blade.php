<section class="font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">User Management</h2>
    <div class="overflow-x-auto">
        <table class="leading-normal table">
            <thead>
                <tr class="bg-[#e7e7e7] text-black font-medium">
                    <th class="p-4 text-left font-medium text-base"> SL </th>
                    <th class="p-4 text-left font-medium text-base">Name</th>
                    <th class="p-4 text-left font-medium text-base">Email</th>
                    <th class="p-4 text-left font-medium text-base">Number</th>
                    <th class="p-4 text-left font-medium text-base">Join Date</th>
                    <th class="p-4 text-left font-medium text-base">Password</th>
                    <th class="p-4 text-left font-normal text-base">Status</th>
                    <th class="p-4 text-left font-normal text-base">Payment Link</th>
                    <th class="p-4 text- font-medium text-base">Action</th>
                </tr>
            </thead>
            <tbody class="text-balck text-sm">
                @forelse ($users as $index => $user)
                    {{-- @if ($user['isVerified'] == 'ADMIN')
                        @continue
                    @endif
                    @if ($user['isVerified'] == false)
                        @continue
                    @endif --}}

                    <tr wire:key="user-{{ $user['id'] }}">
                        <td class="p-4 text-left whitespace-nowrap font-playfair">
                            {{ ($pagination['page'] - 1) * $pagination['limit'] + $index + 1 }}</td>
                        <td class="p-4 text-left font-playfair text-base">{{ $user['name'] }}</td>
                        <td class="p-4 text-left font-playfair text-base">{{ $user['email'] }}</td>
                        <td class="p-4 text-left font-playfair text-base">{{ $user['whatsapp'] }}</td>
                        <td class="p-4 text-left font-playfair text-base">
                            {{ \Carbon\Carbon::parse($user['createdAt'])->format('d/m/Y') }}</td>
                        <td class="p-4 text-left font-playfair text-base">
                            {{ $user['password'] == null ? 'N/A' : '********' }}</td>
                        <td class="p-4 text-left font-playfair text-base">
                            {{ $user['isActive'] ? 'Active' : 'Inactive' }}</td>
                        <td class="p-4 text-left font-playfair text-base">
                            @if (!empty($user['is_operational']) && $user['is_operational'])
                                <a href="#" wire:click.prevent="sendPaymentLink({{ $user['id'] }})"
                                    class="text-[#AD8945]">
                                    {{ !empty($user['send_payment_link']) && $user['send_payment_link'] ? 'Send' : 'Send' }}
                                </a>
                            @else
                                <span class="text-gray-400 cursor-not-allowed">Not Available</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-right">
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

                                    <button wire:click="userDetailsModal('{{ encrypt($user['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="eye" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Details
                                    </button>

                                    <button wire:click="userEditModall('{{ encrypt($user['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Edit
                                    </button>
                                    @if ($user['paid'] === false)
                                        <button wire:click="confirmUserPaid('{{ $user['id'] }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                            <flux:icon name="check-circle" class="text-green-600 mr-2 h-4 w-4" />
                                            Confirm
                                        </button>
                                        <button wire:click="rejectUserPaid('{{ $user['id'] }}')"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                            <flux:icon name="x-circle" class="text-red-600 mr-2 h-4 w-4" />
                                            Reject
                                        </button>
                                    @endif

                                    <button wire:click="deleteUser('{{ $user['id'] }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Delete
                                    </button>

                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4 text-left whitespace-nowrap font-normal" colspan="9">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div x-data="{ show: @entangle('detailsModal') }" x-show="show" x-cloak class="fixed inset-0 overflow-y-auto z-50">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <!-- Overlay -->
            <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 bg-opacity-50" wire:click="closeModal"></div>

            <!-- Modal content -->
            <div x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-xl shadow-lg max-w-5xl px-10 w-full p-6" wire:click.stop>

                <!-- Close button -->
                <button wire:click="closeModal"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 rounded-full focus:outline-none">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <!-- User Profile Section -->
                <section class="flex flex-col items-center text-center pb-6 border-b border-gray-200">
                    <img src="{{ $profileImg }}" alt="Profile Picture"
                        class="w-24 h-24 rounded-full object-cover shadow-lg ring-4 ring-blue-500 ring-offset-2">

                    <h2 class="mt-4 text-2xl font-bold text-gray-800">
                        <input type="text" wire:model="name"
                            class="border-none w-auto text-center font-bold text-xl">
                    </h2>

                    <p class="text-sm font-medium text-blue-600 rounded-full px-3 py-1 mt-1 bg-blue-50">
                        <input type="text" wire:model="role"
                            class="border-none w-auto text-center text-sm font-medium">
                    </p>
                </section>


                <!-- Details Section -->
                <section class="mt-6 space-y-4">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">User Details</h3>

                    <div class="flex items-center text-gray-600">
                        <span class="font-medium text-gray-700">Email:</span>
                        <input type="text" wire:model="email"
                            class="ml-auto border-none w-auto text-gray-900 bg-transparent">
                    </div>
                    <div class="flex items-center text-gray-600">
                        <span class="font-medium text-gray-700">WhatsApp:</span>
                        <input type="text" wire:model="whatsapp"
                            class="ml-auto border-none w-auto text-gray-900 bg-transparent">
                    </div>
                    <div class="flex items-center text-gray-600">
                        <span class="font-medium text-gray-700">Package:</span>
                        <input type="text" wire:model="package"
                            class="ml-auto border-none w-auto text-gray-900 font-semibold bg-transparent">
                    </div>

                    <!-- Active / Verified -->
                    <div class="flex flex-wrap gap-4 pt-2">
                        <!-- Active -->
                        <span class="flex items-center px-3 py-1 rounded-full text-xs font-semibold"
                            @class([
                                'bg-green-100 text-green-800' => $isActive,
                                'bg-red-100 text-red-800' => !$isActive,
                            ])>
                            <span class="w-2 h-2 rounded-full mr-2" @class([
                                'bg-green-500' => $isActive,
                                'bg-red-500' => !$isActive,
                            ])></span>
                            {{ $isActive ? 'Active' : 'Inactive' }}
                        </span>

                        <!-- Verified -->
                        <span class="flex items-center px-3 py-1 rounded-full text-xs font-semibold"
                            @class([
                                'bg-blue-100 text-blue-800' => $isVerified,
                                'bg-gray-100 text-gray-800' => !$isVerified,
                            ])>
                            {{ $isVerified ? 'Verified' : 'Not Verified' }}
                        </span>
                    </div>
                </section>

                <!-- Other Information -->
                <section class="mt-6 pt-6 border-t border-gray-200">
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">User ID:</span>
                            <input type="text" wire:model="uid"
                                class="border-none w-auto bg-transparent text-gray-900">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div x-data="{ show: @entangle('userEditModal') }" x-show="show" x-cloak class="fixed inset-0 overflow-y-auto z-50">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 bg-opacity-50" wire:click="closeModal"></div>

            <div x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-xl shadow-lg max-w-6xl px-20 w-full p-6" wire:click.stop>
                <button wire:click="closeModal"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 rounded-full focus:outline-none">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <form wire:submit.prevent="updateUser" class="mt-4">
                    <div x-data="{ dragOver: false, imagePreview: @entangle('image') }" class="space-y-4">
                        <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                            @drop.prevent="dragOver = false; $wire.upload('image', event.dataTransfer.files[0])"
                            @click="$refs.fileInput.click()" :class="{ 'border-blue-500': dragOver }">
                            <input wire:model="image" type="file" x-ref="fileInput" class="hidden"
                                accept="image/*">

                            <template
                                x-if="imagePreview && (imagePreview.previewUrl || (typeof imagePreview === 'string' && imagePreview.length > 0))">
                                <div class="relative w-full h-full">
                                    <img :src="imagePreview.previewUrl || imagePreview"
                                        class="w-full h-full object-cover rounded-md" alt="Preview">

                                    <button type="button"
                                        @click.stop="$wire.set('image', null); $refs.fileInput.value = '';"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">
                                        &times;
                                    </button>
                                </div>
                            </template>

                            <div x-show="!imagePreview || (typeof imagePreview === 'string' && imagePreview.length === 0)"
                                class="text-center px-2">
                                <div class="mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 16">
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
                    </div>
                    <input type="file" wire:model="image" accept="image/*">
                    <div class="mb-5">
                        <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Name</label>
                        <input type="text" wire:model="name" id="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                        <input type="email" wire:model="email" id="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label for="whatsapp" class="block text-gray-700 text-sm font-medium mb-2">Whatsapp</label>
                        <input type="tel" wire:model="whatsapp" id="whatsapp"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                        <input type="password" wire:model="password" id="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#C7AE6A] focus:border-gray-300">
                    </div>

                    <div class="flex justify-center md:justify-start pt-6">
                        <button type="submit"
                            class="px-8 py-2 bg-[#C7AE6A] text-black rounded-md hover:bg-opacity-90 transition-colors font-medium hover:bg-[#eec44f] cursor-pointer">
                            <span wire:loading.remove wire:target="save">Save</span>
                            <span wire:loading wire:target="save">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-data="{ show: @entangle('showConfirmationModal') }" x-show="show" x-cloak class="fixed inset-0 overflow-y-auto z-50">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 bg-opacity-50" wire:click="closeModal"></div>

            <div x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-lg shadow-lg max-w-lg w-full p-6" wire:click.stop>
                <button wire:click="closeModal"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 rounded-full focus:outline-none">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Payment</h3>
                <p class="text-sm text-gray-500 mb-6">Select the payment type for this user.</p>

                <div class="space-y-4">
                    <label class="flex items-center">
                        <input type="radio" wire:model.live="paymentType" value="Private"
                            class="form-radio text-indigo-600">
                        <span class="ml-2 text-sm"
                            :class="{
                                'text-[#AD8945]': @entangle('paymentType') == 'Private',
                                'text-gray-700': @entangle('paymentType') !=
                                    'Private'
                            }">
                            Private
                        </span>
                    </label>

                    <label class="flex items-center">
                        <input type="radio" wire:model.live="paymentType" value="Corporate"
                            class="form-radio text-indigo-600">
                        <span class="ml-2 text-sm"
                            :class="{
                                'text-[#AD8945]': @entangle('paymentType') == 'Corporate',
                                'text-gray-700': @entangle('paymentType') !=
                                    'Corporate'
                            }">
                            Corporate
                        </span>
                    </label>
                </div>


                <div class="mt-6 flex justify-end">
                    <button wire:click="closeModal" type="button"
                        class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 rounded-md border border-gray-300 hover:bg-gray-100">
                        Cancel
                    </button>
                    <button wire:click="processConfirmation" type="button"
                        class="px-4 py-2 text-sm font-medium text-white rounded-md bg-[#AD8945] hover:bg-[#8d6e35] disabled:opacity-50"
                        {{ $paymentType ? '' : 'disabled' }}>
                        Confirm
                    </button>
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
