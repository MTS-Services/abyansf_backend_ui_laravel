<section class="font-poppins">
    <div class="rounded-lg shadow-sm">
        <div
            class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 p-4 sm:p-6 border-b border-gray-100">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-gray-900">Notifications</h1>
            <button
                class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 transition-colors whitespace-nowrap">
                <span>Mark All Read</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </button>
        </div>

        <div class="divide-y divide-gray-100">
            {{-- @dd($allNotifications) --}}
            <div class="divide-y divide-gray-100">
                @forelse($allNotifications as $notification)
                    <div class="p-4 sm:p-6 hover:bg-gray-100 transition-colors">
                        <div class="flex gap-3 sm:gap-4">
                            <div class="flex-1 min-w-0">
                                <h2 class="text-sm font-semibold text-gray-900 mb-1">
                                    {{ $notification['title'] ?? 'Notification' }}
                                </h2>
                                <p class="text-sm text-gray-900">
                                    <span
                                        class="">{{ ucwords($notification['user']['name'] ?? 'Unknown User') }}</span>
                                    <span class="text-[#666C7E] font-normal leading-1 tracking-normal text-sm/6">
                                        {{ $notification['message'] }}
                                    </span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ \Carbon\Carbon::parse($notification['createdAt'])->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        <p>You have no new notifications.</p>
                    </div>
                @endforelse
                <!-- Pagination -->
                @if (!empty($pagination) && ($pagination['pages'] ?? 1) > 1)
                    <div class="flex items-center justify-center space-x-2 py-3 my-3 flex-wrap ">
                        <button wire:click="previousPage" @disabled(!$hasPrevious) @class([
                            'flex items-center justify-center w-8 h-8 rounded border border-slate-300',
                            'bg-slate-100 text-slate-400 cursor-not-allowed' => !$hasPrevious,
                            'bg-white text-slate-700 hover:bg-slate-50' => $hasPrevious,
                        ])>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7">
                                </path>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

        </div>

    </div>
</section>
