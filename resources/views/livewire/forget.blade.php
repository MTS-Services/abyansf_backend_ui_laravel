<div class="  flex items-center justify-center ">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-4">
            <div class="relative">
                <label for="email" class="block text-gray-700 mb-1">New Password</label>
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <!-- Lock icon (left side) -->
                </span>

                <input id="password" type="password" wire:model="password" placeholder="Password"
                    class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-10 focus:ring-2 focus:ring-[#d6c069] focus:outline-none" />

                <!-- 👁️ Eye SVG (toggle password visibility) -->
                <button type="button" onclick="togglePassword('password', this)"
                    class="absolute inset-y-0 right-0 flex items-center pt-6 pr-3 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>


            <div class="relative">
                <label for="email" class="block text-gray-700 mb-1">Confirm New Password</label>
                <input id="password" type="password" wire:model="password" placeholder="Password"
                    class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-10 focus:ring-2 focus:ring-[#d6c069] focus:outline-none" />

                <!-- 👁️ Eye SVG (toggle password visibility) -->
                <button type="button" onclick="togglePassword('password', this)"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 pt-6 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>


            <button href="#" type="submit"
                class="w-full bg-[#c5a86a] text-white py-2 rounded-lg hover:bg-[#d6c069] transition duration-200">
                Continue
            </button>
        </form>





        <div class="text-center mt-4">
            <a href="/login" class="text-[#c5a86a] hover:underline">Back to login</a>
        </div>
    </div>



</div>
