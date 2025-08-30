<!DOCTYPE html>
<html lang="en" class="scroll-smooth light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance()

    <style>
        @keyframes bounce-dot {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>

    @stack('css')
</head>


<body x-data @navigate.start="window.scrollTo({top: 0, behavior: 'smooth'}) overflow-x-hidden relative">

    @livewire('layouts.header')

    @if (api_is_authenticated())
        @livewire('layouts.navbar')
    @endif

    <main class="container max-w-[1200px] w-full mx-auto p-4 mt-5 font-playfair">
        {{ $slot }}
    </main>

    <div id="navigation-loader" x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-accent-foreground/50 backdrop-blur-md">
        <div class="flex space-x-2">
            <div class="w-4 h-4 rounded-full bg-[#C7AE6A] animate-[bounce-dot_1.2s_infinite]"
                style="animation-delay: -0.8s;"></div>
            <div class="w-4 h-4 rounded-full bg-[#C7AE6A] animate-[bounce-dot_1.2s_infinite]"
                style="animation-delay: -0.4s;"></div>
            <div class="w-4 h-4 rounded-full bg-[#C7AE6A] animate-[bounce-dot_1.2s_infinite]"></div>
        </div>
    </div>

    @fluxScripts

    <script>
        document.addEventListener('livewire:navigate', (event) => {
            document.getElementById('navigation-loader').classList.remove('hidden');
        });

        document.addEventListener('livewire:navigating', () => {
            document.getElementById('navigation-loader').classList.remove('hidden');
        });

        document.addEventListener('livewire:navigated', () => {
            document.getElementById('navigation-loader').classList.add('hidden');
        });
    </script>
    @stack('js')
</body>

</html>
