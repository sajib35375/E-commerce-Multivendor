<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\State;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CheckoutController extends Controller
{
    public function checkoutPage(){
        if (Auth::check()){
            if ( Cart::total() > 0 ){
                if(Cache::get('charge')){
                    $total = Cart::total();
                    $cartCount = Cart::count();
                    $carts = Cart::content();

                    $divisions = Division::all();
                    $districts = District::all();
                    $states = State::all();

                    $user = User::find(Auth::id());
                    return view('frontend.checkout.checkout',compact('total','user','cartCount','carts','divisions','districts','states'));
                }else{
                    return redirect()->back()->with('error','You need to select shipping address as well as Delivery charge');
                }

            }else{
                return redirect()->to('/')->with('error','At List One Product You have to Purchase');
            }

        }else{
            return redirect()->route('login')->with('error','At First Login in Your Account');
        }
    }



    public function paymentGateway(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['division_id'] = $request->division_id;
        $data['phone'] = $request->phone;
        $data['district_id'] = $request->district_id;
        $data['post_code'] = $request->post_code;
        $data['state_id'] = $request->state_id;
        $data['address'] = $request->address;
        $data['notes'] = $request->additional_information;
        $total = Cart::total();

        $divisions = Division::orderBy('division_name', 'ASC')->get();
        $districts = District::orderBy('district_name', 'ASC')->get();
        $states = State::orderBy('state_name', 'ASC')->get();

        $cart_total = Cart::content();
        $cartTotal = Cart::priceTotal();
        $CartsQTY = Cart::count();
        $ship_charge = Cache::get('charge');

        if ($request->payment_option == 'stripe'){
            return view('frontend.payment.stripe',compact('data','total'));
        }elseif ($request->payment_option == 'cash'){
            return view('frontend.payment.cash',compact('data','total'));
        }else{
            return view('frontend.payment.ssl',compact('data','total','divisions','districts','states','cart_total','cartTotal','CartsQTY','ship_charge'));
        }
    }
















}

