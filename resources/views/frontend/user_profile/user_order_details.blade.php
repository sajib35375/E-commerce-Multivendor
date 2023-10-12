@extends('frontend.main_master')
@section('main')
    @section('title')
        User Dashboard
    @endsection
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.dashboard') }}" ><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ route('user.all.return.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Return Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('order.track') }}" ><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.address') }}" ><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.account') }}" ><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.change.password') }}" ><i class="fi-rs-user mr-10"></i>Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>Shipping Details</h2>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <th>Shipping Name</th>
                                                    <th>{{ $order->name }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Shipping Email</th>
                                                    <th>{{ $order->email }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Post Phone</th>
                                                    <th>{{ $order->phone }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Post Code</th>
                                                    <th>{{ $order->post_code }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>{{ $order->order_date }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Division</th>
                                                    <th>{{ $order->division->division_name }}</th>
                                                </tr>
                                                <tr>
                                                    <th>District</th>
                                                    <th>{{ $order->district->district_name }}</th>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <th>{{ $order->state->state_name }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Delivery Charge</th>
                                                    <th>{{ $order->state->delivery_charge }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <th>{{ $order->address }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Notes</th>
                                                    <th>{{ $order->notes }}</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>Order Details</h2>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>{{ $order->user->name }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>{{ $order->user->email }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <th>{{ $order->user->phone }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>{{ $order->transaction_id }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Invoice Number</th>
                                                    <th>{{ $order->invoice_number }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Order Number</th>
                                                    <th>{{ $order->order_number }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Payment Method</th>
                                                    <th>{{ $order->payment_method }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Amount</th>
                                                    <th>{{ $order->amount }} ৳</th>
                                                </tr>
                                                <tr>
                                                    <th>Order Status</th>
                                                    <th><span class="badge badge-pill bg-success">{{ $order->status }}</span></th>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>All Purchase Item</h2>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Vendor Name</th>
                                                    <th>Product Image</th>
                                                    <th>Product Color</th>
                                                    <th>Product Size</th>
                                                    <th>Product Price</th>
                                                    <th>Product Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order_items as $item)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $item->product->product_name }}</td>
                                                        <td>{{ $item->vendor_id ? $item->vendor->name : 'Owner' }}</td>
                                                        <td><img style="width: 60px;height: 60px;" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product->product_thumbnail }}" alt=""></td>
                                                        <td>{{ $item->color }}</td>
                                                        <td>{{ $item->size }}</td>
                                                        <td>{{ $item->price }} ৳</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->price * $item->quantity }} ৳</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if( $order->status=='delivered' )
                            <div class="row">
                                <div class="col-md-12">
                                    @if($order->return_reason!=NULL)
                                        <span class="text-danger">Return Request Already send</span>
                                        @else
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Return Option</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('return.order',$order->id) }}" method="POST">
                                                @csrf
                                                <textarea class="form-control" name="return_reason" id="" cols="30" rows="10"></textarea>
                                                <button class="btn btn-sm btn-primary mt-3" type="submit">send</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @else
                           @endif

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
