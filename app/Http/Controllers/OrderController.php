<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('products')->where('user_id', auth()->id())->latest()->get();
        return view('orders',compact('orders'));

    }

    public function show($id){
     $order =  Order::with('products')->where('user_id', auth()->id())->findOrFail($id);
     return view('orders_detail',compact('order'));
    }
}
