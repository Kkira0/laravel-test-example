<x-layout :title="$product->name">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><strong>€{{ number_format($product->price, 2) }}</strong></p>

    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</x-layout>
