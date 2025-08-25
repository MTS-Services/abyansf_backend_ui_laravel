<main>

    <div class="bg-white min-h-screen flex flex-col items-center justify-center relative container mx-auto p-4">

        <!-- Top Left Logo -->
        <div class="absolute top-6 left-6">
            <img src="{{ asset('image/Maskgroup.png') }}" alt="Logo" class="w-16 h-16 rounded-full">
        </div>

        <!-- Top Right Icons -->
        <div class="absolute top-6 right-6 flex items-center space-x-4">
            <span class="text-black"><img src="{{ asset('image/iconoir_bell-notification-solid.png') }}" alt="">
            </span>
            <span class="text-purple-400"><img src="{{ asset('image/Genericavatar.png') }}" alt=""></span>
        </div>

        <!-- Login Card -->
        <div class="w-full max-w-sm text-center">
            <h1 class="text-4xl font-bold mb-2">Login Here</h1>
            <p class="text-gray-600 mb-6">Welcome back you’ve <br>been missed!</p>

            <!-- Email Input -->
            <input type="email" placeholder="Email"
                class=" w-full px-4 p-4 bg-[#F8F6EE] border-[#c5a86a] rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#c5a86a]">

            <!-- Password Input -->
            <div class="relative mb-4">
                <input type="password" placeholder="Password"
                    class="w-full px-4 p-4 bg-[#F8F6EE] border border-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-[#c5a86a]">
                <span class="absolute right-3 top-2.5 cursor-pointer"><img
                        src="{{ asset('image/PasswordProjection.png') }}" alt="" class="pt-2"></span>
            </div>

            <!-- Login Button -->
            <button
                class="font-family: Playfair Display; w-full bg-[#c5a86a] text-white font-medium p-4 rounded-md shadow-md hover:bg-[#b8964c] transition box-shadow">
                Login
            </button>

            <!-- Remember me -->
            <p class="text-sm text-[#AD8945] m-6 float-left cursor-pointer font-semibold">Remember me!</p>
        </div>
    </div>

    </html>
    {{-- <x-button>Test Button</x-button> --}}
</main>
