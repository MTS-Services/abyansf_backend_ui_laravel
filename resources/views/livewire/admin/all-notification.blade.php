<section class="font-poppins">
    <div class="rounded-lg shadow-sm">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 p-4 sm:p-6 border-b border-gray-100">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-gray-900">Notifications</h1>
            <button class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 transition-colors whitespace-nowrap">
                <span>Mark All Read</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </button>
        </div>

        <div class="divide-y divide-gray-100">
            {{-- @dd($allNotifications) --}}
            @forelse($allNotifications as $notification)
                <div class="p-4 sm:p-6 hover:bg-gray-100 transition-colors">
                    <div class="flex gap-3 sm:gap-4">
                        <img src="{{ asset('image/Avatar.svg') }}" alt="{{ $notification['user']['name'] ?? 'User' }}"
                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full object-cover flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">
                                <span class="font-bold">{{ $notification['user']['name'] ?? 'Unknown User' }}</span>
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
        </div>

        {{-- @if (!empty($pagination) && $pagination['last_page'] > 1)
            <div class="p-4 sm:p-6 border-t border-gray-100">
                <nav class="flex justify-center items-center gap-2">
                    @for ($i = 1; $i <= $pagination['last_page']; $i++)
                        <a href="{{ route('notifications.index', ['page' => $i]) }}" 
                           class="px-3 py-1 rounded-md text-sm {{ $pagination['current_page'] == $i ? 'bg-gray-200 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            {{ $i }}
                        </a>
                    @endfor
                </nav>
            </div>
        @endif --}}
    </div>
</section>