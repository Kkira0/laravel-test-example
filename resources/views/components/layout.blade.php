<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Products App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased p-6 bg-gray-100">
    <nav class="mb-6">
        <a href="{{ route('products.index') }}">Products</a> |
        <a href="{{ route('products.create') }}">Add Product</a>
    </nav>
    <main>
        {{ $slot }}
    </main>
</body>
</html>
