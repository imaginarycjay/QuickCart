<nav x-data="{ open: false }"
    class="shadow px-4 py-1 flex items-center justify-between font-jetbrains sticky top-0 bg-transparent">
    <div class="flex items-center gap-4">
        <div class="font-bold text-lg text-white">QuickCoffee</div>
    </div>

    <div class="flex items-center md:gap-8 gap-2 ">
        <div class="hidden md:flex items-center">
            <ul class="flex gap-8 rounded-md px-2 py-1 items-center">
                <li>
                    <a href="/"
                        class="{{ request()->routeIs('/') ? 'text-white font-bold' : 'hover:scale-105' }} text-white">Home</a>
                </li>
                <li>
                    <a href="#"
                        class="{{ request()->routeIs('') ? 'text-white font-bold' : 'hover:scale-120' }} text-white">Products</a>
                </li>
                <li>
                    <a href="#"
                        class="{{ request()->routeIs('') ? 'text-white font-bold' : 'hover:scale-105' }} text-white">Orders</a>
                </li>
            </ul>
        </div>

        <button class="text-white ">
            @include('components.icons.cart')
        </button>
        <!-- Hamburger for small screens -->
        <button @click="open = true" aria-label="Open menu" class="md:hidden text-white border-l border-gray-100 pl-2">
            @include('components.icons.hamburger')
        </button>

    </div>


    <div x-show="open" x-cloak x-transition.opacity class="fixed inset-0 z-40 flex">
        <!-- overlay -->
        <div @click="open = false" class="fixed inset-0 " aria-hidden="true"></div>

        <!-- panel -->
        <div x-show="open" x-transition
            class="relative top-10 ml-auto rounded-lg mr-5 w-4/10 bg-white text-gray-900 shadow-lg px-4 pb-4 max-h-fit">
            <button @click="open = false" class="absolute top-3 right-3 text-gray-600">
                @include('components.icons.close')
            </button>
            <nav class="mt-6">
                <ul class="space-y-3">
                    <li><a href="/" class="block px-2 py-1 rounded hover:bg-gray-100 text-left">Home</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-100 text-left">Products</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-100 text-left pb-auto">Orders</a></li>
                </ul>
            </nav>
        </div>
    </div>

</nav>

<script>

</script>
