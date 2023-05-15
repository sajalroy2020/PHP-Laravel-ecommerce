@extends('admin.layouts.templeate')

@section('content')
    <h1 class="h3 mb-3"><strong>Edit</strong> Sub-Category</h1>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    @error('subCatName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <form action="{{route('subCategoryUpdate', $editSubCatData->id)}}" method="post">
                        @csrf
                        <label>Sub-Category Name</label>
                        <input type="text" value="{{$editSubCatData->subCatName}}" class="form-control py-4" name="subCatName">
                        <button class="btn btn-primary mt-2 py-2 px-4" type="submit"><strong>Update</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
