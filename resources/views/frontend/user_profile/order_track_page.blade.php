@extends('frontend.main_master')
@section('main')
    @section('title')
        User Order Tracking
    @endsection

    <style>
        body{font-family: 'Open Sans',serif}.card{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem}.card-header:first-child{border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0}.card-header{padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)}.track{position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px}.track .step{-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative}.track .step.active:before{background: #FF5722}.track .step::before{height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px}.track .step.active .icon{background: #ee5435;color: #fff}.track .icon{display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd}.track .step.active .text{font-weight: 400;color: #000}.track .text{display: block;margin-top: 7px}.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}.itemside .aside{position: relative;-ms-flex-negative: 0;flex-shrink: 0}.img-sm{width: 80px;height: 80px;padding: 7px}ul.row, ul.row-sm{list-style: none;padding: 0}.itemside .info{padding-left: 15px;padding-right: 7px}.itemside .title{display: block;margin-bottom: 5px;color: #212529}p{margin-top: 0;margin-bottom: 1rem}.btn-warning{color: #ffffff;background-color: #ee5435;border-color: #ee5435;border-radius: 1px}.btn-warning:hover{color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px}
    </style>


    <div class="container">
        <article class="card">
            <header class="card-header"> My Orders / Tracking </header>
            <div class="card-body">
                <h6>Invoice Number: {{ $track->invoice_number }}</h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Order Date:</strong> <br>{{ date('D, F Y',strtotime($track->order_date)) }}</div>
                        <div class="col"> <strong>Order BY:</strong> <br> {{ $track->name }}, | <i class="fa fa-phone"></i> {{ $track->phone }} </div>
                        <div class="col"> <strong>Payment Method:</strong> <br> {{ $track->payment_method }} </div>
                        <div class="col"> <strong>Total Amount:</strong> <br> {{ $track->amount }} BDT</div>
                    </div>
                </article>
                <div class="track">
                    @if($track->status == 'pending')
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Pending Order</span> </div>
                        <div class="step"> <span class="icon"><i class="fa fa-check"></i>  </span> <span class="text"> Confirm Order</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></span> <span class="text">Delivered</span> </div>
                        @elseif($track->status == 'confirm')
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Pending Order</span> </div>
                        <div class="step active"> <span class="icon"><i class="fa fa-check"></i>  </span> <span class="text"> Confirm Order</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></span> <span class="text">Delivered</span> </div>
                    @elseif($track->status == 'processing')
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Pending Order</span> </div>
                        <div class="step active"> <span class="icon"><i class="fa fa-check"></i> </span> <span class="text"> Confirm Order</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></span> <span class="text">Delivered</span> </div>
                    @elseif($track->status == 'delivered')
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i></span> <span class="text">Pending Order</span> </div>
                        <div class="step active"> <span class="icon"><i class="fa fa-check"></i>  </span> <span class="text"> Confirm Order</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></span> <span class="text">Delivered</span> </div>
                    @endif
                </div>
                <hr>


                <a href="{{ route('order.track') }}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
            </div>
        </article>
    </div>










@endsection
