{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
<header class="w-full">
<<<<<<< HEAD
    <!-- Outer container using flexbox for centering -->
    <div class="flex flex-col items-center justify-center relative mx-auto md:w-[1200px] h-32 ">

        <!-- Top Left Logo - Positioned absolutely -->
        <div class="absolute top-6 left-4 md:left-0">
            <!-- Note: Using a placeholder image for demonstration -->
            <button>
                <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-20 h-20 rounded-full">

            </button>
        </div>

        <!-- Top Right Icons - Positioned absolutely -->
        <div class="absolute top-12 right-4 md:right-6 flex items-center space-x-4">
            <div class="relative inline-block">
                <!-- Notification Button -->
                <button id="notifyBtn"
                    class="relative p-2 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <!-- Bell Icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405C18.79 15.21 18 14.11 18 13V9c0-3.314-2.686-6-6-6S6 5.686 6 9v4c0 1.11-.79 2.21-1.595 2.595L3 17h5m7 0a3 3 0 11-6 0h6z">
                        </path>
                    </svg>

                    <!-- Notification Badge -->
                    <span
                        class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
                        3
                    </span>
                </button>

                <!-- Dropdown Panel -->
                <div id="notifyPanel"
                    class="hidden absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg">
                    <div class="p-4 border-b font-semibold text-gray-700">Notifications</div>
                    <ul class="max-h-60 overflow-y-auto">
                        <li class="p-3 hover:bg-gray-100 cursor-pointer">🔔 New user registered</li>
                        <li class="p-3 hover:bg-gray-100 cursor-pointer">📦 Order #1234 shipped</li>
                        <li class="p-3 hover:bg-gray-100 cursor-pointer">💬 New message received</li>
                    </ul>
                    <div class="p-2 text-center text-sm text-blue-600 hover:underline cursor-pointer">View All</div>
                </div>
            </div>

            <div class="relative inline-block text-left">
                <!-- User Icon Button -->
                <button id="user-menu-btn"
                    class="flex items-center gap-2 p-2 rounded-full text-purple-500 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <!-- Icon -->
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9
                0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12
                21a8.966 8.966 0 0 1-5.982-2.275M15
                9.75a3 3 0 1 1-6 0 3 3 0 0 1 6
                0Z" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="user-menu"
                    class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-20">

                    <!-- Login Menu -->
                    <a href="#login" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                        Login
                    </a>

                    <!-- Logout Menu -->
                    <a href="#logout" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                        Logout
                    </a>
                </div>
            </div>

=======
    <div class="flex items-center justify-between mx-auto w-full md:w-[1200px] h-32 p-4">

        <div class="flex items-center space-x-2">
            <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-20 h-20 rounded-full">
        </div>

        <div class="flex items-center space-x-4">
            <span class="text-black">
                <img src="{{ asset('image/iconoir_bell-notification-solid.png') }}" class="w-5 h-5" alt="Notifications">
            </span>
            <span class="text-purple-400">
                <img src="{{ asset('image/Genericavatar.png') }}" class="w-5 h-5 rounded-full" alt="User avatar">
            </span>
>>>>>>> main
        </div>
    </div>
</header>


<script>
    const btn = document.getElementById("notifyBtn");
    const panel = document.getElementById("notifyPanel");

    btn.addEventListener("click", () => {
        panel.classList.toggle("hidden");
    });

    // Optional: Close if clicking outside
    document.addEventListener("click", (e) => {
        if (!btn.contains(e.target) && !panel.contains(e.target)) {
            panel.classList.add("hidden");
        }
    });
</script>


<script>
    // Toggle dropdown
    document.getElementById("user-menu-btn").addEventListener("click", function() {
        document.getElementById("user-menu").classList.toggle("hidden");
    });

    // Close dropdown when clicking outside
    window.addEventListener("click", function(e) {
        const menu = document.getElementById("user-menu");
        const button = document.getElementById("user-menu-btn");
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });
</script>
