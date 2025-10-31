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
            <label for="price">Quantity :</label><br>
            <input type="number" step="0.01" name="quantity" id="quantity" value="{{ old('quantity') }}">
            @error('quantity')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="expiration_date">Expiration Date:</label><br>
            <input type="date" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}">
            @error('expiration_date') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="status">Status:</label><br>
            <select name="status" id="status">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <button type="submit">Save</button>
        <a href="{{ route('products.index') }}">Cancel</a>
    </form>
</x-layout>
