<header>
    <div class="flex items-center justify-center">
        <a href="{{ route('login') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <div class="container mx-auto absolute mt-12">
            <div class="absolute top-6 left-6">
                <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-16 h-16 rounded-full">
            </div>

            <!-- Top Right Icons -->
            <div class="absolute top-6 right-6 flex items-center space-x-4">
                <span class="text-black"><img src="{{ asset('image/iconoir_bell-notification-solid.png') }}"
                        alt="">
                </span>
                <span class="text-purple-400"><img src="{{ asset('image/Genericavatar.png') }}" alt=""></span>
            </div>
        </div>

    </div>
</header>
