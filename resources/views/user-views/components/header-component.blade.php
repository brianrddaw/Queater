<header class="flex justify-items-center items-center  bg-tesla-950 p-2 h-14 text-orange-100">
        {{-- <img src="{{ asset('imgs/logo.webp') }}" alt="" class="w-8 mr-auto"> --}}
        <div class="flex items-center pr-4 pl-2 h-full">
            <h1 class=" col-span-2 font-bold">Queater</h1>
        </div>
        <nav class="flex flex-row items-center ml-auto mr-2 ">
            <div>
                        @yield('navegacion')
            </div>


            <svg  id="icono-expandir" class="cursor-pointer w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>

        </nav>

</header>



