@extends('layouts.userLayouts')

@section('content')

<div class="container">
    <div class="mt-5 pt-5 text-center h2"><b>Cart Product</b></div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
<table class="table table-hover my-0 text-center my-5">
    <thead class="bg-light">
        <tr>
            <th>#</th>
            <th class="d-none d-xl-table-cell">Product Name</th>
            <th>Image</th>
            <th>User_id</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @forelse ($cartProducts as $key => $product)
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
                    <td class="d-none d-xl-table-cell">{{$product->product_price}}</td>
                    <td class="d-none d-md-table-cell">
                        <a class="btn btn-danger" href="{{route('cartRemove', $product->id)}}">Remove</a>
                    </td>
                </tr>
                @php
                    $total = $total + $product->product_price
                @endphp
            @empty
            <tr>
                <td colspan="7">No Data</td>
            </tr>
        @endforelse
        <tr>
            <td class="d-none d-md-table-cell h4" colspan="7">Total Price: <b>{{$total}}</b></td>
        </tr>
    </tbody>
</table>
<div class="mb-5 d-flex flex-row-reverse">
    {{-- @if ($total + 1) --}}
        <a href="{{route('sheepingAddressAdd')}}" class="btn btn-warning px-4">Next</a>
    {{-- @endif --}}
</div>

</div>
@endsection
