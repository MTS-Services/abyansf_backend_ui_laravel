<header class="w-full relative">
    <div class="hidden sm:flex items-center justify-between container mx-auto max-w-[1200px] h-28 sm:h-32 px-4">
        <div>
            <a href="{{ route('login') }}" wire:navigate>
                <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo"
                    class="w-16 sm:w-20 h-16 sm:h-20 rounded-full">
            </a>
        </div>

        <div class="flex items-center space-x-4">

            <div x-data="{ open: false }" class="relative">
                <!-- Notification Button -->
                <button @click="open = !open" class="p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405C18.79 15.21 18 14.11 18 13V9c0-3.314-2.686-6-6-6S6 5.686 6 9v4c0 1.11-.79 2.21-1.595 2.595L3 17h5m7 0a3 3 0 11-6 0h6z">
                        </path>
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center text-xs font-bold text-white bg-red-500 rounded-full">3</span>
                </button>

                <!-- Overlay (click to close) -->
                <div x-show="open" x-transition.opacity @click="open = false"
                    class="fixed inset-0 bg-black bg-opacity-40 z-40" style="display: none;"></div>

                <!-- Notification Panel -->
                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="fixed top-0 right-0 h-full w-96 bg-white shadow-xl border-l border-gray-200 z-50 transform"
                    style="display: none;">

                    <!-- Header -->
                    <div class="p-4 border-b font-semibold text-gray-700 flex justify-between items-center">
                        <span>Notifications</span>
                        <button @click="open = false" class="text-gray-500 hover:text-gray-700">✕</button>
                    </div>

                    <!-- Notifications List -->
                    <div class="max-h-[800px] overflow-y-auto font-halvetica">

                        <!-- Example Notification -->
                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-bold">Lois Griffin</span> commented in 😍 <span
                                        class="font-bold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500 font-normal">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600 font-normal">🤷‍♀️ Assigned to <span
                                        class="font-normal">💖 Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-semibold">Lois Griffin</span> commented in 😍 <span
                                        class="font-semibold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600">🤷‍♀️ Assigned to <span class="font-semibold">💖 Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-semibold">Lois Griffin</span> commented in 😍 <span
                                        class="font-semibold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600">🤷‍♀️ Assigned to <span class="font-semibold">💖 Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-semibold">Lois Griffin</span> commented in 😍 <span
                                        class="font-semibold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600">🤷‍♀️ Assigned to <span class="font-semibold">💖 Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-semibold">Lois Griffin</span> commented in 😍 <span
                                        class="font-semibold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600">🤷‍♀️ Assigned to <span class="font-semibold">💖 Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-semibold">Lois Griffin</span> commented in 😍 <span
                                        class="font-semibold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600">🤷‍♀️ Assigned to <span class="font-semibold">💖
                                        Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="flex justify-between p-4">
                        <div class="p-3 text-center text-sm text-white bg-[#AD8945] hover:underline cursor-pointer ">
                            Mark
                            All Read
                        </div>
                        <div class="p-3 text-center text-sm text-blue-600 hover:underline cursor-pointer ">View
                            All
                        </div>
                    </div>
                </div>
            </div>



            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = ! open"
                    class="flex items-center gap-2 p-2 rounded-full text-purple-500 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <flux:icon name="user-circle" class="w-6 h-6" />
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50 hidden "
                    :class="{ '!block': open }">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    @if (api_is_authenticated())
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100"
                            wire:click="logout">Logout</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="flex sm:hidden items-center justify-between mx-auto w-full h-20 px-4" x-data="{ sidebarOpen: false, userOpen: false, bellOpen: false }">

        <!-- Logo -->
        <div>
            <a href="{{ route('login') }}" wire:navigate>
                <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
            </a>
        </div>

        <!-- Right section: notifications + user + menu -->
        <div class="flex items-center space-x-2">

            <!-- Notifications -->
            <div class="relative">
                <!-- Bell button -->
                <button @click="bellOpen = ! bellOpen"
                    class="relative p-2 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#0f0f]">
                    <flux:icon name="bell" class="w-6 h-6" />
                    <span
                        class="absolute -top-1 right-0 w-5 h-5 flex items-center justify-center text-xs font-bold text-white bg-red-500 rounded-full">3</span>
                </button>

                <!-- Overlay -->
                <div x-show="bellOpen" class="fixed inset-0 bg-black bg-opacity-40 z-40" @click="bellOpen = false"
                    x-transition.opacity>
                </div>

                <!-- Slide-over panel -->
                <div x-show="bellOpen" x-transition:enter="transform transition ease-out duration-300"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in duration-200"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    class="fixed top-0 right-0 w-80 h-full bg-white shadow-lg z-50">

                    <!-- Header -->
                    <div class="p-4 border-b font-semibold text-gray-700 flex justify-between items-center">
                        Notifications
                        <button @click="bellOpen = false" class="text-gray-500 hover:text-gray-800">&times;</button>
                    </div>

                    <div class="max-h-96 overflow-y-auto font-halvetica">

                        <!-- Example Notification -->
                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-bold">Lois Griffin</span> commented in 😍 <span
                                        class="font-bold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500 font-normal">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600 font-normal">🤷‍♀️ Assigned to <span
                                        class="font-normal">💖 Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-semibold">Lois Griffin</span> commented in 😍 <span
                                        class="font-semibold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600">🤷‍♀️ Assigned to <span class="font-semibold">💖
                                        Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-semibold">Lois Griffin</span> commented in 😍 <span
                                        class="font-semibold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600">🤷‍♀️ Assigned to <span class="font-semibold">💖
                                        Peter
                                        Griffin</span></p>
                            </div>
                        </div>

                        <div class="p-4 flex gap-3 border-b">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <p><span class="font-semibold">Lois Griffin</span> commented in 😍 <span
                                        class="font-semibold">Take Brian on a walk</span></p>
                                <p class="text-sm text-gray-500">11 hours ago • Task List</p>
                                <p class="text-sm text-gray-600">🤷‍♀️ Assigned to <span class="font-semibold">💖
                                        Peter
                                        Griffin</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-between p-4">
                        <div class="p-3 text-center text-sm text-white bg-[#AD8945] hover:underline cursor-pointer ">
                            Mark
                            All Read
                        </div>
                        <div class="p-3 text-center text-sm text-blue-600 hover:underline cursor-pointer ">View
                            All
                        </div>
                    </div>
                </div>
            </div>

            <!-- User menu -->
            <div class="relative">
                <button @click="userOpen = ! userOpen"
                    class="flex items-center gap-2 p-2 rounded-full text-purple-500 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <flux:icon name="user-circle" class="w-6 h-6" />
                </button>
                <div x-show="userOpen" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50 hidden"
                    :class="{ '!block': userOpen }">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    @if (api_is_authenticated())
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100" wire:click="logout">
                            Logout Now
                        </button>
                    @endif
                </div>
            </div>

            <!-- Sidebar toggle -->
            <button @click="sidebarOpen = true"
                class="p-2 rounded-md text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                <flux:icon name="bars-3" class="w-6 h-6" />
            </button>
        </div>

        <!-- Sidebar overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
            class="fixed inset-0 bg-black bg-opacity-50 z-30">
        </div>

        <!-- Sidebar -->
        <div class="fixed top-0 right-0 h-full w-64 bg-white z-40 transform transition-transform duration-300 ease-in-out sm:hidden"
            x-show="sidebarOpen" x-transition:enter="transform translate-x-full"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transform translate-x-0" x-transition:leave-end="translate-x-full">

            <div class="flex justify-between items-center p-4">
                <a href="{{ route('login') }}" wire:navigate>
                    <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
                </a>
                <button @click="sidebarOpen = false" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <flux:icon name="x-mark" class="w-6 h-6" />
                </button>
            </div>

            <div class="flex flex-col p-4 space-y-2">
                <a href="{{ route('admin.users') }}"
                    class="py-2 px-4 text-center font-semibold rounded-md {{ request()->routeIs('admin.users') ? 'bg-gray-200 text-gray-800' : 'text-gray-700 hover:bg-gray-100' }}">Users</a>
                <a href="{{ route('admin.bookings') }}"
                    class="py-2 px-4 text-center font-semibold rounded-md {{ request()->routeIs('admin.bookings') ? 'bg-gray-200 text-gray-800' : 'text-gray-700 hover:bg-gray-100' }}">Bookings</a>
                <a href="{{ route('admin.listing-list') }}"
                    class="py-2 px-4 text-center font-semibold rounded-md {{ request()->routeIs('admin.listing-list') ? 'bg-gray-200 text-gray-800' : 'text-gray-700 hover:bg-gray-100' }}">Listings</a>
                <a href="{{ route('admin.event-list') }}"
                    class="py-2 px-4 text-center font-semibold rounded-md {{ request()->routeIs('admin.event-list') ? 'bg-gray-200 text-gray-800' : 'text-gray-700 hover:bg-gray-100' }}">Event</a>
                <a href="{{ route('admin.attendance') }}"
                    class="py-2 px-4 text-center font-semibold rounded-md {{ request()->routeIs('admin.attendance') ? 'bg-gray-200 text-gray-800' : 'text-gray-700 hover:bg-gray-100' }}">Attendance</a>
            </div>
        </div>
    </div>

</header>
