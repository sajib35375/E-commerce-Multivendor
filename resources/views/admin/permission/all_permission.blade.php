@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px; margin-right: 10px;margin-left: 10px">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h2>All Permission</h2>
                    </div>
                    <div class="card-body text-center">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->group_name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('edit.permission',$item->id) }}">Edit</a>
                                        <a id="delete" class="btn btn-danger" href="{{ route('delete.permission',$item->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h2>Add New Permission</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('store.permission') }}" method="POST">
                            @csrf

                            <div class="my-3">
                                <label for="">Permission Name</label>
                                <input name="name" class="form-control" type="text">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="">Group Name</label>
                                <select class="form-control" name="group_name" id="">
                                    <option selected="" value="">-Select-</option>
                                    <option value="Brand">Brand</option>
                                    <option value="Category">Category</option>
                                    <option value="SubCategory">SubCategory</option>
                                    <option value="Slider">Slider</option>
                                    <option value="Banner">Banner</option>
                                    <option value="Product">Product</option>
                                    <option value="Coupon">Coupon</option>
                                    <option value="Vendor">Vendor</option>
                                    <option value="Shipping">Shipping</option>
                                    <option value="Order">Order</option>
                                    <option value="Return">Return Order</option>
                                    <option value="Stock">Manage Stock</option>
                                    <option value="Reports">Reports</option>
                                    <option value="User">User</option>
                                    <option value="Blog">Blog</option>
                                    <option value="Review">Review</option>
                                    <option value="Setting">Setting</option>
                                    <option value="Permission">Permission</option>
                                    <option value="Area">Area</option>
                                    <option value="Ads">Ads</option>

                                </select>
                                @error('group_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
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
