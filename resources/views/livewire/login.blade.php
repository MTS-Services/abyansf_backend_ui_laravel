<main class="pt-6">
    <div class="container mx-auto flex items-center justify-center ">

        <div class="w-full max-w-sm text-center ">
            <form wire:submit.prevent="login" class="w-full">
                <h1 class="text-4xl font-bold mb-2">Login Here</h1>
                <p class="text-gray-600 mb-6">Welcome back you’ve <br>been missed!</p>

                {{-- This will be the only place the error message is shown --}}
                @if ($errorMessage)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ $errorMessage }}</span>
                    </div>
                @endif

                {{-- You can remove these @error directives since the API returns a general error --}}
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <input type="text" wire:model.live="email" placeholder="Email"
                    class="w-full px-4 p-4 bg-[#F8F6EE] border border-gray-100 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#c5a86a]">

                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <div class="relative mb-4">
                    <input type="password" wire:model.live="password" placeholder="Password"
                        class="w-full px-4 p-4 bg-[#F8F6EE] border border-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-[#c5a86a]">
                    <span class="absolute right-3 top-2.5 cursor-pointer"><img
                            src="{{ asset('image/PasswordProjection.png') }}" alt="" class="pt-2"></span>
                </div>

                <div class="flex items-center mb-4 float-left">
                    <input type="checkbox" wire:model.live="rememberMe" id="rememberMe"
                        class="form-checkbox h-4 w-4 text-[#c5a86a] rounded border-gray-300">
                    <label for="rememberMe" class="ml-2 text-sm text-[#AD8945] cursor-pointer">Remember me!</label>
                </div>

                <button type="submit"
                    class="font-family: Playfair Display; w-full bg-[#c5a86a] text-white font-medium p-4 rounded-md shadow-md hover:bg-[#b8964c] transition box-shadow">
                    Login
                </button>
            </form>
        </div>
    </div>
</main>
