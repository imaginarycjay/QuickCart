<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Karinderya</title>
    {{-- init tailwind, di tayo gagamit ng bootstrap --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- test navs not final --}}
    <nav class="border border-yellow-500 flex justify-between container mx-auto">
        <p>Online Karinderya</p>
        <div class="border border-blue-500 w-auto gap-3 flex">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/products">Contacts</a>
        </div>
    </nav>

    {{-- dito mapunta contents --}}
    <div class="container mx-auto border border-red-500 mt-2">
        {{ $slot }}
    </div>
</body>

</html>
