<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Group 7 website' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-gray-100">
{{-- 
    <nav class=" flex justify-between ml-4">
        <div class=" w-auto gap-3 flex">
            <x-navlink href="/" :active="false">Home</x-navlink>
            <x-navlink href="/products">Products</x-navlink>
            <x-navlink href="/about">About</x-navlink>
        </div>
    </nav>
 --}}
    <header>
        {{ $header }}
    </header>

    <main class="container mx-auto  mt-2"> 
        {{ $slot }}
    </main>
</body>

</html>
