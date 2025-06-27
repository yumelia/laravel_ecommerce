@extends ('layouts.frontend')

@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb__title">
                    <h1>My Orders</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="color__blue">Orders</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- orders_section_strat -->
 <div class="cartarea sp_top_100 sp_buttom_100">
    <div class="container">
        <h4 class="mb-4">Order History</h4>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="the-dark bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Order Code</th>
                        <th>Total Price</th> 
                        <th>Status</th>   
                        <th>Date</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->order_code }}</td>
                        <td>Rp {{ number_format($order->total_price,0,',','.') }}</td>
                        <td>
                            @if ($order->status == 'pending')
                            <span class="bagde bg-warning text-dark">Pending</span>
                            @elseif ($order->status == 'success')
                            <span class="bagde bg-success">Succes</span>
                            @else
                            <span class="bagde bg-danger">Canceled</span>
                        </td>
                        <td>{{ $order->created_ad->format('d M Y') }}</td>
                        <td><a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-primary">
                            View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No orders yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
 </div>
 <!-- order_section_end -->
@endsection