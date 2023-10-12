<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request,$id){
        if (Auth::check()){
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
            if (!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'created_at' => Carbon::now()
                ]);

                return response()->json(['success'=>'Successfully Product Add to Wishlist']);
            }else{
                return response()->json(['error'=>'This Product is Already in your Wishlist']);
            }
        }else{
            return response()->json(['error'=>'At First Login In your Account']);
        }
    }


    public function WishlistPage(){
        return view('frontend.wishlist.wishlist_page');
    }

    public function loadWishlist(){
       $all_wish = Wishlist::with('product')->where('user_id',Auth::id())->get();
       return json_encode($all_wish);
    }


    public function removeProWish($id){
        $delete_wish = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
        $delete_wish->delete();

        return response()->json(['success'=>'Successfully Product Remove From Your Wishlist']);
    }












}
