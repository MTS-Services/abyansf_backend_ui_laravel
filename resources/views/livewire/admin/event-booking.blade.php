<section class="mx-auto max-w-[1200px] bg-white min-h-[80vh]">
    <h2 class="font-medium text-3xl text-black mb-4">Event Booking Management</h2>
    <div class="overflow-y-visible relative">
        <table class="leading-normal table-auto w-full">
            <thead class="bg-[#e7e7e7] text-black font-medium sticky top-0">
                <tr>
                    <th class="p-4 text-left font-medium text-base">SL</th>
                    <th class="p-4 text-left font-medium text-base">Event Title</th>
                    <th class="p-4 text-left font-medium text-base">User Name</th>
                    <th class="p-4 text-left font-normal text-base">Status</th>
                    <th class="p-4 text-left font-medium text-base">Join Date</th>
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
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Title">
                            <span class="font-medium md:hidden text-gray-500">Title: </span>
                            {{ $event['event']['title'] }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Time">
                            <span class="font-medium md:hidden text-gray-500">User: </span>
                            {{ $event['user']['name'] }}
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Status">
                            <span class="font-medium md:hidden text-gray-500">Status: </span>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if ($event['status'] == 'Confirmed') bg-green-100 text-green-800
                                    @elseif($event['status'] == 'Pending') 
                                        bg-yellow-100 text-yellow-800
                                    @elseif($event['status'] == 'Rejected') 
                                        bg-red-100 text-red-800
                                    @else 
                                        bg-gray-100 text-gray-800 @endif">
                                {{ $event['status'] ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="p-4 text-left font-normal text-base border-b md:border-b-0" data-label="Join Date">
                            <span class="font-medium md:hidden text-gray-500">Join Date: </span>
                            {{ \Carbon\Carbon::parse($event['createdAt'])->format('d/m/Y') }}
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
                                    {{-- <button wire:click="editEvent('{{ $event['id'] }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                        Edit
                                    </button> --}}
                                    <!-- Confirm -->
                                    <button wire:click="activateEvent('{{ encrypt($event['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="check-circle" class="text-green-600 mr-2 h-4 w-4" />
                                        Confirm
                                    </button>

                                    <!-- Pending -->
                                    <button wire:click="deactivateEvent('{{ encrypt($event['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="clock" class="text-yellow-500 mr-2 h-4 w-4" />
                                        Pending
                                    </button>

                                    <!-- Reject -->
                                    <button wire:click="rejectEvent('{{ encrypt($event['id']) }}')"
                                        class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                        <flux:icon name="x-circle" class="text-red-600 mr-2 h-4 w-4" />
                                        Reject
                                    </button>

                                    <button wire:click="deleteEvent('{{ encrypt($event['id']) }}')"
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
