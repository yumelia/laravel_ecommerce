<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Order;
class OrderController extends Controller
{
     public function index()
    {
        $orders = Order::with('user')->latest()->get();

        $tittle = 'Hapus Pesanan!';
        $text = 'Apakah anda yakin ingin menghapus pesanan ini?';
        confirmDelete($tittle, $text);

        return view('backend.order.index', compact('orders'));
    }

      public function show($id)
    {
        $order = Order::with('user','products')->findOrfail($id);
        return view('backend.order.show', compact('order'));
    }

     public function destroy( $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        toast('Pesanan  berhasil dihapus', 'success');
        return redirect()->route('backend.orders.index');
    }

     public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,success,cancel',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        toast('Status order berhasil diperbarui', 'success');
        return redirect()->route('backend.orders.show');
    }

}
