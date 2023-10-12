@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px;margin-left: 20px;margin-right: 20px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Inactive Vendor</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Vendor Shop Name</th>
                                <th>Vendor Username</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Vendor Join</th>
                                <th>Status</th>
                                <th>Photo</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($InactiveVendor as $vendor)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->username }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->address }}</td>
                                    <td>{{ $vendor->phone }}</td>
                                    <td>{{ $vendor->vendor_join }}</td>
                                    <td><span class="btn btn-secondary">{{ $vendor->status }}</span></td>
                                    <td><img style="width:100px; height: 100px;" src="{{ URL::to('') }}/AdminBackend/upload/admin/{{ $vendor->photo ? $vendor->photo : 'avatar.jpg' }}" alt=""></td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('vendor.inactive.details',$vendor->id) }}">Vendor Details</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Vendor Name</th>
                                <th>Vendor Username</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Vendor Join</th>
                                <th>Status</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>









@endsection
