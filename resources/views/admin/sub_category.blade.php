@extends('admin.layouts.templeate')

@section('content')
    <h1 class="h3 mb-3"><strong>Sub-Category</strong></h1>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">

                    @error('subCatName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('catId')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <form action="{{route('subCategoryStore')}}" method="post">
                        @csrf
                        <label>Sub Category Name</label>
                        <input type="text" class="form-control py-3 mb-3" name="subCatName" placeholder="Sub Category name">

                        <label>Select Category</label>
                        <select class="form-select mb-3 py-2" name="catId" id="catId">
                            <option>Select Category menu</option>
                            @foreach ($categorys as $category)
                                <option value="{{$category->id}}">{{$category->catName}}</option>
                            @endforeach
                          </select>
                        <button class="btn btn-primary mt-2 py-2 px-4" type="submit"><strong>save</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
