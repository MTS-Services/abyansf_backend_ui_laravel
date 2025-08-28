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
    @fluxAppearance
    @stack('css')
</head>

<body x-data @navigate.start="window.scroll({top: 0, behavior: 'smooth'})">

    @livewire('layouts.header')

    @if (api_is_authenticated())
        @livewire('layouts.navbar')
    @endif

    {{ $slot }}

    @fluxScripts
    @stack('js')
</body>

</html>
