<script src="https://cdn.tailwindcss.com"></script>
<header class="w-full">
    <!-- Outer container using flexbox for centering -->
    <div class="flex flex-col items-center justify-center relative mx-auto w-full md:w-[1200px] h-32">

        <!-- Top Left Logo - Positioned absolutely -->
        <div class="absolute top-6 left-4 md:left-0">
            <!-- Note: Using a placeholder image for demonstration -->
            <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-20 h-20 rounded-full">
        </div>

        <!-- Top Right Icons - Positioned absolutely -->
        <div class="absolute top-12 right-4 md:right-6 flex items-center space-x-4">
            <span class="text-black">
                <!-- Note: Using a placeholder icon for demonstration -->
                <img src="{{ asset('image/iconoir_bell-notification-solid.png') }}" class="w-5 h-5" alt="">
            </span>
            <span class="text-purple-400">
                <!-- Note: Using a placeholder avatar for demonstration -->
                <img src="{{ asset('image/Genericavatar.png') }}" class="w-5 h-5 rounded-full" alt="">
            </span>
        </div>
    </div>
</header>
