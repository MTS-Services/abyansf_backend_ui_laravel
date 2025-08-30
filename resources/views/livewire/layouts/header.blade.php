<div>
    <header class="w-full relative">
        <!-- Desktop Header -->
        <div class="hidden sm:flex items-center justify-between mx-auto max-w-[1200px] h-28 sm:h-32 px-4">
            <!-- Logo -->
            <div>
                <a href="{{ route('login') }}" wire:navigate>
                    <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo"
                        class="w-16 sm:w-20 h-16 sm:h-20 rounded-full">
                </a>
            </div>

            <!-- Notification + User Icon -->
            <div class="flex items-center space-x-4">
                <!-- Notification -->
                <div class="relative">
                    <button id="notifyBtn"
                        class="relative p-2 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405C18.79 15.21 18 14.11 18 13V9c0-3.314-2.686-6-6-6S6 5.686 6 9v4c0 1.11-.79 2.21-1.595 2.595L3 17h5m7 0a3 3 0 11-6 0h6z">
                            </path>
                        </svg>
                        <span
                            class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center text-xs font-bold text-white bg-red-500 rounded-full">3</span>
                    </button>

                    <!-- Notification Dropdown -->
                    <div id="notifyPanel"
                        class="hidden absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <div class="p-4 border-b font-semibold text-gray-700">Notifications</div>
                        <ul class="max-h-60 overflow-y-auto">
                            <li class="p-3 hover:bg-gray-100 cursor-pointer">🔔 New user registered</li>
                            <li class="p-3 hover:bg-gray-100 cursor-pointer">📦 Order #1234 shipped</li>
                            <li class="p-3 hover:bg-gray-100 cursor-pointer">💬 New message received</li>
                        </ul>
                        <div class="p-2 text-center text-sm text-blue-600 hover:underline cursor-pointer">View All</div>
                    </div>
                </div>

                <!-- User Icon -->
                <div class="relative">
                    <button id="userMenuBtn"
                        class="flex items-center gap-2 p-2 rounded-full text-purple-500 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-400">
                        <flux:icon name="user-circle" class="w-6 h-6" />
                    </button>

                    <!-- User Dropdown -->
                    <div id="userPanel"
                        class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        @if (api_is_authenticated())
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100"
                                wire:click="logout">Logout</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="flex sm:hidden items-center justify-between mx-auto w-full h-20 px-4">
            <!-- Logo -->
            <div>
                <a href="{{ route('login') }}" wire:navigate>
                    <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
                </a>
            </div>

            <!-- Notification + User + Mobile Menu -->
            <div class="flex items-center space-x-2">
                <!-- Notification -->
                <div class="relative">
                    <button id="notifyBtnMobile"
                        class="relative p-2 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#0f0f]">
                        <flux:icon name="bell" class="w-6 h-6" />
                        <span
                            class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center text-xs font-bold text-white bg-red-500 rounded-full">3</span>
                    </button>

                    <!-- Notification Dropdown -->
                    <div id="notifyPanelMobile"
                        class="hidden absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-md z-50">
                        <div class="p-4 border-b font-semibold text-gray-700">Notifications</div>
                        <ul class="max-h-60 overflow-y-auto">
                            <li class="p-3 hover:bg-gray-100 cursor-pointer">🔔 New user registered</li>
                            <li class="p-3 hover:bg-gray-100 cursor-pointer">📦 Order #1234 shipped</li>
                            <li class="p-3 hover:bg-gray-100 cursor-pointer">💬 New message received</li>
                        </ul>
                        <div class="p-2 text-center text-sm text-blue-600 hover:underline cursor-pointer">View All</div>
                    </div>
                </div>

                <!-- User Icon -->
                <div class="relative">
                    <button id="userMenuBtnMobile"
                        class="flex items-center gap-2 p-2 rounded-full text-purple-500 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-400">
                        <flux:icon name="user-circle" class="w-6 h-6" />
                    </button>

                    <!-- User Dropdown Mobile -->
                    <div id="userPanelMobile"
                        class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50">

                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>

                        @if (api_is_authenticated())
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100" wire:click="logout">
                                Logout Now
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn"
                    class="p-2 rounded-md text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <svg id="hamburgerMobile" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="closeMobile" class="h-6 w-6 hidden" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile nav links -->
        <div id="mobile-nav-links" class="hidden sm:hidden px-4 pb-4">
            <div class="flex flex-col bg-[#E7E7E7] rounded-md overflow-hidden shadow-sm p-1 space-y-1">
                <a href="{{ route('admin.users') }}"
                    class="py-2 text-center font-semibold rounded-sm {{ request()->routeIs('admin.users') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }}">Users</a>
                <a href="{{ route('admin.bookings') }}"
                    class="py-2 text-center font-semibold rounded-sm {{ request()->routeIs('admin.bookings') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }}">Bookings</a>
                <a href="{{ route('admin.listing-list') }}"
                    class="py-2 text-center font-semibold rounded-sm {{ request()->routeIs('admin.listing-list') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }}">Listings</a>
                <a href="{{ route('admin.event-list') }}"
                    class="py-2 text-center font-semibold rounded-sm {{ request()->routeIs('admin.event-list') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }}">Event</a>
                <a href="{{ route('admin.attendance') }}"
                    class="py-2 text-center font-semibold rounded-sm {{ request()->routeIs('admin.attendance') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }}">Attendance</a>
            </div>
        </div>
    </header>

    <script>
        // Desktop notification toggle
        const notifyBtn = document.getElementById("notifyBtn");
        const notifyPanel = document.getElementById("notifyPanel");
        notifyBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            notifyPanel.classList.toggle("hidden");
        });

        // Desktop user toggle
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userPanel = document.getElementById('userPanel');
        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userPanel.classList.toggle('hidden');
        });

        // Mobile notification toggle
        const notifyBtnMobile = document.getElementById("notifyBtnMobile");
        const notifyPanelMobile = document.getElementById("notifyPanelMobile");
        notifyBtnMobile.addEventListener("click", (e) => {
            e.stopPropagation();
            notifyPanelMobile.classList.toggle("hidden");
        });

        // Mobile user toggle
        const userMenuBtnMobile = document.getElementById('userMenuBtnMobile');
        const userPanelMobile = document.getElementById('userPanelMobile');
        userMenuBtnMobile.addEventListener('click', (e) => {
            e.stopPropagation();
            userPanelMobile.classList.toggle('hidden');
        });

        // Mobile menu toggle
        const mobileBtn = document.getElementById("mobile-menu-btn");
        const mobileNav = document.getElementById("mobile-nav-links");
        const hamburgerMobile = document.getElementById("hamburgerMobile");
        const closeMobile = document.getElementById("closeMobile");
        mobileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            mobileNav.classList.toggle('hidden');
            hamburgerMobile.classList.toggle('hidden');
            closeMobile.classList.toggle('hidden');
        });

        // Close dropdowns when clicking outside
        document.addEventListener("click", () => {
            notifyPanel.classList.add("hidden");
            notifyPanelMobile.classList.add("hidden");
            userPanel.classList.add("hidden");
            userPanelMobile.classList.add("hidden");
        });

        // Prevent dropdowns from closing when clicking inside
        notifyPanel.addEventListener('click', e => e.stopPropagation());
        notifyPanelMobile.addEventListener('click', e => e.stopPropagation());
        userPanel.addEventListener('click', e => e.stopPropagation());
        userPanelMobile.addEventListener('click', e => e.stopPropagation());
        mobileNav.addEventListener('click', e => e.stopPropagation());
    </script>
</div>
