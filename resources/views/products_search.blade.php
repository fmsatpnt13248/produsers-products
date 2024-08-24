<x-layout>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('producers.index') }}">Producers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('products.index') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('producers_search') }}">Search in "Producers"</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('products_search') }}">Search in "Products"</a>
            </li>
        </ul>
    </div>
    <div id="app">
        <products />
    </div>
</x-layout>
