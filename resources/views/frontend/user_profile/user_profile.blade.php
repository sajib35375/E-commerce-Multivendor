@extends('frontend.main_master')
@section('main')
    @section('title')
        User Dashboard
    @endsection
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('user.dashboard') }}" ><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ route('user.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ route('user.all.return.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Return Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('order.track') }}" ><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.address') }}" ><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.account') }}" ><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.change.password') }}" ><i class="fi-rs-user mr-10"></i>Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Hello {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                                manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
