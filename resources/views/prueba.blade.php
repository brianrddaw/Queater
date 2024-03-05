<h1>Prueba</h1>

<div>
    @foreach($products as $product)
        @if($product->availability)
            <p>{{ $product->name }} - Disponible</p>
            <form action="{{ route('comprar.producto', $product->id) }}" method="POST">
                @csrf
                <button type="submit">Comprar</button>
            </form>
        @else
            <p>{{ $product->name }} - No disponible</p>
        @endif
    @endforeach
</div>