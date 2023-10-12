@extends('vendor.vendor_dashboard')
@section('vendor')

    <div class="wrap" style="margin-top: 80px;margin-right: 30px;margin-left: 30px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Vendor Review</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Vendor Name</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td><img style="width: 70px;height: 70px;" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product->product_thumbnail }}" alt=""></td>
                                    <td>{{ $item->vendor_id ? $item->vendor->name : 'Owner' }}</td>
                                    <td>{{ $item->comment }}</td>
                                    <td>
                                        @if($item->quality==1)
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        @elseif($item->quality==2)
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        @elseif($item->quality==3)
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        @elseif($item->quality==4)
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        @elseif($item->quality==5)
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                            <i style="color: red;" class="fa fa-star"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 0)
                                            <span class="badge bg-danger">InActive</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Vendor Name</th>
                                <th>Comment</th>
                                <th>Rating</th>
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
