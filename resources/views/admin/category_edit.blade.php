@extends('admin.layouts.templeate')

@section('content')
    <h1 class="h3 mb-3"><strong>Edit</strong> Category</h1>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    @error('catName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <form action="{{route('categoryUpdate', $categoryInfo->id)}}" method="post">
                        @csrf
                        <label>Category Name</label>
                        <input type="text" value="{{$categoryInfo->catName}}" class="form-control py-4" name="catName" placeholder="Category name">
                        <button class="btn btn-primary mt-2 py-2 px-4" type="submit"><strong>Update</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
