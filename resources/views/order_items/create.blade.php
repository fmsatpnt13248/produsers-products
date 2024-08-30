<x-layout>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('order_items.index') }}"><i class="fa fa-arrow-left"></i>Go back</a>
    </div>
    <div id="app">
        @if($errors->any())
            <label class="alert alert-danger">{{$errors->first()}}</label>
        @endif
        <product-selection />
    </div>
</x-layout>
