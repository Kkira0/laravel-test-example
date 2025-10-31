<x-layout :title="'Edit ' . $product->name">
    <h1>Edit Product</h1>

    <x-flash-success />
    <x-flash-errors />

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error('name') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="quantity">Quantity:</label><br>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}">
            @error('quantity') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
            @error('description') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="expiration_date">Expiration Date:</label><br>
            <input type="date" name="expiration_date" id="expiration_date" value="{{ old('expiration_date', $product->expiration_date) }}">
            @error('expiration_date') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="status">Status:</label><br>
            <select name="status" id="status">
                <option value="1" {{ old('status', $product->status) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $product->status) === 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('products.index') }}">Cancel</a>
    </form>
</x-layout>
