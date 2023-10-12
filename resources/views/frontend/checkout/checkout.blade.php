@extends('frontend.main_master')
@section('main')
    @section('title')
        Checkout Page
    @endsection
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Checkout</h3>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are {{ $cartCount }} products in your cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">

                <div class="row">
                    <h4 class="mb-30">Billing Details</h4>
                    <form action="{{ route('payment.gateway') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input type="text" required="" name="name" placeholder="Name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="email" required="" placeholder="Email" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

{{--@dd($user->name)--}}

                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select name="division_id" class="form-control select-active">
                                        <option value="">Select Division</option>
                                        @foreach($divisions as $item)
                                        <option  {{ $item->id == \Illuminate\Support\Facades\Cache::get('division_id') ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->division_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input required="" type="text" placeholder="Phone" name="phone" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select class="form-control select-active" name="district_id">
                                        <option value="">Select an option...</option>
                                        @foreach($districts as $item)
                                            <option  {{ $item->id == \Illuminate\Support\Facades\Cache::get('district_id') ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->district_name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input required="" type="text" name="post_code" placeholder="Post Code">
                            </div>
                        </div>


                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select class="form-control select-active" name="state_id">
                                        <option value="">Select an option...</option>

                                        @foreach($states as $item)
                                            <option  {{ $item->id == \Illuminate\Support\Facades\Cache::get('state_id') ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->state_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input required="" placeholder="Address" type="text" name="address" value="{{ $user->address }}">
                            </div>
                        </div>





                        <div class="form-group mb-30">
                            <textarea name="additional_information" rows="5" placeholder="Additional information"></textarea>
                        </div>



                </div>
            </div>


            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Subtotal</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">

                        {{--// products//--}}

                        <table class="table no-border">
                            <tbody>

                            @foreach($carts as $item)

                            <tr>
                                <td class="image product-thumbnail"><img src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->options->photo }}" alt="#"></td>
                                <td>
                                    <h6 class="w-160 mb-5"><a href="#" class="text-heading">{{ $item->name }}</a></h6></span>
                                    <div class="product-rate-cover">

                                        <strong>Color : <span class="text-danger">{{ $item->options->color }}</span></strong><br>
                                        <strong>Size : <span class="text-danger">{{ $item->options->size }}</span></strong>

                                    </div>
                                </td>
                                <td>
                                    <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                                </td>
                                <td>
                                    <h4 class="text-brand">{{ $item->price }} ৳</h4>
                                </td>
                            </tr>

                            @endforeach

                            </tbody>
                        </table>



                        {{--// accounts//--}}
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
                <div class="payment ml-30">
                    <h4 class="mb-30">Payment</h4>



                    <div class="payment_option">
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" value="stripe" name="payment_option" id="exampleRadios3" checked="">
                            <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Stripe</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" value="cash" name="payment_option" id="exampleRadios4" checked="">
                            <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" value="ssl" name="payment_option" id="exampleRadios5" checked="">
                            <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">SSL</label>
                        </div>

                    </div>
                    <div class="payment-logo d-flex">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-paypal.svg') }}" alt="">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}" alt="">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}" alt="">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/payment-zapper.svg') }}" alt="">
                    </div>



                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>



                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
