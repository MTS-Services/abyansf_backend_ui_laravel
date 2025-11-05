<section class="flex items-center bg-white! justify-center ">

    <div class="w-full max-w-sm text-center bg-white!">
        <form wire:submit.prevent="login" class="w-full">
            <h1 class="text-4xl font-bold mb-2 text-black">Login Here</h1>
            <p class="text-gray-600 mb-6">Welcome back you’ve <br>been missed!</p>

            {{-- This will be the only place the error message is shown --}}
            @if ($errorMessage)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $errorMessage }}</span>
                </div>
            @endif

            {{-- You can remove these @error directives since the API returns a general error --}}
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <input type="text" wire:model.live="email" placeholder="Email"
                class="w-full px-4 p-4 bg-[#F8F6EE] text-black border border-gray-100 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#c5a86a]">

            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div x-data="{ show: false }" class="relative mb-4">
                <input :type="show ? 'text' : 'password'" wire:model.live="password" placeholder="Password"
                    class="w-full px-4 text-black p-4 bg-[#F8F6EE] border border-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-[#c5a86a]">

                <span
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-[#c5a86a]"
                    @click="show = !show">
                    <template x-if="!show">
                        <flux:icon name="eye" class="w-5 h-5" />
                    </template>
                    <template x-if="show">
                        <flux:icon name="eye-off" class="w-5 h-5" />
                    </template>
                </span>
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
</section>
