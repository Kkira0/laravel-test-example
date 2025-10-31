<x-layout title="Add Product">
    <h1>Add New Product</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Name:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price">Price (€):</label><br>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}">
            @error('price')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Save</button>
        <a href="{{ route('products.index') }}">Cancel</a>
    </form>
</x-layout>
