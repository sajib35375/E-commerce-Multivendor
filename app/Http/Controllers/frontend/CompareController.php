<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function compareView(){
        return view('frontend.compare.compare');
    }

    public function compareAdd($id){
        if (Auth::check()){

            $exists = Compare::where('user_id',Auth::id())->where('product_id',$id)->first();

            if (!$exists){
                Compare::insert([
                   'user_id' => Auth::id(),
                   'product_id' => $id,
                    'created_at' => Carbon::now()
                ]);

                return response()->json(['success' => 'Product Successfully Added to your compare list']);
            }else{
                return response()->json(['error' => 'Product already exists in your compare list']);
            }
        }else{
            return response()->json(['error' => 'At First login in your account']);
        }
    }


    public function compareShow(){
        $all_compare = Compare::with('product')->where('user_id',Auth::id())->get();
        return json_encode($all_compare);
    }


    public function compareRemove($id){
        $delete_compare = Compare::where('user_id',Auth::id())->where('product_id',$id)->first();
        $delete_compare->delete();

        return response()->json(['success' => 'Successfully Product Remove From Compare']);
    }






}
