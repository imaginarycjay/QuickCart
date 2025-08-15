<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Karinderya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <nav class=" flex justify-between container mx-auto">
        <p>Logo here</p>
        <div class=" w-auto gap-3 flex">
            <x-navlink href="/">Home</x-navlink>
            <x-navlink href="/about">About</x-navlink>
            <x-navlink href="/products">Products</x-navlink>
        </div>
    </nav>

    <div class="container mx-auto  mt-2">
        {{ $slot }}
    </div>
</body>

</html>
