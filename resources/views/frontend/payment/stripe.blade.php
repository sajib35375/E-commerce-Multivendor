@extends('frontend.main_master')
@section('main')
@section('title')
    Strip Payment Gateway
@endsection
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Stripe
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
                            <form action="{{ route('stripe.store') }}" method="post" id="payment-form">
                                @csrf
                                <div class="form-row">
                                    <label for="card-element">
                                        Credit or debit card
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

                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
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


    <style>
        /**
* The CSS shown here will not be introduced in the Quickstart guide, but shows
* how you can use CSS to style your Element's container.
*/
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;}
    </style>


        <script type="text/javascript">
            // Create a Stripe client.
            var stripe = Stripe('pk_test_51NWmWiDNCSRcOc2vWuuDY7AOnNvyH2kLSaulvpAE177IleMiOhYaQvKhkUbJlIVWa5YUQQc8I8w9qLTfiQn7lijF00JHXMrCnl');
            // Create an instance of Elements.
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
            base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
        }
        },
            invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };
            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});
            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
            });
            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
            });
            });
            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
    </script>


@endsection
