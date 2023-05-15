<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function PendingOrder(){
        $data['orderProducts'] = Order::where('status', '0')->latest()->get();
        return view('admin.orderPending', $data);
    }

    public function CompleateOrder(){
        $data['orderProducts'] = Order::where('status', '1')->latest()->get();
        return view('admin.orderCompleate', $data);
    }

    public function CompleatedOrderStatus( $id ){
        Order::where('id', $id)->update(['status'=>'1']);
        return redirect()->route('compleateOrder')->with('message', 'Order compleated successfully');
    }
}
