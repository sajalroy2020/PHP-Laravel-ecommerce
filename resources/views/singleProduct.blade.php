@extends('layouts.userLayouts')

@section('content')
<div class="container">
    {{-- <h1 class="fashion_taital pt-5">Single Product</h1> --}}
    <div class=" pb-5 mt-5">
       <div class="row">
          <div class="col-lg-4 col-sm-4">
             <div class="box_main">
                <div class="electronic_img"><img src="{{ asset('storage/images/products/'.$product->product_img)}}"></div>
             </div>
          </div>
          <div class="col-lg-8 col-sm-4">
            <div class="box_main">
               <h4 class="shirt_text text-left pb-3">{{$product->product_name}}</h4>
               <p class="price_text text-left"> Price:  <span style="color: #262626; font-size: 26px">$ {{$product->price}}</span></p>
               <p class="ml-0">{{$product->product_short_des}}</p>
               <p class="ml-0">{{$product->product_long_des}}</p>
               <form action="{{route('addCartProduct')}}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="product_price" value="{{$product->price}}">
                    <label>How many pitch</label>
                    <input style="width: 50px;" type="number" min="1" value="1" name="quantity">
                    <input type="submit" value="Add cart" class="btn btn-success" >
               </form>
            </div>
          </div>
       </div>
    </div>
 </div>


 <div class="fashion_section pt-5">
    <div id="main_slider" class="carousel slide" data-ride="carousel">
       <div class="container">
           <h1 class="fashion_taital">Related Products</h1>
           <div class="fashion_section_2">
           <div class="row">

               @foreach ($relatedProducts as $relatedProduct)
                   <div class="col-lg-4 col-sm-4">
                       <div class="box_main">
                           <h4 class="shirt_text">{{$relatedProduct->product_name}}</h4>
                           <p class="price_text">Price  <span style="color: #262626;">$ {{$relatedProduct->price}}</span></p>
                           <div class="tshirt_img"><img src="{{ asset('storage/images/products/'.$relatedProduct->product_img)}}"></div>
                           <div class="btn_main">
                           <div class="buy_bt"><a href="#">Buy Now</a></div>
                           <div class="seemore_bt"><a href="{{route('singleProduct',[$relatedProduct->id, $relatedProduct->slug])}}">See More</a></div>
                           </div>
                       </div>
                   </div>
               @endforeach

           </div>
           </div>
       </div>

    </div>
 </div>
@endsection
