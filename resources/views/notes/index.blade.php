<x-layout>
    <div class="card mt-5">
        <div class="card-body">

            <table class="table table-bordered table-striped mt-4">
                <thead>
                <tr>
                    <th width="80px">ID</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th width="250px">Actions</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($notes as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td>{{ $note->name }}</td>
                        <td>{{ $note->detail }}</td>
                        <td>
                            <div style="display: flex">
                                <a class="btn btn-primary" href="{{ route('notes.edit',$note->id) }}">Edit</a>

                                <form action="{{ route('notes.destroy',$note->id) }}" method="POST">
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
                <a class="btn btn-success btn-sm" href="{{ route('notes.create') }}"> <i class="fa fa-plus"></i>Add a new note</a>
            </div>

        </div>
    </div>
</x-layout>

