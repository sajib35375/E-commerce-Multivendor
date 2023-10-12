<?php

namespace App\Http\Controllers;

use App\Models\MultiImg;
use App\Models\Product;
use Illuminate\Http\Request;

class QuickViewController extends Controller
{
    public function QuickLoad($id){
        $product = Product::with('brand','category','vendor')->where('status',1)->find($id);

        $color_0 = $product->product_color;
        $color = explode(',',$color_0);
        $size_0 = $product->product_size;
        $size = explode(',',$size_0);

        $img = MultiImg::where('product_id',$id)->get();

        return response()->json(array(
            'product' => $product,
            'color' => $color,
            'size' => $size,
            'photo' => $img
        ));
    }
}
