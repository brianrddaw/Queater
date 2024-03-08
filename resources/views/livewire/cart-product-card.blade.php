<div class="flex items-center rounded-r-lg rounded-l-full  min-h-12 h-12 pr-4  bg-orange-50 text-orange-950">
    <img class="w-12 h-12  mr-4 object-fit border-2 border-orange-500 bg-orange-950 rounded-full object-fit " src="{{ asset('imgs/burguer.webp') }}" alt="">


    <div class="flex flex-col justify-between  text-base  max-w-24 w-full h-full pt-2 pb-1">
        <p class="font-bold leading-none max-h-4  overflow-hidden whitespace-nowrap text-ellipsis">{{ $order->product_id }}</p>
        <p class="leading-none max-h-4  overflow-hidden whitespace-nowrap text-ellipsis">{{ $order->state }} €</p>
    </div>


    <div class="flex justify-between items-center ml-auto gap-2">


        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>



        <p class="flex items-center justify-center v leading-none w-4 text-xl text-center tabular-nums">{{ $order->quantity }}</p>


        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>


    </div>

</div>
