<x-layout :title="'Edit ' . $product->name">
    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error('name')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price">Price (€):</label><br>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('products.index') }}">Cancel</a>
    </form>
</x-layout>
