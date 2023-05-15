@extends('layouts.userLayouts')

@section('content')
    <div class="container mt-5">
    <div class="mt-5 pt-5 text-center h2"><b>Check out your all products & address</b></div>

       <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
            @endif
       </div>

       <div class="row">
        <div class="col-md-4">
            @foreach ($shippingAddress as $shippingAddres)
                <div class="card p-4 shadow-sm mt-4">
                    <h5><b>Address:-</b> {{$shippingAddres->address}}</h5>
                    <h5><b>Phone:-</b> {{$shippingAddres->phone}}</h5>
                    <h5><b>Zop code:-</b> {{$shippingAddres->zipCode}}</h5>
                </div>
            @endforeach
        </div>
        <div class="col-md-8">
            <table class="table table-hover my-0 text-center my-5">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>User_id</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @forelse ($cartProducts as $key => $product)
                            <tr>
                                <td class="d-none d-xl-table-cell">{{$key+1}}</td>

                                <td class="d-none d-md-table-cell">
                                    {{$product->user_id}}
                                </td>
                                <td class="d-none d-xl-table-cell">{{$product->quantity}}</td>
                                <td class="d-none d-xl-table-cell">{{$product->product_price}}</td>
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
        </div>
       </div>

       <div class="mb-4 d-flex flex-row-reverse">
        <form action="{{route('checkOutStore')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning px-4">Confirm order</button>
        </form>
    </div>

    </div>
@endsection
