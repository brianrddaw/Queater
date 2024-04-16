<div class="slider-container sticky top-0 flex items-center justify-between min-w-full w-full h-16 bg-orange-200 z-10  overflow-x-scroll pl-2">
    <div class="absolute flex gap-4">
        @foreach ($productsByCategory as $category => $products)
            <a href="#{{ $category }}" class="category text-orange-950 select-none font-semibold py-2 px-2 rounded cursor-pointer hover:bg-orange-100 hover:text-orange-950 uppercase">{{ $category }}</a>
        @endforeach
        <span>
        </span>
    </div>
</div>


<style>
    .category:nth-child(even):hover {
        background-color: #FFEAC1;
    }
</style>
