<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
        ->where('user_id', auth()->id())
        ->get();

        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request, $id)
    {
        if (! Auth::check()) {
            // jika belum Login, redirect dengan alert
            toast('Silahkan login terlebih dahulu untuk menambahkan ke keranjang.', 'error');
            return redirect('/login');
        }

        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('product_id', Auth::id())
        ->where('product_id', $id)
        ->first();

        if ($cart) {
            $cart->increment('qty', $request->qty);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'qty' => $request->qty,
            ]);
        }
        toast('Produl berhasil ditambahkan ke keranjang.', 'success');
        return back();
    }

    public function updateCart(Request $request, $id)
    {
        $cartItems = Cart::findOrFail($id);

        $request->validate([
            'qty' => 'required|integer|min:1|max:' . $cartItems->product->stock,            
        ]);

        $cartItems->qty = $request->qty;
        $cartItems->save();

        toast('Jumlah berhasil diperbarui.', 'success');
        return redirect()-route('cart.index');
    }

    public function remove($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cart->delete();
        toast('Produk berhasil dihapus dari keranjang', 'success');
        return redirect()->route('cart.index');
    }
    
    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) {
            toast('Keranjang kosong. Tidak bisa checkout.', 'warning');
            return redirect()->route('cart.index');
        }

        // hitung total harga
        $totak = $cartItems->sum(function ($item) {
            return $item->qty * $item->product->price;
        });

        // simpan order
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $cartItems->sum('total');
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $total,
            'status' => 'pending',
        ]);
    }
}
