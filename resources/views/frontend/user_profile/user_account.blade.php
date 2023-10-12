@extends('frontend.main_master')
@section('main')
    @section('title')
        User Dashboard
    @endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                                        <a class="nav-link" href="{{ route('user.dashboard') }}" ><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
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
                                        <a class="nav-link active" href="{{ route('user.account') }}" ><i class="fi-rs-user mr-10"></i>Account details</a>
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


                                <div id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">

                                            <form action="{{ route('user.account.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Full Name <span class="required">*</span></label>
                                                        <input required="" value="{{ $user_data->name }}" class="form-control" name="name" type="text" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>User Name <span class="required">*</span></label>
                                                        <input required="" value="{{ $user_data->username }}" class="form-control" name="username" type="text" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" value="{{ $user_data->email }}" class="form-control" name="email" type="text" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Address <span class="required">*</span></label>
                                                        <input required="" value="{{ $user_data->address }}" class="form-control" name="address" type="text" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Phone <span class="required">*</span></label>
                                                        <input required="" value="{{ $user_data->phone }}" class="form-control" name="phone" type="text" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Photo <span class="required">*</span></label>
                                                        <input name="old_photo" value="{{ $user_data->photo }}" type="hidden">
                                                        <input class="form-control-file" name="photo" type="file" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <img style="width: 200px; height: 200px;" id="img" src="{{ URL::to('') }}/uploads/user/{{ $user_data->photo }}" alt="">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
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

    <script>
        $(document).ready(function (){
            $(document).on('change','input[name="photo"]',function (e){
                let url = URL.createObjectURL(e.target.files['0']);
                $('img#img').attr('src',url).width('200px').height('200px');
            });
        })
    </script>

@endsection
