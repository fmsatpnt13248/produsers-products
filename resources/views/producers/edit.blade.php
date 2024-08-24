<x-layout>
    <div class="card mt-5">
        <h2 class="card-header">Edit the producer</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('producers.index') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>

            <form action="{{ route('producers.update',$producer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="inputName" class="form-label"><strong>Name:</strong></label>
                    <input
                        type="text"
                        name="name"
                        value="{{ $producer->name }}"
                        class="form-control @error('name') is-invalid @enderror"
                        id="inputName"
                        placeholder="Name">
                    @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputAddress" class="form-label"><strong>Address:</strong></label>
                    <input
                        type="text"
                        name="address"
                        value="{{ $producer->address }}"
                        class="form-control @error('address') is-invalid @enderror"
                        id="inputAddress"
                        placeholder="Address">
                    @error('address')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputContact" class="form-label"><strong>Contact:</strong></label>
                    <input
                        type="text"
                        name="contact"
                        value="{{ $producer->contact }}"
                        class="form-control @error('contact') is-invalid @enderror"
                        id="inputContact"
                        placeholder="Contact">
                    @error('contact')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </form>

        </div>
    </div>
</x-layout>
