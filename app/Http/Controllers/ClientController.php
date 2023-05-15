<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function AddCartProduct(Request $request){

        $userID = Auth::user()->id;
        $quantity = $request->quantity;
        $price = $request->product_price;
        $product_price = $price*$quantity;

        Cart::insert([
            'product_id'=> $request->product_id,
            'user_id'=> $userID,
            'product_price'=> $product_price,
            'quantity'=> $request->quantity,
        ]);
        return redirect()->route('cartProduct')->with('message', 'add to cart successfully');
    }

    public function CartProduct(){
        $data['cartProducts'] = Cart::where('user_id', Auth::user()->id)->get();
        return view('cart', $data);
    }

    public function CartRemove($id){
        Cart::findOrFail($id)->delete();
        return redirect()->route('cartProduct')->with('message', 'cart remove successfully');
    }

    public function SheepingAddressAdd(){
        return view('sheepingAddress');
    }

    public function ShippingStore(Request $request){
        $request->validate([
            'address'=>'required',
            'phone'=>'required',
            'zipCode'=>'required',
        ]);
        $userID = Auth::user()->id;

        ShippingAddress::insert([
            'user_id'=> $userID,
            'address'=> $request->address,
            'phone'=> $request->phone,
            'zipCode'=> $request->zipCode,
        ]);
        return redirect()->route('checkOut')->with('message', 'Address added successfully');
    }

    public function CheckOut(){
        $data['shippingAddress'] = ShippingAddress::where('user_id', Auth::user()->id)->get();
        $data['cartProducts'] = Cart::where('user_id', Auth::user()->id)->get();
        return view('checkOut', $data);
    }

    public function CheckOutStore(){
        $userID = Auth::user()->id;
        $shippingAddress = ShippingAddress::where('user_id', $userID)->first();
        $cartProducts = Cart::where('user_id', $userID)->get();

        foreach ($cartProducts as $cartProduct) {
            Order::insert([
                'user_id' => $userID,
                'address' => $shippingAddress->address,
                'phone' => $shippingAddress->phone,
                'zip_code' => $shippingAddress->zipCode,
                'product_id' => $cartProduct->product_id,
                'quantity' => $cartProduct->quantity,
                'price' => $cartProduct->product_price,
            ]);
            $id = $cartProduct->id;
            Cart::find($id)->delete();
        }

        $ShippingAddressId = $shippingAddress->id;
        ShippingAddress::find($ShippingAddressId)->delete();

        return redirect()->route('orderPending')->with('message', 'Your Order has been placed');
    }

    public function OrderPending(){
        $userID = Auth::user()->id;
        $data['orderProducts'] = Order::where('user_id', $userID)->where('status', '0')->latest()->get();
        return view('pendingOrder', $data);
    }

    public function orderCompleate(){
        $userID = Auth::user()->id;
        $data['orderProducts'] = Order::where('user_id', $userID)->where('status', '1')->latest()->get();
        return view('compleateOrder', $data);
    }


}
