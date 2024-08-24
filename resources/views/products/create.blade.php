<x-layout>
    <div class="card mt-5">
        <h2 class="card-header">Add a new product</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i>Go back</a>
            </div>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="inputName" class="form-label"><strong>Name:</strong></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name">
                    @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputDetail" class="form-label"><strong>Detail:</strong></label>
                    <textarea class="form-control @error('detail') is-invalid @enderror" style="height:150px" name="detail" id="inputDetail" placeholder="Detail"></textarea>
                    @error('detail')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputPID" class="form-label"><strong>Producer ID:</strong></label>
                    <input type="number" name="producer_id" class="form-control @error('PID') is-invalid @enderror" id="inputPID" placeholder="Producer ID">
                    @error('PID')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputPrice" class="form-label"><strong>Price:</strong></label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="inputPrice" placeholder="Price">
                    @error('price')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputAmount" class="form-label"><strong>Amount:</strong></label>
                    <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" id="inputAmount" placeholder="Amount">
                    @error('amount')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>
</x-layout>
