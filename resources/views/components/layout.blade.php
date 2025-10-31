<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Products App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="layout">
    <header class="header">
        <h1>My Test Logo</h1>
    </header>

    <aside class="sidebar-left">
        <nav class="nav">
            <ul>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('products.create') }}">Add Product</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main">
        {{ $slot }}
    </main>

    <aside class="sidebar-right">
        <p>Reklāma: Šī ir test reklāma</p>
    </aside>

    <footer class="footer">
        <p>&copy; 2025 My Test Company</p>
    </footer>
</div>

</body>
</html>
