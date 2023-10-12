@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px; margin-left: 15px; margin-right: 15px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Product Stock</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Color</th>
                                <th>Product Size</th>
                                <th>Product Price</th>
                                <th>Product Discount Percentage</th>
                                <th>Product Quantity</th>
                                <th>Product Image</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $item)
                                @php

                                    $discount_amount = $item->product_selling_price - $item->product_discount_price;
                                    $discount_percentage = $discount_amount/$item->product_selling_price*100;

                                @endphp
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_color }}</td>
                                    <td>{{ $item->product_size }}</td>
                                    <td> @if($item->product_discount_price) {{ $item->product_discount_price }} ৳ @else {{ $item->product_selling_price }} ৳ @endif</td>
                                    <td> @if($item->product_discount_price) {{ round($discount_percentage) }}% @else <span class="badge bg-danger">No Discount</span> @endif</td>
                                    <td>{{ $item->product_qty }}</td>
                                    <td><img style="width: 50px;height: 50px;" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt=""></td>
                                    <td>
                                        @if($item->status==1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                </tr>

                            @endforeach


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Color</th>
                                <th>Product Size</th>
                                <th>Product Price</th>
                                <th>Product Discount Percentage</th>
                                <th>Product Quantity</th>
                                <th>Product Image</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>









@endsection
