@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px; margin-right: 10px;margin-left: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Permission</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.permission',$edit_data->id) }}" method="POST">
                            @csrf

                            <div class="my-3">
                                <label for="">Permission Name</label>
                                <input name="name" value="{{ $edit_data->name }}" class="form-control" type="text">

                            </div>

                            <div class="my-3">
                                <label for="">Group Name</label>
                                <select class="form-control" name="group_name" id="">
                                    <option value="">-Select-</option>
                                    <option {{ $edit_data->group_name == 'Brand' ? 'selected' : '' }} value="Brand">Brand</option>
                                    <option {{ $edit_data->group_name == 'Category' ? 'selected' : '' }} value="Category">Category</option>
                                    <option {{ $edit_data->group_name == 'SubCategory' ? 'selected' : '' }} value="SubCategory">SubCategory</option>
                                    <option {{ $edit_data->group_name == 'Slider' ? 'selected' : '' }} value="Slider">Slider</option>
                                    <option {{ $edit_data->group_name == 'Banner' ? 'selected' : '' }} value="Banner">Banner</option>
                                    <option {{ $edit_data->group_name == 'Product' ? 'selected' : '' }} value="Product">Product</option>
                                    <option {{ $edit_data->group_name == 'Coupon' ? 'selected' : '' }} value="Coupon">Coupon</option>
                                    <option {{ $edit_data->group_name == 'Vendor' ? 'selected' : '' }} value="Vendor">Vendor</option>
                                    <option {{ $edit_data->group_name == 'Shipping' ? 'selected' : '' }} value="Shipping">Shipping</option>
                                    <option {{ $edit_data->group_name == 'Order' ? 'selected' : '' }} value="Order">Order</option>
                                    <option {{ $edit_data->group_name == 'Return' ? 'selected' : '' }} value="Return">Return Order</option>
                                    <option {{ $edit_data->group_name == 'Stock' ? 'selected' : '' }} value="Stock">Manage Stock</option>
                                    <option {{ $edit_data->group_name == 'Reports' ? 'selected' : '' }} value="Reports">Reports</option>
                                    <option {{ $edit_data->group_name == 'User' ? 'selected' : '' }} value="User">User</option>
                                    <option {{ $edit_data->group_name == 'Blog' ? 'selected' : '' }} value="Blog">Blog</option>
                                    <option {{ $edit_data->group_name == 'Review' ? 'selected' : '' }} value="Review">Review</option>
                                    <option {{ $edit_data->group_name == 'Setting' ? 'selected' : '' }} value="Setting">Setting</option>
                                    <option {{ $edit_data->group_name == 'Permission' ? 'selected' : '' }} value="Permission">Permission</option>
                                    <option {{ $edit_data->group_name == 'Area' ? 'selected' : '' }} value="Area">Area</option>
                                    <option {{ $edit_data->group_name == 'Ads' ? 'selected' : '' }} value="Ads">Ads</option>

                                </select>

                            </div>

                            <div class="my-3">
                                <input class="btn btn-primary" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
