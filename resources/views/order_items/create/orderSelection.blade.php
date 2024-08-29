<x-layout>
    <div class="card mt-5">
        <h2 class="card-header">Add products to order</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('orders.index') }}"><i class="fa fa-arrow-left"></i>Go back</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('order_items.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $id }}">

                <div class="form-group">
                    <label for="order_id">Order ID:</label>
                    <input type="text" name="order_id" id="order_id" required>
                </div>

                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" id="amount" required>
                </div>

                <button type="submit" class="btn btn-success">Add to Order</button>
            </form>

        </div>
    </div>
</x-layout>
