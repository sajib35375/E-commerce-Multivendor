<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function productSearch(Request $request){
        $text = $request->search;
        $search_item = Product::where('product_name','LIKE',"%$text%")->get();
        $categories = Category::latest()->get();

        return view('frontend.search.product_search',compact('search_item','text','categories'));
    }

    public function productSearchSuggestion(Request $request){
        $search_text = $request->search;

        $search_item = Product::where('product_name','LIKE',"%$search_text%")->select('product_name','product_slug','actual_price','product_thumbnail','id')->limit(5)->get();

        return view('frontend.search.search_item_load',compact('search_item'));
    }
}
