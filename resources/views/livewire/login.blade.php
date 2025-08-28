<main class="max-w-[1200px] h-[calc(100vh-8rem)] mx-auto z-10  overflow-y-hidden">
    <style>
        body {
            overflow: hidden;
        }
    </style>

    <!-- First Shape -->
    <div class="absolute w-[635px] h-[635px] top-[-200px] right-[-100px] bg-[#F8F6EE] rounded-full opacity-40 rotate-0 z-[-1]"
        aria-hidden="true"></div>

    <!-- Second Shape -->
    <div class="absolute w-[718px] h-[718px] top-[-240px] right-[-150px] rounded-full opacity-100 border-[3px] border-[#F8F6EE] rotate-0 z-[-1]"
        aria-hidden="true"></div>


    <!-- Login Container -->
    <div class="container mx-auto flex items-center justify-center min-h-full pt-10">
        <div class="w-full max-w-sm text-center">
            <h1 class="text-4xl font-bold mb-2 font-playfair ">Login Here</h1>
            <p class="text-gray-600 mb-6 font-Inter">Welcome back you’ve <br>been missed!</p>

            <!-- Email Input -->
            <input type="email" placeholder="Email"
                class="w-full px-4 py-4 bg-[#c5a86a] border-[#c5a86a] rounded-md mb-4 ">

            <!-- Password Input -->
            <div class="relative mb-4">
                <input type="password" placeholder="Password"
                    class="w-full px-4 py-4 bg-[#c5a86a] border border-[#c5a86a] rounded-md ">
                <span class="absolute right-3 top-2.5 cursor-pointer">
                    <img src="{{ asset('image/PasswordProjection.png') }}" alt="" class="pt-2">
                </span>
            </div>

            <!-- Login Button -->
            <button
                class="w-full bg-[#c5a86a] text-white font-medium py-4 rounded-md shadow-lg hover:bg-[#b8964c] font-playfair transition shadow-[#c5a86a] ">
                Login
            </button>

            <!-- Remember Me -->
            <p class="text-sm text-[#AD8945] mt-4 cursor-pointer font-semibold text-left">Remember me!</p>
        </div>
    </div>




    <!-- Square 1 -->
    <div
        class="absolute w-[372px] h-[372px] border-2 border-[#f3f0e6] opacity-100  bottom-0 left-[-118.71px] rotate-0 z-10">
    </div>
    <div
        class="absolute w-[372px] h-[372px] border-2 border-[#f3f0e6] opacity-100 bottom-0 left-[-127px] rotate-[27.09deg] z-10">
    </div>



</main>
