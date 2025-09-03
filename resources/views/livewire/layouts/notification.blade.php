<div class="relative" x-data="{ showPanel: @entangle('showPanel').live }">
    {{-- Notification Button --}}
    <button x-on:click="showPanel = true"
        class="btn btn-ghost btn-circle relative hover:bg-gray-200 dark:hover:bg-gray-700">
        <flux:icon name="bell" class="h-6 w-6 text-gray-800 dark:text-gray-200" />
        @if ($this->unreadCount > 0)
            <span
                class="absolute -top-1 -right-1 badge badge-sm bg-blue-500 text-white border-2 border-white pulse-glow">
                {{ $this->unreadCount }}
            </span>
        @endif
    </button>

    <div class="fixed top-0 right-0 h-full w-fit z-50" x-show="showPanel" x-cloak
        x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="transform translate-x-full"
        x-transition:enter-end="transform translate-x-0" x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="transform translate-x-0" x-transition:leave-end="transform translate-x-full"
        x-on:click.away="showPanel = false">

        {{-- Notification Panel --}}

        <div class="relative w-full h-full">
            {{-- <span class="absolute top-0 left-0 w-full h-full bg-black/20 z-50 "></span> --}}
            <div
                class="h-full w-full max-w-96 bg-white/20 backdrop-blur-md notification-panel z-50 flex flex-col shadow-lg rounded-l-lg ml-auto relative">

                {{-- Panel Header --}}
                <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        Notifications
                    </h2>
                    <button x-on:click="showPanel = false"
                        class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <flux:icon name="x-mark" class="h-5 w-5 text-gray-500 dark:text-gray-200" />
                    </button>
                </div>

                {{-- Panel Content --}}
                <div class="flex-1 overflow-y-auto">
                    <div class="divide-y divide-gray-100">
                        @forelse($allNotifications as $notification)
                            <div class="p-4 sm:p-5 hover:bg-gray-100 transition-colors">
                                <div class="flex gap-3 sm:gap-4">
                                    <div class="flex-1 min-w-0">
                                        <!-- Notification Title -->
                                        <h2 class="text-sm font-semibold text-gray-900 mb-1">
                                            {{ $notification['title'] ?? 'Notification' }}
                                        </h2>

                                        <!-- User + Message -->
                                        <p class="flex items-center gap-2 text-sm text-gray-900">
                                         
                                            <span class="text-[#666C7E] font-normal leading-5 tracking-normal line-clamp-2">
                                                   <span class="font-medium ">
                                                {{ ucwords($notification['user']['name'] ?? 'Unknown User') }}
                                            </span> {{ $notification['message'] }}
                                            </span>
                                        </p>

                                        <!-- Time -->
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($notification['createdAt'])->diffForHumans() }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 min-w-96">
                                <div
                                    class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                    <flux:icon name="bell" class="text-2xl text-gray-400" />
                                </div>
                                <p class="text-gray-500 dark:text-gray-400">No notifications yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>


                {{-- Panel Footer --}}
                <div
                    class="flex items-center justify-between p-4 border-t border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/90 backdrop-blur-md">
                    {{-- <button wire:click="markAllAsRead"
                        class="btn bg-[#ac9455] hover:bg-[#99824c] border-none text-white btn-sm flex-1">
                        <flux:icon name="check" class="h-4 w-4 mr-2" />
                        Mark All Read
                    </button> --}}
                    <a href="{{ route('admin.all-notifications') }}"
                        class="btn btn-outline border-gray-300 dark:border-gray-600 dark:text-gray-300 btn-sm flex-1 ml-2 ">
                        See All
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
