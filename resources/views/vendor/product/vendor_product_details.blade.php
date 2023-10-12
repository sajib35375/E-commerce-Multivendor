@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px;margin-right: 30px;margin-left: 30px;">
        <div class="row">
            <h2>Product Details</h2>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Product Name</th>
                                <th>{{ $product->product_name }}</th>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <th>{{ $product->brand->name }}</th>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <th>{{ $product->category->name }}</th>
                            </tr>
                            <tr>
                                <th>Sub Category</th>
                                <th>{{ $product->subcategory->sub_name }}</th>
                            </tr>
                            <tr>
                                <th>Vendor</th>
                                <th>{{ $product->vendor_id ? $product->vendor->name : '' }}</th>
                            </tr>
                            <tr>
                                <th>Product Tags</th>
                                <th>{{ $product->product_tags }}</th>
                            </tr>
                            <tr>
                                <th>Product Code</th>
                                <th>{{ $product->product_code }}</th>
                            </tr>
                            <tr>
                                <th>Product Vendor Charge</th>
                                <th>{{ $product->vendor_charge }}</th>
                            </tr>
                            <tr>
                                <th>Product Short Description</th>
                                <th>{{ \Illuminate\Support\Str::of($product->short_desc) }}</th>
                            </tr>
                            <tr>
                                <th>Product Long Description</th>
                                <th>{!! \Illuminate\Support\Str::of($product->long_desc) !!}</th>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Product Name</th>
                                <th>{{ $product->product_name }}</th>
                            </tr>
                            <tr>
                                <th>Product Quantity</th>
                                <th>{{ $product->product_qty }}</th>
                            </tr>
                            <tr>
                                <th>Product Size</th>
                                <th>{{ $product->product_size }}</th>
                            </tr>
                            <tr>
                                <th>Product Color</th>
                                <th>{{ $product->product_color }}</th>
                            </tr>
                            <tr>
                                <th>Product Selling Price</th>
                                <th>{{ $product->product_selling_price }} ৳</th>
                            </tr>
                            @if($product->product_discount_price)
                                <tr>
                                    <th>Product Discount Price</th>
                                    <th>{{ $product->product_discount_price }} ৳</th>
                                </tr>
                            @endif
                            <tr>
                                <th>Product Actual Price</th>
                                <th>{{ $product->actual_price  }} ৳</th>
                            </tr>
                            <tr>
                                <th>Product Thumbnail</th>
                                <th><img style="height: 50px;width: 50px;" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $product->product_thumbnail  }}" alt=""></th>
                            </tr>
                            <tr>
                                <th>Product Hover Image</th>
                                <th><img style="height: 50px;width: 50px;" src="{{ URL::to('') }}/uploads/products/hover/{{ $product->hover_image }}" alt=""></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>








@endsection
