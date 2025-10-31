<x-layout title="All Products">
    <h1>All Products</h1>
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('products.show', $product) }}">
                    {{ $product->name }} – gabali {{ number_format($product->quantity) }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
