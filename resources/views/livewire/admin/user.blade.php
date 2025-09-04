<section>
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
                        <td class="p-4 text-left whitespace-nowrap font-normal">
                            {{ ($pagination['page'] - 1) * $pagination['limit'] + $index + 1 }}</td>
                        <td class="p-4 text-left font-normal text-base">{{ $user['name'] }}</td>
                        <td class="p-4 text-left font-normal text-base">{{ $user['email'] }}</td>
                        <td class="p-4 text-left font-normal text-base">{{ $user['whatsapp'] }}</td>
                        <td class="p-4 text-left font-normal text-base">
                            {{ \Carbon\Carbon::parse($user['createdAt'])->format('d/m/Y') }}</td>
                        <td class="p-4 text-left font-normal text-base">
                            {{ $user['password'] == null ? 'N/A' : '********' }}</td>
                        <td class="p-4 text-left font-normal text-base">
                            {{ $user['isActive'] ? 'Active' : 'Inactive' }}</td>
                        <td class="p-4 text-left font-normal text-base">
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

                                    <button wire:click="editUser('{{ $user['id'] }}')"
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
    <section class="flex flex-col min-h-screen bg-gray-100 p-4">

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
                    class="relative bg-white rounded-lg shadow-lg max-w-6xl px-20 w-full p-6" wire:click.stop>
                    <button wire:click="closeModal"
                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 rounded-full focus:outline-none">
                        <flux:icon name="x-circle" class="h-6 w-6" />
                    </button>

                    <form wire:submit.prevent="processConfirmation" class="mt-4">
                        <div class="mb-5">
                            <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Name</label>
                            <input type="text" wire:model="selectedUser.name" id="name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300">
                        </div>

                        <div class="mb-5">
                            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                            <input type="email" wire:model="selectedUser.email" id="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300">
                        </div>

                        <div class="mb-5">
                            <label for="number" class="block text-gray-700 text-sm font-medium mb-2">Number</label>
                            <input type="tel" wire:model="selectedUser.number" id="number"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300">
                        </div>

                        <div class="mb-5">
                            <label for="password"
                                class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                            <input type="password" wire:model="selectedUser.password" id="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300">
                        </div>

                        <div class="mb-5">
                            <label for="status" class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                            <select wire:model="selectedUser.status" id="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-medium mb-2">User Image</label>
                            <label
                                class="flex justify-center items-center w-24 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                <input type="file" name="user_image" class="hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </label>
                        </div>

                        <div class="pt-4 mt-6 border-t border-gray-200">
                            <button type="submit"
                                class="w-full bg-[#bfa15c] hover:bg-[#a3894f] text-white font-medium py-3 rounded-lg transition">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
