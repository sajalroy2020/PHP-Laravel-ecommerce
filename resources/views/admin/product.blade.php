@extends('admin.layouts.templeate')

@section('content')
    <h1 class="h3 mb-3"><strong>Add Product</strong></h1>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('productStore')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label>Product Name</label>
                        <input type="text" class="form-control py-4 mb-3" name="product_name" placeholder="product name">

                        <label>Product short description</label>
                        <textarea class="form-control mb-3" name="product_short_des" rows="2" placeholder="description"></textarea>

                        <label>Product long description</label>
                        <textarea class="form-control mb-3" name="product_long_des" rows="2" placeholder="description"></textarea>

                        <label>Price</label>
                        <input type="number" class="form-control py-4 mb-3" name="price" placeholder="price">

                        <label>Selecet Category</label>
                        <select class="form-select mb-3 py-3" name="product_category_id" id="product_category_id">
                            <option>Select Category menu</option>
                            @foreach ($categorys as $category)
                                <option value="{{$category->id}}">{{$category->catName}}</option>
                            @endforeach
                          </select>

                        <label>Selecet Sub-category</label>
                        <select class="form-select mb-3 py-3" name="product_subcategory_id" id="product_subcategory_id">
                            <option>Select Sub Category menu</option>
                            @foreach ($subCategorys as $subCategory)
                                <option value="{{$subCategory->id}}">{{$subCategory->subCatName}}</option>
                            @endforeach
                          </select>

                        <label>Product Image</label>
                        <input type="file" class="form-control py-4 mb-3" name="product_img" placeholder="image">

                        <button class="btn btn-primary mt-2 py-2 px-4" type="submit"><strong>Save</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
