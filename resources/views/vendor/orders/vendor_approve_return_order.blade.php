@extends('vendor.vendor_dashboard')
@section('vendor')

    <div class="wrap" style="margin-top: 80px;margin-right: 20px;margin-left: 20px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Approve Return Order</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Invoice Number</th>
                                <th>Return Reason</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $item)

                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->amount }} BDT</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td>{{ $item->invoice_number }}</td>
                                    <td>{{ $item->return_reason }}</td>
                                    <td><span class="badge badge-pill bg-success">approve</span></td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('vendor.order.details',$item->id) }}">Details</a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Invoice Number</th>
                                <th>Return Reason</th>
                                <th>Status</th>
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
