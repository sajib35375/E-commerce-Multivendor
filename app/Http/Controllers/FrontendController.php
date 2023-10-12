<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $banners = Banner::all();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $sliders = Slider::latest()->get();
        $products = Product::with('vendor','category')->where('status',1)->latest()->paginate(10);
        $featured = Product::with('vendor','category')->where('status',1)->where('featured',1)->latest()->get();
        $hot_deals = Product::with('vendor','category')->where('status',1)->where('hot_deals',1)->latest()->limit(4)->get();
        $special_offers = Product::with('vendor','category')->where('status',1)->where('special_offers',1)->latest()->limit(4)->get();
        $special_deals = Product::with('vendor','category')->where('status',1)->where('special_deals',1)->latest()->limit(4)->get();
        $recently_added = Product::with('vendor','category')->where('status',1)->where('recently_added',1)->latest()->limit(4)->get();
        $vendors = User::where('status','active')->where('role','vendor')->latest()->limit(4)->get();
        return view('frontend.index',compact('hot_deals','recently_added','vendors','special_deals','special_offers','banners','categories','sliders','products','featured','brands'));
    }

    public function ProductDetails($id,$slug){
        $details = Product::with('category','subcategory','brand','vendor')->find($id);
        $multiImg = MultiImg::where('product_id',$id)->get();
        return view('frontend.product.product_details',compact('details','multiImg'));
    }

    public function VendorDetails($id){
        $vendor = User::find($id);
        $products = Product::where('status',1)->where('vendor_id',$id)->latest()->get();
        $categories = Category::latest()->get();
        return view('frontend.vendor.vendor_details',compact('vendor','products','categories'));
    }


    public function VendorPriceFilter(Request $request,$id){
        $max_price = $request->price_range;
        $products = Product::where('status',1)->where('vendor_id',$id)->where('actual_price','>=',0)->where('actual_price','<=',$max_price)->latest()->get();
        $vendor = User::find($id);
        $categories = Category::latest()->get();
       return view('frontend.vendor.vendor_search_page',compact('products','vendor','categories'));

    }



    public function VendorCategoryFilter($id,$vendor_id){
        $category = Category::find($id);
        $vendor = User::find($vendor_id);
        $products = Product::where('status',1)->where('vendor_id',$vendor_id)->where('category_id',$id)->latest()->get();
        $categories = Category::latest()->get();
        return view('frontend.vendor.vendor_category_search',compact('products','vendor','categories','category'));
    }


    public function VendorShopPage(){
        $vendors = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('frontend.vendor.vendor_shop',compact('vendors'));
    }


    public function VendorSearchAllPage(Request $request){
        $search_text = $request->vendor_search;
        $all_data = User::where('name','like','%'.$search_text.'%')->get();
        return view('frontend.vendor.all_vendor_search',compact('all_data'));
    }


    public function categoryProducts($id){
        $all_cat_pro = Product::with('vendor')->where('status',1)->where('category_id',$id)->latest()->paginate(40);
        $cat = Category::find($id);
        $categories = Category::latest()->get();
        return view('frontend.product.category_product',compact('all_cat_pro','cat','categories'));
    }

    public function categoryPriceFilter(Request $request,$id){
        $max_price = $request->price_range;
        $all_cat_pro = Product::where('status',1)->where('category_id',$id)->where('actual_price','>=',0)->where('actual_price','<=',$max_price)->latest()->get();
        $categories = Category::latest()->get();
        $cat = Category::find($id);
        return view('frontend.product.category_price_filter',compact('all_cat_pro','categories','cat'));

    }

    public function subcategoryProducts($id){
        $all_sub_cat_pro = Product::with('vendor')->where('status',1)->where('subcategory_id',$id)->latest()->paginate(40);
        $subcat = SubCategory::with('category')->find($id);
        $subcategories = SubCategory::latest()->limit(6)->get();
        return view('frontend.product.subcategory_products',compact('all_sub_cat_pro','subcat','subcategories'));
    }


    public function subcategoryPriceFilter(Request $request,$id){
        $search_price = $request->price_range;
        $sub_cat_pro = Product::where('status',1)->where('subcategory_id',$id)->where('actual_price','>=',0)->where('actual_price','<=',$search_price)->latest()->get();
        $subcat = SubCategory::with('category')->find($id);
        $subcategories = SubCategory::latest()->limit(6)->get();
        return view('frontend.product.subcategory_price_filter',compact('sub_cat_pro','subcat','subcategories'));
    }


    public function allBrandProduct($id){
        $brand = Brand::find($id);
        $products = Product::where('status',1)->where('brand_id',$id)->latest()->get();
        $brands = Brand::latest()->get();
        return view('frontend.brand.all_brand_product',compact('brand','products','brands'));
    }

    public function brandPriceFilter(Request $request,$id){
        $max_price = $request->price_range;
        $brands = Brand::latest()->get();
        $brand = Brand::find($id);
        $products = Product::where('status',1)->where('actual_price','>=',0)->where('actual_price','<=',$max_price)->where('brand_id',$id)->latest()->get();
        return view('frontend.brand.brand_price_filter',compact('max_price','brands','brand','products'));
    }

    public function blogPage(){
        $categories = BlogCategory::latest()->get();
        $posts = BlogPost::latest()->get();
        return view('frontend.blog.blog',compact('posts','categories'));
    }

    public function blogDetails($id){
        $categories = BlogCategory::latest()->get();

        $details = BlogPost::find($id);
        $details->views = $details->views + 1;
        $details->update();

        return view('frontend.blog.blog_details',compact('details','categories'));
    }

    public function catWiseBlogPost($id){
        $categories = BlogCategory::latest()->get();
        $category = BlogCategory::find($id);
        $posts = BlogPost::where('blog_category_id',$id)->latest()->get();
        return view('frontend.blog.blog_category',compact('posts','categories','category'));
    }








}
