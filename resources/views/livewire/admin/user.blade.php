<section class="font-playfair">
    <h2 class="font-medium text-3xl text-black mb-4">User Management</h2>
    <div>
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
                            @if (isset($user['send_payment_link']) && $user['send_payment_link'] == false)
                                <button type="button" wire:click="sendPaymentLink('{{ $user['id'] }}')"
                                    onclick="event.stopPropagation();"
                                    class="text-[#AD8945] cursor-pointer hover:underline z-50">
                                    Send Link
                                </button>
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
    <div x-data="{ show: @entangle('detailsModal') }" x-show="show" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto px-4 py-6">

        <!-- Overlay -->
        <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gradient-to-br from-gray-900/70 to-gray-800/80 backdrop-blur-sm"
            wire:click="closeModal"></div>

        <!-- Modal content -->
        <div x-show="show" x-cloak x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-8"
            class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full p-6 ring-1 ring-gray-100/10"
            wire:click.stop>

            <!-- Close Button -->
            <button wire:click="closeModal"
                class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 transition-colors p-1 rounded-full hover:bg-gray-100">
                <flux:icon name="x-mark" class="h-6 w-6" />
            </button>

            <!-- User Profile Section -->
            <section class="flex flex-col items-center text-center border-b border-gray-100 pb-6">
                <div class="relative">
                    <img src="{{ $profileImg }}" alt="Profile Picture"
                        class="w-28 h-28 rounded-full object-cover shadow-lg ring-2 ring-white ring-offset-2">
                    <div
                        class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-gradient-to-r from-[#AD8945] to-amber-400 border-2 border-white flex items-center justify-center">
                        <flux:icon name="check" class="h-3.5 w-3.5 text-white" />
                    </div>
                </div>

                <h2 class="mt-5 text-2xl font-semibold text-gray-800">
                    {{ $name }}
                </h2>

                <p
                    class="mt-2 text-sm font-medium text-[#AD8945] bg-amber-50 rounded-full px-4 py-1.5 border border-amber-100">
                    {{ $role }}
                </p>
            </section>

            <!-- Details Section -->
            <section class="mt-6 space-y-5">
                <h3 class="text-lg font-medium text-gray-700 mb-1 flex items-center">
                    <flux:icon name="user" class="h-5 w-5 mr-2 text-[#AD8945]" />
                    User Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col bg-gray-100 p-3 rounded-lg">
                        <label class="text-xs font-medium text-gray-500 mb-1">Email Address</label>
                        <p class="text-gray-800 font-medium">{{ $email }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-3 rounded-lg">
                        <label class="text-xs font-medium text-gray-500 mb-1">WhatsApp Number</label>
                        <p class="text-gray-800 font-medium">{{ $whatsapp }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-3 rounded-lg">
                        <label class="text-xs font-medium text-gray-500 mb-1">Package</label>
                        <p class="text-gray-800 font-medium">{{ $package }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-3 rounded-lg">
                        <label class="text-xs font-medium text-gray-500 mb-1">User ID</label>
                        <p class="text-gray-800 font-medium">{{ $uid }}</p>
                    </div>
                </div>

                <!-- Status Indicators -->
                <div class="flex flex-wrap gap-3 pt-2">

                    <!-- Active -->
                    <div
                        class="flex items-center px-3 py-1.5 rounded-full text-xs font-medium {{ $isActive ? 'bg-green-50 text-green-700 ring-1 ring-green-600/20' : 'bg-red-50 text-red-700 ring-1 ring-red-600/20' }}">
                        <span
                            class="w-2 h-2 rounded-full mr-2 flex-shrink-0 {{ $isActive ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        {{ $isActive ? 'Active' : 'Inactive' }}
                    </div>

                    <!-- Verified -->
                    <div
                        class="flex items-center px-3 py-1.5 rounded-full text-xs font-medium {{ $isVerified ? 'bg-[#AD8945]/10 text-[#AD8945] ring-1 ring-[#AD8945]/20' : 'bg-gray-100 text-gray-600 ring-1 ring-gray-300' }}">
                        <flux:icon name="check" class="h-3.5 w-3.5 mr-1" />
                        {{ $isVerified ? 'Verified' : 'Not Verified' }}
                    </div>

                </div>

            </section>

            <!-- Action Buttons -->
            <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end">
                <button wire:click="closeModal"
                    class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#AD8945] to-amber-600 hover:from-[#9c7a3d] hover:to-amber-700 rounded-lg shadow-sm transition-all transform hover:scale-[1.02]">
                    <flux:icon name="x-circle" class="h-4 w-4 mr-1 inline" />
                    Close
                </button>
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
                    <div x-data="{ dragOver: false }" class="space-y-4">
                        <div class="h-56 sm:h-72 md:h-[457px] rounded-lg flex flex-col items-center justify-center transition-colors cursor-pointer relative border-4 border-dashed border-[#C7AE6A] p-4"
                            @dragover.prevent="dragOver = true" 
                            @dragleave.prevent="dragOver = false"
                            @drop.prevent="dragOver = false; $wire.upload('image', event.dataTransfer.files[0])"
                            @click="$refs.fileInput.click()"
                            :class="{ 'border-blue-500': dragOver, 'border-[#C7AE6A]': !dragOver }">

                            <input wire:model="image" type="file" x-ref="fileInput" class="hidden" accept="image/*">

                            @if ($image)
                                <div class="relative w-full h-full">
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="w-full h-full object-cover rounded-md" alt="Preview">

                                    <button type="button"
                                        @click.stop="$wire.set('image', null); $refs.fileInput.value = '';"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">
                                        &times;
                                    </button>
                                </div>
                            @elseif ($existing_image)
                                <div class="relative w-full h-full">
                                    <img src="{{ $existing_image }}" class="w-full h-full object-cover rounded-md"
                                        alt="Current Image">

                                    <button type="button"
                                        @click.stop="$wire.set('existing_image', null); $refs.fileInput.click();"
                                        class="absolute top-2 right-2 bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold opacity-75 hover:opacity-100 transition-opacity">
                                        Change
                                    </button>
                                </div>
                            @else
                                <div class="text-center px-2">
                                    <div class="mb-4 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                    </div>
                                    <p class="text-lg font-bold text-gray-800">Choose a file or drag & drop it here</p>
                                    <button type="button"
                                        class="mt-4 px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Browse File
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
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
