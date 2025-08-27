<header class="w-full relative">
    <!-- Desktop Header -->
    <div class="hidden sm:flex items-center justify-between mx-auto max-w-[1200px] h-28 sm:h-32 px-4">
        <!-- Logo -->
        <div>
            <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-16 sm:w-20 h-16 sm:h-20 rounded-full">
        </div>

        <!-- Notification + User Icon -->
        <div class="flex items-center space-x-4">
            <!-- Notification -->
            <div class="relative">
                <button id="notifyBtn"
                    class="relative p-2 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <!-- Bell Icon -->


                    <img src="{{ asset('image/iconoir_bell-notification-solid.png') }}" class="w-6 h-6" alt="">

                    <!-- Notification Badge -->

                </button>
            </div>

            <!-- Sidebar Overlay -->
            <div id="notifyOverlay" class="fixed inset-0 bg-black bg-opacity-40 hidden transition-opacity duration-300">
            </div>

            <!-- Sidebar Slider -->
            <div id="notifySidebar"
                class="fixed top-0 right-0 w-80 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300">
                <div class="flex items-center justify-between p-4 border-b">
                    <h2 class="font-semibold text-gray-700">Notifications</h2>
                    <button id="closeSidebar"
                        class="text-gray-900 w-8 h-8 rounded-full hover:bg-gray-600 hover:text-red-500">&times;</button>
                </div>
                <div class="p-12 card bg-white/90 dark:bg-gray-800/90 shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer opacity-75"
                    wire:click="openDetail">
                    <div class="card-body p-4">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 pt-1">
                                <div class="w-2 h-2 rounded-full bg-gray-400">
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-sm truncate text-gray-800 dark:text-gray-200">
                                    Email Verification Required</h3>
                                <p class="text-xs mt-1 line-clamp-2 text-gray-600 dark:text-gray-400">
                                    Please verify your email address to verify your account.</p>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-xs text-gray-500">5 hours ago</span>
                                    <span
                                        class="badge badge-outline badge-xs text-orange-600 border-orange-300">Private</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <i data-lucide="mail-warning" class="w-8 h-8 text-orange-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 text-center text-sm text-blue-600 hover:underline cursor-pointer">View All</div>
            </div>

            <!-- User Icon -->
            <button id="user-menu-btn"
                class="flex items-center gap-2 p-2 rounded-full text-purple-500 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-400">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="flex sm:hidden items-center justify-between mx-auto w-full h-20 px-4">
        <!-- Logo -->
        <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-14 h-14 rounded-full">

        <!-- Notification + Menu -->
        <div class="flex items-center space-x-2">
            <!-- Notification -->
            <div class="relative">
                <button id="notifyBtnMobile"
                    class="relative p-2 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405C18.79 15.21 18 14.11 18 13V9c0-3.314-2.686-6-6-6S6 5.686 6 9v4c0 1.11-.79 2.21-1.595 2.595L3 17h5m7 0a3 3 0 11-6 0h6z">
                        </path>
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center text-xs font-bold text-white bg-red-500 rounded-full">3</span>
                </button>

                <!-- Dropdown Panel -->
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
            <button id="user-menu-btnMobile"
                class="flex items-center gap-2 p-2 rounded-full text-purple-500 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-400">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>

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
        e.stopPropagation(); // prevent closing immediately
        notifyPanel.classList.toggle("hidden");
    });

    // Mobile notification toggle
    const notifyBtnMobile = document.getElementById("notifyBtnMobile");
    const notifyPanelMobile = document.getElementById("notifyPanelMobile");

    notifyBtnMobile.addEventListener("click", (e) => {
        e.stopPropagation();
        notifyPanelMobile.classList.toggle("hidden");
    });

    // Click outside to close dropdowns
    document.addEventListener("click", () => {
        notifyPanel.classList.add("hidden");
        notifyPanelMobile.classList.add("hidden");
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

    // Prevent mobile menu from closing when clicking inside
    mobileNav.addEventListener('click', (e) => e.stopPropagation());
</script>

<script>
    const notifyBtn = document.getElementById('notifyBtn');
    const notifySidebar = document.getElementById('notifySidebar');
    const notifyOverlay = document.getElementById('notifyOverlay');
    const closeSidebar = document.getElementById('closeSidebar');

    // Open sidebar
    notifyBtn.addEventListener('click', () => {
        notifySidebar.classList.remove('translate-x-full');
        notifyOverlay.classList.remove('hidden');
    });

    // Close sidebar
    closeSidebar.addEventListener('click', () => {
        notifySidebar.classList.add('translate-x-full');
        notifyOverlay.classList.add('hidden');
    });

    // Close when clicking outside
    notifyOverlay.addEventListener('click', () => {
        notifySidebar.classList.add('translate-x-full');
        notifyOverlay.classList.add('hidden');
    });
</script>
