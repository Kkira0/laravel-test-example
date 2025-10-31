<x-layout title="Product Details">
    <h1>{{ $product->name }}</h1>
    <p>Description: {{ $product->description }}</p>
    <p>Quantity: <span id="quantity">{{ $product->quantity }}</span></p>
    <p>Status: {{ $product->status ? 'Active' : 'Inactive' }}</p>
    <p>Expiration: {{ $product->expiration_date }}</p>

    <form action="{{ route('products.increase', $product) }}" method="POST" style="display:inline">
        @csrf
        @method('PATCH')
        <button type="submit">Increase Quantity</button>
    </form>

    <form action="{{ route('products.decrease', $product) }}" method="POST" style="display:inline">
        @csrf
        @method('PATCH')
        <button type="submit">Decrease Quantity</button>
    </form>

     <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
        @csrf
        @method('DELETE')
        <button type="submit" style="color:red;">Delete Product</button>
    </form>


    <a href="{{ route('products.index') }}">Back to list</a>
</x-layout>
