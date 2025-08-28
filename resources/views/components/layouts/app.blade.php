<!DOCTYPE html>
<html lang="en" class="scroll-smooth light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('partials.head')

    @stack('css')
</head>

<body>

    <x-layouts.auth.header :title="$title ?? null" />

    <x-layouts.auth.navbar />


    {{ $slot }}

    @fluxScripts
    @stack('js')
</body>

</html>
