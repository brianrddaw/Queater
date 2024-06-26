<div class="slider-container sticky top-0 flex items-center justify-between  w-full h-20  z-10 overflow-x-scroll pl-2 bg-stone-100">
    <div class="absolute flex gap-4 p-2">
        @foreach ($productsByCategory as $category => $products)
            <a href="#{{ $category }}" class="category text-orange-950 select-none font-semibold py-2 px-2 rounded cursor-pointer bg-stone-200 hover:bg-slate-800 hover:text-orange-50 uppercase transition-all">{{ $category }}</a>
        @endforeach
        <span>
        </span>
    </div>
</div>
