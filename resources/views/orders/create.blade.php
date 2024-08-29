<x-layout>
    <div class="card mt-5">
        <h2 class="card-header">Place a new order</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('orders.index') }}"><i class="fa fa-arrow-left"></i>Go back</a>
            </div>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="inputStatus" class="form-label"><strong>Status:</strong></label>
                    <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" id="inputStatus" placeholder="Status">
                    @error('status')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>
</x-layout>
