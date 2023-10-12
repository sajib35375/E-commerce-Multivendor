@extends('vendor.vendor_dashboard')
@section('vendor')


    <div class="wrap" style="margin-top: 80px; margin-left: 15px; margin-right: 15px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Vendor Product</h2>
                        <a style="float: right;" class="btn btn-primary" href="{{ route('vendor.add.product') }}">Add New Product</a>
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
                                <th>Vendor Charge</th>
                                <th>Total Price</th>
                                <th>Actual Price</th>
                                <th>Product Image</th>
                                <th>Status</th>
                                <th width="20%">Action</th>
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
                                    <td> @if($item->product_discount_price) {{ $item->product_discount_price }} ৳ @else {{ $item->product_selling_price }} ৳ @endif </td>
                                    <td>@if($item->product_discount_price) {{ round($discount_percentage) }}% @else <span class="badge bg-danger">No Discount</span>@endif</td>
                                    <td>{{ $item->product_qty }}</td>
                                    <td>{{ $item->vendor_charge }} </td>
                                    <td> @if($item->product_discount_price) {{ $item->product_discount_price+$item->vendor_charge }} ৳ @else {{ $item->product_selling_price+$item->vendor_charge }} ৳ @endif </td>
                                    <td>{{ $item->actual_price }} ৳</td>
                                    <td><img style="width: 50px;height: 50px;" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt=""></td>
                                    <td>
                                        @if($item->status==1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('vendor.pro.edit',$item->id) }}"><i class="fa fa-pencil"></i></a>
                                        <a id="delete" class="btn btn-danger" href="{{ route('vendor.pro.delete',$item->id) }}"><i class="fa fa-trash"></i></a>
                                        <a class="btn btn-warning" href="{{ route('vendor.product.details',$item->id) }}"><i class="fa fa-eye"></i></a>
                                        @if($item->status==1)
                                            <a class="btn btn-primary" href="{{ route('vendor.product.inactive',$item->id) }}"><i class="fa fa-thumbs-down"></i></a>
                                        @else
                                            <a class="btn btn-primary" href="{{ route('vendor.product.active',$item->id) }}"><i class="fa fa-thumbs-up"></i></a>
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
                                <th>Vendor Charge</th>
                                <th>Total Price</th>
                                <th>Actual Price</th>
                                <th>Product Image</th>
                                <th>Status</th>
                                <th width="20%">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>










@endsection
