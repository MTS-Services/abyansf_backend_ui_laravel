<div class="relative">
    {{-- Notification Button --}}
    <button wire:click="togglePanel"
        class="btn btn-ghost btn-circle relative hover:bg-gray-200 dark:hover:bg-gray-700">
        <flux:icon name="bell" class="h-6 w-6 text-gray-800 dark:text-gray-200" />
        @if ($this->unreadCount > 0)
            <span
                class="absolute -top-1 -right-1 badge badge-sm bg-blue-500 text-white border-2 border-white pulse-glow">
                {{ $this->unreadCount }}
            </span>
        @endif
    </button>

    {{-- Panel Overlay --}}
    @if ($showPanel)
        <div class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 transition-opacity duration-500"
            wire:click="closePanel"
            x-transition:enter="transition-opacity duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
        </div>
    @endif

    {{-- Notification Panel --}}
    @if ($showPanel)
        <div
            class="fixed right-0 top-0 h-full w-96 bg-white/50 dark:bg-gray-800/90 notification-panel z-50 flex flex-col shadow-lg rounded-l-lg"
            x-data="{ show: @entangle('showPanel') }" x-show="show"
            x-transition:enter="transition-all duration-500 ease-out"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition-all duration-500 ease-in"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0">

            {{-- Panel Header --}}
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    Notifications
                </h2>
                <button wire:click="closePanel"
                    class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <flux:icon name="x-mark" class="h-5 w-5 text-gray-500 dark:text-gray-200" />
                </button>
            </div>

            {{-- Panel Content --}}
            <div class="flex-1 overflow-y-auto">
                @php
                    $notifications = [
                        [
                            'user_avatar' => 'https://i.pravatar.cc/150?u=lois',
                            'user_name' => 'Lois Griffin',
                            'action' => 'commented in',
                            'task_name' => 'Take Brian on a walk',
                            'time' => '11 hours ago',
                            'is_unread' => true,
                            'assigned_to' => ['user_name' => 'Peter Griffin'],
                        ],
                        [
                            'user_avatar' => 'https://i.pravatar.cc/150?u=glenn',
                            'user_name' => 'Glenn Quagmire',
                            'action' => 'commented in',
                            'task_name' => 'Take Brian on a walk',
                            'time' => '11 hours ago',
                            'is_unread' => true,
                            'assigned_to' => null,
                        ],
                        [
                            'user_avatar' => 'https://i.pravatar.cc/150?u=lois2',
                            'user_name' => 'Lois Griffin',
                            'action' => 'commented in',
                            'task_name' => 'Take Brian on a walk',
                            'time' => '11 hours ago',
                            'is_unread' => false,
                            'assigned_to' => ['user_name' => 'Peter Griffin'],
                        ],
                        [
                            'user_avatar' => 'https://i.pravatar.cc/150?u=glenn2',
                            'user_name' => 'Glenn Quagmire',
                            'action' => 'commented in',
                            'task_name' => 'Take Brian on a walk',
                            'time' => '11 hours ago',
                            'is_unread' => false,
                            'assigned_to' => null,
                        ],
                    ];
                @endphp

                @if (count($notifications) > 0)
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($notifications as $notification)
                            <div
                                class="p-4 flex items-start space-x-4 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition duration-150 rounded-lg">
                                <div class="relative flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="{{ $notification['user_avatar'] }}"
                                        alt="{{ $notification['user_name'] }}">
                                    @if ($notification['is_unread'])
                                        <span
                                            class="absolute top-0 left-0 block h-2.5 w-2.5 rounded-full bg-blue-500 ring-2 ring-white dark:ring-gray-800"></span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        <strong
                                            class="font-semibold text-gray-900 dark:text-white">{{ $notification['user_name'] }}</strong>
                                        {{ $notification['action'] }}
                                        <a href="#"
                                            class="font-semibold text-gray-800 dark:text-gray-200 hover:underline">{{ $notification['task_name'] }}</a>
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $notification['time'] }}
                                    </p>
                                    @if ($notification['assigned_to'])
                                        <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                            <flux:icon name="user" class="h-4 w-4 mr-1.5 text-gray-400" />
                                            Assigned to {{ $notification['assigned_to']['user_name'] }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div
                            class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                            <flux:icon name="bell" class="text-2xl text-gray-400" />
                        </div>
                        <p class="text-gray-500 dark:text-gray-400">No notifications yet</p>
                    </div>
                @endif
            </div>

            {{-- Panel Footer --}}
            <div
                class="flex items-center justify-between p-4 border-t border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/90 backdrop-blur-md">
                <button wire:click="markAllAsRead"
                    class="btn bg-[#ac9455] hover:bg-[#99824c] border-none text-white btn-sm flex-1">
                    <flux:icon name="check" class="h-4 w-4 mr-2" />
                    Mark All Read
                </button>
                <a href="#"
                    class="btn btn-outline border-gray-300 dark:border-gray-600 dark:text-gray-300 btn-sm flex-1 ml-2 ">
                    See All
                </a>
            </div>
        </div>
    @endif

    <style>
        .notification-panel {
            box-shadow: -10px 0 25px -5px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] .notification-panel {
            box-shadow: -10px 0 25px -5px rgba(0, 0, 0, 0.3);
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 2px rgba(59, 130, 246, 0.6);
            }
            50% {
                box-shadow: 0 0 10px rgba(59, 130, 246, 0.9);
            }
        }

        .pulse-glow {
            animation: pulse-glow 2s infinite ease-in-out;
        }
    </style>
</div>