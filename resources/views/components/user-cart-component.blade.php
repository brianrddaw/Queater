<div class="user-cart fixed bottom-0 left-[10vw] w-[80vw] h-12 bg-orange-950 z-10 grid grid-cols-3 items-center justify-items-center rounded-t-3xl text-orange-50">

    <p class="leading-none font-bold text-md">{{ $price }}</p>

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 animate-bounce mt-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
    </svg>

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
    </svg>

</div>


<style>

    .user-cart::before{
        content: '';
        position: absolute;
        left: 0;
        bottom: 100%;
        background-image: linear-gradient(to top, white, transparent);
        width: 100%;
        height: calc(100%*2);
    }

</style>
