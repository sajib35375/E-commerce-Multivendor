@extends('frontend.main_master')
@section('main')
    @section('title')
       Cart Page
    @endsection
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand cart-count"></span> products in your cart</h6>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                <label class="form-check-label" for="exampleCheckbox11"></label>
                            </th>
                            <th scope="col" >Product Image</th>
                            <th >Product Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Color</th>
                            <th scope="col">Size</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col" class="end">Remove</th>
                        </tr>
                        </thead>
                        <tbody id="cart_product">


                        </tbody>
                    </table>
                </div>
                <hr>

                <div class="row mt-50">

                    <div class="col-lg-3">
                        <div class="p-40">
                            <h4 class="mb-10">Shipping</h4>
                            <div class="card">
                                <div class="card-body">
                                    <div class="my-3">
                                        <label for="">Division</label>
                                        <select class="form-control" name="division" id="">
                                            <option value="">-Select-</option>
                                            @foreach($divisions as $item)
                                            <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-3">
                                        <label for="">District</label>
                                        <select class="form-control" name="district" id="">
                                            <option value="">-Select-</option>
                                            @foreach($districts as $item)
                                                <option value="{{ $item->id }}">{{ $item->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-3">
                                        <label for="">State</label>
                                        <select class="form-control" name="state" id="">
                                            <option value="">-Select-</option>
                                            @foreach($states as $item)
                                                <option value="{{ $item->id }}">{{ $item->state_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-3">
                                        <label for="">Delivery Charge</label>
                                        <select class="form-control" name="delivery_charge" id="">
                                            <option value="">-Select-</option>
                                            @foreach($states as $item)
                                                <option value="{{ $item->id }}">{{ $item->delivery_charge }} ৳</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">

                            <div class="p-40">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</span> </p>
                                <form action="#">
                                    <div class="d-flex justify-content-between">
                                        <input class="font-medium mr-15 coupon" id="coupon_name" placeholder="Enter Your Coupon">
                                        <a  onclick="couponApply()" class="btn"><i class="fi-rs-label mr-10"></i>Apply</a>
                                    </div>
                                </form>
                            </div>

                    </div>


                    <div class="col-lg-5">
                        <div class="divider-2 mb-30"></div>
                        <h4 style="margin-left: 34px;" class="mb-10">Calculation</h4>


                        <div class="border p-md-4 cart-totals ml-30">

                            <div class="table-responsive">
                                <table class="table no-border">
                                    <tbody id="calculation">


                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('checkout.page') }}" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>


@endsection
