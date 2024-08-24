<x-layout>
    <div class="card mt-5">
        <h2 class="card-header">Add a new producer</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('producers.index') }}"><i class="fa fa-arrow-left"></i>Go back</a>
            </div>

            <form action="{{ route('producers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="inputName" class="form-label"><strong>Name:</strong></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name">
                    @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputAddress" class="form-label"><strong>Address:</strong></label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="Address">
                    @error('address')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputContact" class="form-label"><strong>Contact:</strong></label>
                    <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror" id="inputContact" placeholder="Contact">
                    @error('contact')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>
</x-layout>
