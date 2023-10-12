@extends('frontend.main_master')
@section('main')
    @section('title')
        Cash on Delivery
    @endsection
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Cash on Delivery
            </div>
        </div>
    </div>


    <div class="wrap" style="margin-top: 100px;margin-bottom: 100px; margin-left: 20px;margin-right: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Your Order Details</h4>
                            <table class="table no-border">
                                <tbody>

                                @if(\Illuminate\Support\Facades\Cache::has('coupon'))
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{ $total }} ৳</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupn Name</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h6 class="text-brand text-end">{{ cache()->get('coupon')['coupon_name'] }}</h6>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon Discount Amount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{ cache()->get('coupon')['discount_amount'] }} ৳</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Delivery Charge</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{ Cache::get('charge') }} ৳</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{ cache()->get('coupon')['total_amount'] + Cache::get('charge') }} ৳</h4>
                                        </td>
                                    </tr>

                                @else

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{ $total }} ৳</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Delivery Charge</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{ Cache::get('charge') }} ৳</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{ $total + Cache::get('charge') }} ৳</h4>
                                        </td>
                                    </tr>

                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('cash.store') }}" method="POST" id="payment-form">
                                @csrf
                                <div class="form-row">
                                    <label for="card-element">
                                        Cash on Delivery
                                        <input name="name" value="{{ $data['name'] }}" type="hidden">
                                        <input name="email" value="{{ $data['email'] }}" type="hidden">
                                        <input name="division_id" value="{{ $data['division_id'] }}" type="hidden">
                                        <input name="phone" value="{{ $data['phone'] }}" type="hidden">
                                        <input name="district_id" value="{{ $data['district_id'] }}" type="hidden">
                                        <input name="post_code" value="{{ $data['post_code'] }}" type="hidden">
                                        <input name="state_id" value="{{ $data['state_id'] }}" type="hidden">
                                        <input name="address" value="{{ $data['address'] }}" type="hidden">
                                        <input name="info" value="{{ $data['notes'] }}" type="hidden">

                                    </label>



                                </div>
                                <br>
                                <button class="btn btn-primary">Submit Payment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
