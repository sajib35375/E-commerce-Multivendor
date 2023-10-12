<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Division;
use App\Models\Product;
use App\Models\State;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request,$id){
        if (Cache::has('coupon')){
            Cache::forget('coupon');
        }

        $product = Product::find($id);

        if ($product->product_qty > 0 && $request->quantity <= $product->product_qty) {
            Cart::add([
                'id' => $id,
                'name' => $request->name,
                'qty' => $request->quantity,
                'price' => $product->actual_price,
                'weight' => 1,
                'options' => [
                    'size' => $request->size,
                    'color' => $request->color,
                    'photo' => $product->product_thumbnail,
                    'vendor_id' => $request->vendor_id,
                ]]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }else{
            return response()->json(['error' => 'Add to cart not possible']);
        }
    }

    public function addToMiniCart(){
        $carts = Cart::content();
        $cart_total = Cart::total();
        $cart_qty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cart_total' => $cart_total,
            'cart_qty' => $cart_qty
        ));
    }


    public function removeMiniCart($rowId){
        Cart::remove($rowId);

        return response()->json(['success' => 'Successfully product remove from MiniCart']);
    }

    public function AddToCartSingle(Request $request){
        if (Cache::has('coupon')){
            Cache::forget('coupon');
        }
        $id = $request->id;
        $product = Product::find($id);

        if ($product->product_qty > 0 && $request->quantity <= $product->product_qty) {
            Cart::add([
                'id' => $id,
                'name' => $request->name,
                'qty' => $request->quantity,
                'price' => $product->actual_price,
                'weight' => 1,
                'options' => [
                    'size' => $request->size,
                    'color' => $request->color,
                    'photo' => $product->product_thumbnail,
                    'vendor_id' => $request->vendor_id,
                ]]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }else{
            return response()->json(['error' => 'Add to cart not possible']);
        }
    }


    public function cartPage(){
        $divisions = Division::all();
        $districts = District::all();
        $states = State::all();
        return view('frontend.cart.cart_page',compact('divisions','districts','states'));
    }


    public function cartPageLoad(){
        $carts = Cart::content();
        $subtotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json([
            'carts' => $carts,
            'subtotal' => $subtotal,
            'cartQty' => $cartQty,
        ]);
    }

    public function cartDecrement($rowId){

        $dataGet = Cart::get($rowId);
        Cart::update($rowId,$dataGet->qty-1);
        if (Cache::has('coupon')){
            $coupon_name = cache()->get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
            Cache::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_validity' => $coupon->coupon_validity,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $coupon->coupon_discount*Cart::total()/100,
                'total_amount' => round(Cart::total() - $coupon->coupon_discount*Cart::total()/100)
            ]);
        }

        return response()->json(['success' => 'Cart Decremented Successfully']);
    }

    public function cartIncrement($rowId){

        $data = Cart::get($rowId);
        Cart::update($rowId,$data->qty + 1);
        if (Cache::has('coupon')){
            $coupon_name = cache()->get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
            Cache::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_validity' => $coupon->coupon_validity,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $coupon->coupon_discount*Cart::total()/100,
                'total_amount' => round(Cart::total() - $coupon->coupon_discount*Cart::total()/100)
            ]);
        }
        return response()->json(['success' => 'Cart Incremented Successfully']);
    }

    public function cartRemove($rowId){
        Cart::remove($rowId);
        if (Cache::has('coupon')){
            $coupon_name = cache()->get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
            Cache::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_validity' => $coupon->coupon_validity,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $coupon->coupon_discount*Cart::total()/100,
                'total_amount' => round(Cart::total() - $coupon->coupon_discount*Cart::total()/100)
            ]);
        }

        return response()->json(['success' => 'Cart Remove Successfully']);
    }

    public function couponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now())->first();

        if ($coupon){
            Cache::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_validity' => $coupon->coupon_validity,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $coupon->coupon_discount*Cart::total()/100,
                'total_amount' => round(Cart::total() - $coupon->coupon_discount*Cart::total()/100)
            ]);
            return response()->json(['success' => 'Coupon Applied Successfully']);
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function cartDistrictSelect($id){
            // Cache::forget('charge');
        Cache::put('division_id',$id);
        $districts = District::where('division_id',$id)->get();
        return response()->json($districts);
    }

    public function cartStateSelect($id){
        Cache::put('district_id',$id);
        $states = State::where('district_id',$id)->get();
        return response()->json($states);
    }


    public function cartChargeSelect($id){
        Cache::put('state_id',$id);
        $state_charge = State::find($id);
        Cache::put('charge',$state_charge->delivery_charge);
        return response()->json($state_charge);
    }

    public function cartPageCal(Request $request){
        if (!Cache::has('coupon')){
            return response()->json([
                'total' => Cart::total(),
                'delivery_charge' => Cache::get('charge')
            ]);
        }else{
            return response()->json([
                'coupon_name' => cache()->get('coupon')['coupon_name'],
                'discount_percent' => cache()->get('coupon')['coupon_discount'],
                'discount_total' => cache()->get('coupon')['discount_amount'],
                'grand_total' => cache()->get('coupon')['total_amount'],
                'delivery_charge' => Cache::get('charge'),
                'amount' => Cart::total(),
            ]);
        }
    }

    public function couponRemove(){
        Cache::forget('coupon');
        return response()->json(['success' => 'Coupon Successfully Removed']);
    }









}
