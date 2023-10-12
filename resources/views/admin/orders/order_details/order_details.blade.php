@extends('admin.admin_dashboard')
@section('admin')


  <div class="wrap" style="margin-top: 80px; margin-left: 20px; margin-right: 20px;">
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
                      <hr>
                      @if($order->status == 'pending')
                      <a class="btn btn-primary" href="{{ route('order.confirm',$order->id) }}">Confirm</a>
                      @elseif($order->status == 'confirm')
                          <a class="btn btn-primary" href="{{ route('order.processing',$order->id) }}">Proccessing</a>
                      @elseif($order->status == 'processing')
                          <a class="btn btn-primary" href="{{ route('status.delivered',$order->id) }}">Delivered</a>
                      @endif
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


  </div>

@endsection
