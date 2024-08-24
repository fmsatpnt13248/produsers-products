<x-layout>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('producers.index') }}">Producers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('products.index') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('producers_search') }}">Search in "Producers"</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products_search') }}">Search in "Products"</a>
            </li>
        </ul>
    </div>

    <div class="card mt-5">
        <div class="card-body">

            <table class="table table-bordered table-striped mt-4">
                <thead>
                <tr>
                    <th style="width: 80px">ID</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Producer ID</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th style="width: 250px">Actions</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->detail }}</td>
                        <td>{{ $product->producer_id }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->amount }}</td>
                        <td>
                            <div style="display: flex">
                                <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>

                                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">The table is empty.</td>
                    </tr>
                @endforelse
                </tbody>

            </table>

            @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
            @endsession

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success btn-sm" href="{{ route('products.create') }}"> <i class="fa fa-plus"></i>Add a new product</a>
            </div>

        </div>
    </div>
</x-layout>

