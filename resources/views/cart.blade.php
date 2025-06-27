@extends('layouts.frontend')
@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb__title">
                    <h4>Cart</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="color_blue">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- cart-area start -->
<div class="cartarea sp_bottom_100 sp_top_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="cartarea__table__content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartItems as $item)
                            <tr>
                                <td class="cartarea__product__thumbnail">
                                    <a href="#">
                                        <img src="{{ Storage::url($item->product->image) }} "
                                             alt="{{ $item->product->name }}" width="80">
                                    </a>
                                </td>
                                <td class="cartarea__product__name">
                                    <a href="#">{{ $item->product->name }}</a>
                                </td>
                                <td class="cartarea__product_price__cart">
                                    <span class="amount">
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="cartarea__product__quantity">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <input type="number" name="qty" value="{{ $item->qty }}" 
                                                   max="{{ $item->product->stock }}" 
                                                   style="max-width: 70px;" 
                                                   class="form-control-sm">
                                            <button type="submit" class="btn btn-success btn-sm ml-2">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="cartarea__product__subtotal">
                                    Rp {{ number_format($item->qty * $item->product->price, 0, ',', '.') }}
                                </td>
                                <td class="cartarea__product__remove">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Keranjang masih kosong.</td>
                            </tr>
                            @endforelse

                            @php
                                $total = $cartItems->sum(fn($item) => $item->qty * $item->product->price);
                            @endphp

                            <tr class="text-center total">
                                <th colspan="5" class="text-center">Total</th>
                                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- checkout button -->
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="cartarea__shipping__update__wrapper">
                            <div class="cartarea__shipping__update">
                                <a class="default__-button" href="{{ route('cart.checkout') }}">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end checkout -->
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->

@endsection