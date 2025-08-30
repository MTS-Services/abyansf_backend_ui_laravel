<header class="w-full relative">
    <div class="hidden sm:flex items-center justify-between mx-auto max-w-[1200px] h-28 sm:h-32 px-4">
        </div>

    <div class="flex sm:hidden items-center justify-between mx-auto w-full h-20 px-4" x-data="{ sidebarOpen: false }">
        <div>
            <a href="{{ route('login') }}" wire:navigate>
                <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
            </a>
        </div>

        <div class="flex items-center space-x-2">
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = ! open"
                    class="relative p-2 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#0f0f]">
                    <flux:icon name="bell" class="w-6 h-6" />
                    <span
                        class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center text-xs font-bold text-white bg-red-500 rounded-full">3</span>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-md z-50">
                    <div class="p-4 border-b font-semibold text-gray-700">Notifications</div>
                    <ul class="max-h-60 overflow-y-auto">
                        <li class="p-3 hover:bg-gray-100 cursor-pointer">🔔 New user registered</li>
                        <li class="p-3 hover:bg-gray-100 cursor-pointer">📦 Order #1234 shipped</li>
                        <li class="p-3 hover:bg-gray-100 cursor-pointer">💬 New message received</li>
                    </ul>
                    <div class="p-2 text-center text-sm text-blue-600 hover:underline cursor-pointer">View All</div>
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
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    @if (api_is_authenticated())
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100" wire:click="logout">Logout Now</button>
                    @endif
                </div>
            </div>
            <button @click="sidebarOpen = ! sidebarOpen"
                class="p-2 rounded-md text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                <flux:icon name="bars-3" x-show="!sidebarOpen" class="w-6 h-6" />
                <flux:icon name="x-mark" x-show="sidebarOpen" class="w-6 h-6" />
            </button>
        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-30"></div>

        <div class="fixed top-0 right-0 h-full w-64 bg-white z-40 transform transition-transform duration-300 ease-in-out sm:hidden"
            x-show="sidebarOpen"
            x-transition:enter="transform translate-x-full"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform translate-x-0"
            x-transition:leave-end="translate-x-full">
            <div class="flex justify-end p-4">
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