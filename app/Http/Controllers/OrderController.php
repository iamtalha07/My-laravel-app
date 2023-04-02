<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request){
        $orderDetails = [
            'user_id' => Auth::user()->id,
            'customer_name' => $request->customer_name,
            'contact' => $request->contact,
            'address' => $request->address,
        ];
        Order::create($orderDetails);
        Point::where('user_id',Auth::user()->id)->increment('points', 100);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function fetchAllOrder(){
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('orders',[
            'orders' => $orders
        ]);
    }
}
