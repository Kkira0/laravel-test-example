<x-layout title="All Products">
    <h1>All Products</h1>
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('products.show', $product) }}">
                    {{ $product->name }} – €{{ number_format($product->price, 2) }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
