@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px;margin-left: 30px;margin-right: 30px;">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>Coupon Edit</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.coupon',$editCoupon->id) }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label for="">Coupon Name</label>
                                <input name="coupon_name" value="{{ $editCoupon->coupon_name }}" class="form-control" type="text">
                                @error('coupon_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">Coupon Discount</label>
                                <input name="coupon_discount" value="{{ $editCoupon->coupon_discount }}" class="form-control" type="text">
                                @error('coupon_discount')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">Coupon Validity</label>
                                <input name="coupon_validity" value="{{ $editCoupon->coupon_validity }}" class="form-control" type="date">
                                @error('coupon_validity')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
