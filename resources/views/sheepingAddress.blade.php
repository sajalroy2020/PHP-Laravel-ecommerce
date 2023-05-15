@extends('layouts.userLayouts')

@section('content')

<div class="container">
    <div class="mt-5 pt-5 text-center h2"><b>Add sheping address</b></div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="w-50 mx-auto mt-3">
        <form action="{{route('shippingStore')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Home address</label>
              <input type="text" class="form-control" name="address">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone number</label>
                <input type="text" class="form-control" name="phone">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Zip code</label>
                <input type="number" class="form-control" name="zipCode">
            </div>
            <div class="mb-4 d-flex flex-row-reverse">
                <button type="submit" class="btn btn-warning px-4">Next</button>
            </div>
        </form>
    </div>

</div>
@endsection
