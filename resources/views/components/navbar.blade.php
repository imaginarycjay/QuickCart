<nav x-data="{ open: false }"
   class="absolute top-0 inset-x-0 z-50 px-6 py-4 flex items-center justify-between font-montserrat bg-transparent shadow-md"> 

   {{-- logo soon  --}}
    <div class="flex items-center gap-4"> 
        <div class="font-bold text-lg text-black">QuickCart</div>
    </div>

    {{-- main nav for tabvlet and desktop --}}
    <div class="flex items-center md:gap-8 gap-2 ">
        <div class="hidden md:flex items-center">
            <ul class="flex gap-8 rounded-md px-2 py-1 items-center">
                <li>
                    <a href="/"
                        class="{{ request()->routeIs('/') ? 'text-black font-bold' : 'hover:scale-105' }} text-black">Home</a>
                </li>
                <li>
                    <a href="#"
                        class="{{ request()->routeIs('') ? 'text-white font-bold' : 'hover:scale-120' }} text-black">Products</a>
                </li>
                <li>
                    <a href="#"
                        class="{{ request()->routeIs('') ? 'text-white font-bold' : 'hover:scale-105' }} text-black">Orders</a>
                </li>
            </ul>
        </div>

        <button class="text-black ">
            @include('components.icons.cart')
        </button>
        <button @click="open = true" aria-label="Open menu" class="md:hidden text-black border-l border-black pl-2">
            @include('components.icons.hamburger')
        </button>

    </div>

    {{-- navv modal sa mobile --}}
    <div x-show="open" x-cloak x-transition.opacity class="fixed inset-0 z-40 flex">
        {{-- para kung i tap mag close yung modal, no need i click yung close button --}}
        <div @click="open = false" class="fixed inset-0 " aria-hidden="true"></div>

        <div x-show="open" x-transition
            class="relative top-12 ml-auto rounded-lg mr-5 w-4/10 bg-white text-gray-900 shadow-lg p-4 max-h-fit">
            <button @click="open = false" class="absolute top-3 right-3" >
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