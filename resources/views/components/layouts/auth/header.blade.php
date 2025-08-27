<script src="https://cdn.tailwindcss.com"></script>
<header class="w-full">
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


                    <img src="{{ asset('image/iconoir_bell-notification-solid.png') }}" class="w-6 h-6" alt="">

                    <!-- Notification Badge -->

                </button>
            </div>

            <!-- Sidebar Overlay -->
            <div id="notifyOverlay"
                class="fixed inset-0 bg-[#ffffff] bg-opacity-50 hidden transition-opacity duration-300">
            </div>

            <!-- Sidebar Slider -->
            <div id="notifySidebar"
                class="fixed top-0 right-0 w-80 h-full bg-[#ffffffa4] shadow-lg transform translate-x-full transition-transform duration-300">
                <div class="flex items-center justify-between p-4 border-b">
                    <h2 class="font-semibold  ">Notifications</h2>
                    <button id="closeSidebar"
                        class="text-gray-900 w-8 h-8 rounded-full   hover:text-red-500">&times;</button>
                </div>

                <div class="p-3 text-center text-sm text-blue-600 hover:underline cursor-pointer">View All</div>
            </div>

            <div class="relative inline-block text-left">
                <!-- User Icon Button -->
                <button id="user-menu-btn"
                    class="flex items-center gap-2 p-2 rounded-full text-purple-500  focus:outline-none focus:ring-2 focus:ring-purple-400">
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
                    class="hidden absolute right-0 mt-2 w-40   rounded-lg shadow-lg border border-gray-100 py-2 z-20">

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

        </div>
    </div>
</header>





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
