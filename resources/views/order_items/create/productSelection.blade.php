<x-layout>
    <h2 class="card-header">Add products to order</h2>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('order_items.index') }}"><i class="fa fa-arrow-left"></i>Go back</a>
    </div>
    <div id="app">
        <product-selection />
    </div>
</x-layout>
