
@extends('admin.layouts.templeate')

@section('content')
    <h1 class="h3 mb-3"><strong>Update Product</strong></h1>
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
                    <form action="{{route('productUpdate', $editProduct->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label>Product Name</label>
                        <input type="text" value="{{$editProduct->product_name}}" class="form-control py-4 mb-3" name="product_name" placeholder="product name">

                        <label>Product short description</label>
                        <textarea class="form-control mb-3" name="product_short_des" rows="2" placeholder="description">{{$editProduct->product_short_des}}</textarea>

                        <label>Product long description</label>
                        <textarea class="form-control mb-3" name="product_long_des" rows="2" placeholder="description">{{$editProduct->product_long_des}}</textarea>

                        <label>Price</label>
                        <input value="{{$editProduct->price}}" type="number" class="form-control py-4 mb-3" name="price" placeholder="price">

                        <label>Product Image</label>
                        <img width="150" height="150px" src="{{ asset('storage/images/products/'.$editProduct->product_img) }}" alt="">
                        <input type="file" class="form-control py-4 mb-3" name="product_img" placeholder="image">

                        <button class="btn btn-primary mt-2 py-2 px-4" type="submit"><strong>Update</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
