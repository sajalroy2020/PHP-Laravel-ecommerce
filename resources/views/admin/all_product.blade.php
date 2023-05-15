@extends('admin.layouts.templeate')

@section('content')
    <h1 class="h3 mb-3"><strong>All Product</strong></h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <div class="row">
        <div class="col-12  d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-0 text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="d-none d-xl-table-cell">Product Name</th>
                            <th class="d-none d-xl-table-cell">Product short description</th>
                            <th class="d-none d-md-table-cell">Product long description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Sub-category</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products_all as $key => $products)
                        <tr>
                            <td class="d-none d-xl-table-cell">{{$key+1}}</td>
                            <td class="d-none d-xl-table-cell">{{$products->product_name}}</td>
                            <td class="d-none d-xl-table-cell">{{$products->product_short_des}}</td>
                            <td class="d-none d-xl-table-cell">{{$products->product_long_des}}</td>
                            <td class="d-none d-xl-table-cell">{{$products->price}}</td>
                            <td class="d-none d-xl-table-cell">{{$products->product_category_name}}</td>
                            <td class="d-none d-xl-table-cell">{{$products->product_subcategory_name}}</td>
                            <td class="d-none d-md-table-cell">
                                <img width="40" height="50px" src="{{ asset('storage/images/products/'.$products->product_img)}}" alt="">
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a class="btn btn-primary" href="{{route('editProduct', $products->id)}}">Edit</a>
                                <a class="btn btn-danger" href="">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
