@props(['title' => 'Group 7 website', 'full' => true])
<html lang="en" class="h-full">

<head class="h-full">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full text-white relative">
    <x-navbar />
    <main {{ $attributes->merge(['class' => $full ? 'w-full' : 'container mx-auto']) }}>
        {{ $slot }}
    </main>
</body>

</html>
