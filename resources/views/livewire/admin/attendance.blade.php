<section>
    <h2 class="font-medium text-3xl text-black mb-4">Event Booking Management</h2>
    <div class="overflow-y-visible relative">
        <table class="leading-normal table-auto w-full">
            <thead class="bg-[#e7e7e7] text-black font-medium sticky top-0">
                <tr>
                    <th class="p-4 text-left font-medium text-base">SL</th>
                    <th class="p-4 text-left font-medium text-base">Name</th>
                    <th class="p-4 text-left font-medium text-base">Time</th>
                    <th class="p-4 text-left font-medium text-base">Join Date</th>
                    <th class="p-4 text-left font-medium text-base">Description</th>
                    <th class="p-4 text-left font-medium text-base">Max Person</th>
                    <th class="p-4 text-left font-medium text-base">Location</th>
                    <th class="p-4 text-left font-normal text-base">Status</th>
                    <th class="p-4 text-right font-medium text-base">Action</th>
                </tr>
            </thead>
            <tbody class="text-black text-sm">
                @forelse ($events as $index => $event)
                    <tr wire:key="user-{{ $event['id'] }}"
                        class="bg-white mb-4 rounded-lg shadow-sm border md:border-0 md:bg-transparent">
                        <td class="p-4 text-left font-normal border-b md:border-b-0" data-label="SL">
                            <span class="font-medium md:hidden text-gray-500">SL: </span>
                            {{ ($pagination['page'] - 1) * $pagination['limit'] + $index + 1 }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Name">
                            <span class="font-medium md:hidden text-gray-500">Name: </span>
                            {{ $event['title'] }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Time">
                            <span class="font-medium md:hidden text-gray-500">Time: </span>
                            {{ $event['time'] }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Join Date">
                            <span class="font-medium md:hidden text-gray-500">Join Date: </span>
                            {{ \Carbon\Carbon::parse($event['createdAt'])->format('d/m/Y') }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0 "
                            data-label="Description">
                            <span class="font-medium md:hidden text-gray-500">Description: </span>
                            {{ Str::limit($event['description'] ?? 'N/A', 50, '...') }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Max Person">
                            <span class="font-medium md:hidden text-gray-500">Max Person: </span>
                            {{ $event['max_person'] }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Location">
                            <span class="font-medium md:hidden text-gray-500">Location: </span>
                            {{ $event['location'] }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Status">
                            <span class="font-medium md:hidden text-gray-500">Status: </span>
                            {{ $event['status'] ? 'Active' : 'Inactive' }}
                        </td>
                        <td class="py-3 px-6 text-right" data-label="Action">
                            <span class="font-medium md:hidden text-gray-500">Action: </span>
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
                                    <button wire:click="eventDtls('{{ encrypt($event['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-red-50 cursor-pointer">
                                        <flux:icon name="eye" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Deatils
                                    </button>
                                    <button wire:click="editEvent('{{ $event['id'] }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Edit
                                    </button>
                                    <button wire:click="activateEvent('{{ $event['id'] }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="check" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Active
                                    </button>
                                    <button wire:click="deactivateEvent('{{ encrypt($event['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="x-circle" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Deactivate
                                    </button>
                                    <button wire:click="deleteEvent('{{ $event['id'] }}')"
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
                        <td class="p-4 text-left whitespace-nowrap font-normal" colspan="9">No events found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- event details modal --}}
    <div x-data="{ show: @entangle('eventDetailsModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <!-- Backdrop -->
            <div x-show="show" x-cloak x-effect="document.body.classList.toggle('overflow-hidden', show)"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal">
            </div>

            <!-- Modal Content -->
            <div x-show="show" x-cloak x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-6 scale-95"
                class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full p-8 sm:p-10" wire:click.stop>

                <!-- Close Button -->
                <button wire:click="closeModal"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <flux:icon name="x-circle" class="h-6 w-6" />
                </button>

                <!-- Header -->
                <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                    <img src="{{ $detailImage ?? 'https://via.placeholder.com/150' }}" alt="Event Image"
                        class="w-20 h-20 rounded-lg object-cover shadow">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $detailTitle ?? 'Event Details' }}</h2>
                    </div>
                </div>

                <!-- Event Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Title</label>
                        <p class="text-gray-800 font-semibold">{{ $detailTitle ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Max Person</label>
                        <p class="text-gray-800 font-semibold">{{ $detailMaxPerson ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Location</label>
                        <p class="text-gray-800">{{ $detailLocation ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Date</label>
                        <p class="text-gray-800">{{ $detailDate ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Time</label>
                        <p class="text-gray-800">{{ $detailTime ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Status</label>
                        <span
                            class="inline-block px-3 py-1 text-sm font-semibold rounded-full w-fit
                        {{ $detailStatus == 'Active' ? 'text-green-800 bg-green-200' : 'text-red-800 bg-red-200' }}">
                            {{ $detailStatus ?? 'N/A' }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-5">
                    <div class="flex  bg-gray-100 p-4 gap-4 flex-wrap rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Bookings</label>
                        @forelse ($detailBookings as $booking)
                            <div class="bg-white p-3 rounded mb-2 border border-gray-200">
                                <p class="text-gray-800 font-semibold">{{ $booking['name'] ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">Status: {{ $booking['status'] ?? 'N/A' }}</p>
                                @if (isset($booking['user']))
                                    <p class="text-xs text-gray-500">User: {{ $booking['user']['name'] ?? 'N/A' }}
                                    </p>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500 italic">No bookings available</p>
                        @endforelse
                    </div>
                    <div class="flex flex-col bg-gray-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 font-medium mb-1">Description</label>
                        <p class="text-gray-800">{{ $detailDescription ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end">
                    <button wire:click="closeModal"
                        class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#AD8945] to-amber-600 hover:from-[#9c7a3d] hover:to-amber-700 rounded-lg shadow transition transform hover:scale-[1.02]">
                        Close
                    </button>
                </div>
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
