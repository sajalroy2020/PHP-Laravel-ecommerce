@extends('layouts.userLayouts')

@section('content')
    <div class="container mt-5">
    <div class="mt-5 pt-5 text-center h2"><b>Pending Order</b></div>

       <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
            @endif
       </div>
       <div class="row">
        <div class="col-md-12">
            <table class="table table-hover my-0 text-center my-5">
                <thead class="bg-light">
                    <tr>
                        <th>#dd</th>
                        <th class="d-none d-xl-table-cell">Product Name</th>
                        <th>Image</th>
                        <th>User_id</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($orderProducts as $key => $product)
                        @php
                            $product_name = App\Models\Product::where('id', $product->product_id)->value('product_name');
                            $product_image = App\Models\Product::where('id', $product->product_id)->value('product_img');
                        @endphp
                            <tr>
                                <td class="d-none d-xl-table-cell">{{$key+1}}</td>
                                <td class="d-none d-xl-table-cell">{{$product_name}}</td>
                                <td class="d-none d-md-table-cell">
                                    <img width="40" height="50px" src="{{ asset('storage/images/products/'.$product_image)}}" alt="">
                                </td>
                                <td class="d-none d-md-table-cell">
                                    {{$product->user_id}}
                                </td>
                                <td class="d-none d-xl-table-cell">{{$product->quantity}}</td>
                                <td class="d-none d-xl-table-cell">{{$product->price}}</td>
                                <td class="d-none d-md-table-cell">
                                    <div class="btn btn-warning text-white">Pending</div>
                                </td>
                            </tr>

                        @empty
                        <tr>
                            <td colspan="7">No Data</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
       </div>
    </div>
@endsection
