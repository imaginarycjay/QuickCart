<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Group 7 website' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-gradient-to-bl from-amber-900 to-amber-950">

    <x-navbar />

    {{-- here ang main content --}}
   <main class="container mx-auto  mt-2"> 
        {{ $slot }}
    </main>
</body>

</html>
