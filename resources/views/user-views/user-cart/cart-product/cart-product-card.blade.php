<div class="grid grid-cols-9 items-center rounded-lg min-h-14 h-12  bg-orange-50 text-orange-950 text-xs">

    {{-- IMG--}}
    <img class="col-span-2 w-14 h-14 object-fit border-2 border-orange-950 bg-orange-950 rounded-l-lg object-cover " src="{{ asset('imgs/burguer.webp') }}" alt="">

    {{-- INFO --}}
    <div class="flex flex-col justify-between text-base  max-w-24 w-full h-full col-span-4 py-1 pt-2">
        <p class="font-bold leading-none max-h-4  overflow-hidden whitespace-nowrap text-ellipsis ">
            Hamburguesa

        </p>
        <p class="leading-none max-h-4  overflow-hidden whitespace-nowrap text-ellipsis">10.99€</p>
    </div>

    <div class="flex flex-col justify-between w-full h-full col-span-3">

        {{-- DELETE ICON--}}
        <div class="flex items-center  gap-2  ">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-auto">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>


        </div>

        {{-- QUANTITY--}}
        <div class="flex justify-between items-center ">


            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>



            <p class="flex items-center justify-center v leading-none w-4 text-lg text-center tabular-nums">
                99
            </p>


            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>


        </div>
    </div>

</div>
