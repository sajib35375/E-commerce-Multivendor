@extends('admin.admin_dashboard')
@section('admin')

  <div class="wrap" style="margin-top: 80px;margin-right: 20px;margin-left: 20px;">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <a style="float: right;" class="btn btn-info" href="{{ route('add.coupon') }}">Add New Coupon</a>
                      <h2>All Coupon</h2>

                  </div>
                  <div class="card-body">
                      <table id="example" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              <th>#</th>
                              <th>Coupon Name</th>
                              <th>Coupon Discount</th>
                              <th>Coupon Validity</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($all_coupon as $item)
                          <tr>
                              <td>{{ $loop->index +1 }}</td>
                              <td>{{ $item->coupon_name }}</td>
                              <td>{{ $item->coupon_discount }}%</td>
                              <td>{{ date('D,d-m-Y', strtotime($item->coupon_validity)) }}</td>
                              <td>
                                  @if($item->coupon_validity >= \Carbon\Carbon::now())
                                      <span class="badge bg-success">Valid</span>
                                  @else
                                      <span class="badge bg-danger">Invalid</span>
                                  @endif
                              </td>
                              <td>
                                  <a class="btn btn-primary" href="{{ route('edit.coupon',$item->id) }}">Edit</a>
                                  <a id="delete" class="btn btn-danger" href="{{ route('delete.coupon',$item->id) }}">Delete</a>
                              </td>
                          </tr>
                          @endforeach

                          </tbody>
                          <tfoot>
                              <th>#</th>
                              <th>Coupon Name</th>
                              <th>Coupon Discount</th>
                              <th>Coupon Validity</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tfoot>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>




@endsection
