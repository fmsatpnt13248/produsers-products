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
                <a class="nav-link" aria-current="page" href="{{ route('orders.index') }}">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('order_items.index') }}">Order Items</a>
            </li>
        </ul>
    </div>
    <div id="app">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('order_items.create') }}"> <i class="fa fa-plus"></i>Add a product to an order</a>
        </div>
        <order-items />
    </div>
</x-layout>
