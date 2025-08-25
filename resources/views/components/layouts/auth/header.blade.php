<header>
    <div class="flex items-center justify-center">
        <a href="{{ route('login') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <h1 class="ms-2 text-lg font-semibold leading-6 text-zinc-900 dark:text-zinc-100">
            {{ config('app.name', 'Laravel') }}
        </h1>

    </div>
</header>
