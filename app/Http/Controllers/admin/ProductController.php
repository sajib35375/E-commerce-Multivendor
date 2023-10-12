<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    public function allProduct(){
        $products = Product::latest()->get();
        return view('admin.product.all_product',compact('products'));
    }

    public function addNewProduct(){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('admin.product.add_new_product',compact('brands','categories','activeVendor'));
    }

    public function selectSubcategory($category_id){
        $sub_cat = SubCategory::where('category_id',$category_id)->latest()->get();
        return json_encode($sub_cat);
    }

    public function productStore(Request $request){
        if ($request->hasFile('product_thumbnail')){
            $image = $request->file('product_thumbnail');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600,600)->save('uploads/products/thumbnail/'.$unique_name);
        }

        if ($request->hasFile('hover_image')){
            $image = $request->file('hover_image');
            $image_hover = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600,600)->save('uploads/products/hover/'.$image_hover);
        }

        $discount_price = NULL;
        if ($request->vendor_id){
            if ($request->product_discount_price){
                $charge = $request->product_discount_price*10/100;
                $discount_price = $request->product_discount_price;
                $selling_price = $request->product_selling_price;
            }else if(!$request->product_discount_price){
                $charge = $request->product_selling_price*10/100;
                $selling_price = $request->product_selling_price;
            }
        }else{
            $discount_price = $request->product_discount_price;
            $selling_price = $request->product_selling_price;
            $charge = NULL;
        }


        if ($request->vendor_id){
            if ($request->product_discount_price){
                $charge = $request->product_discount_price*10/100;
                $price = $request->product_discount_price + $charge;
            }else if(!$request->product_discount_price){
                $charge = $request->product_selling_price*10/100;
                $price = $request->product_selling_price + $charge;
            }
        }else{
            if ($request->product_discount_price){
                $price = $request->product_discount_price;
            }else{
                $price = $request->product_selling_price;
            }

        }

        if ($request->product_qty == '' || $request->product_qty== 0){
            $product_qty = 0;
        }else{
            $product_qty = $request->product_qty;
        }


        $product_id = Product::insertGetId([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'vendor_id' => $request->vendor_id,
                'vendor_charge' => $charge,
                'product_name' => $request->product_name,
                'product_slug' => Str::slug($request->product_name),
                'product_tags' => $request->product_tags,
                'product_code' => $request->product_code,
                'product_qty' => $product_qty,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'product_selling_price' => $selling_price,
                'product_discount_price' => $discount_price,
                'actual_price' => $price,
                'product_thumbnail' => $unique_name,
                'hover_image' => $image_hover,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'hot_deals' => $request->hot_deals,
                'special_offers' => $request->special_offers,
                'special_deals' => $request->special_deals,
                'recently_added' => $request->recently_added,
                'featured' => $request->featured,
                'status' => 1,
                'created_at' => Carbon::now()
        ]);
        $multi = $request->file('multi_img');

        foreach ($multi as $item){
            $unique_multi = hexdec(uniqid()).'.'.$item->getClientOriginalExtension();
            Image::make($item)->resize(1100,1100)->save('uploads/products/multi/'.$unique_multi);

            MultiImg::insert([
               'product_id' => $product_id,
               'photo' => $unique_multi,
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->route('all.product')->with('message','Product Inserted Successfully');
    }


    public function productInactive($id){
        $inactiveData = Product::find($id);
        $inactiveData->status = 0;
        $inactiveData->update();

        return redirect()->back()->with('warning','Product Inactivate Successfully');
    }


    public function productActive($id){
        $activeData = Product::find($id);
        $activeData->status = 1;
        $activeData->update();

        return redirect()->back()->with('message','Product Activate Successfully');
    }


    public function productEdit($id){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $edit_product = Product::findOrFail($id);
        $multiImg = MultiImg::where('product_id',$id)->get();
        return view('admin.product.product_edit',compact('brands','multiImg','subcategories','categories','activeVendor','edit_product'));
    }


    public function productUpdate(Request $request,$id){
        $update = Product::findOrFail($id);

        if ($request->hasFile('product_thumbnail')){
            $image = $request->file('product_thumbnail');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600,600)->save('uploads/products/thumbnail/'.$unique_name);
            @unlink('uploads/products/thumbnail/'.$request->old_thumbnail);
        }else{
            $unique_name = $request->old_thumbnail;
        }

        if ($request->hasFile('hover_image')){
            $image = $request->file('hover_image');
            $unique_hover = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600,600)->save('uploads/products/hover/'.$unique_hover);
            @unlink('uploads/products/hover/'.$request->old_hover);
        }else{
            $unique_hover = $request->old_hover;
        }

        $discount_price = NULL;
        if ($request->vendor_id){
            if ($request->product_discount_price){
                $charge = $request->product_discount_price*10/100;
                $discount_price = $request->product_discount_price;
                $selling_price = $request->product_selling_price;
            }else if(!$request->product_discount_price){
                $charge = $request->product_selling_price*10/100;
                $selling_price = $request->product_selling_price;
            }
        }else{
            $discount_price = $request->product_discount_price;
            $selling_price = $request->product_selling_price;
            $charge = NULL;
        }

        if ($request->vendor_id){
            if ($request->product_discount_price){
                $charge = $request->product_discount_price*10/100;
                $price = $request->product_discount_price + $charge;
            }else if(!$request->product_discount_price){
                $charge = $request->product_selling_price*10/100;
                $price = $request->product_selling_price + $charge;
            }
        }else{
            if ($request->product_discount_price){
                $price = $request->product_discount_price;
            }else{
                $price = $request->product_selling_price;
            }

        }

        if ($request->product_qty == '' || $request->product_qty== 0){
            $product_qty = 0;
        }else{
            $product_qty = $request->product_qty;
        }


        $update->product_name = $request->product_name;
        $update->product_selling_price = $selling_price;
        $update->actual_price = $price;
        $update->product_discount_price = $discount_price;
        $update->product_tags = $request->product_tags;
        $update->product_color = $request->product_color;
        $update->product_size = $request->product_size;
        $update->short_desc = $request->short_desc;
        $update->long_desc = $request->long_desc;
        $update->product_thumbnail = $unique_name;
        $update->hover_image = $unique_hover;
        $update->product_code = $request->product_code;
        $update->product_qty = $product_qty;
        $update->brand_id = $request->brand_id;
        $update->category_id = $request->category_id;
        $update->subcategory_id = $request->subcategory_id;
        $update->vendor_id = $request->vendor_id;
        $update->vendor_charge = $charge;
        $update->hot_deals = $request->hot_deals;
        $update->special_offers = $request->special_offers;
        $update->special_deals = $request->special_deals;
        $update->recently_added = $request->recently_added;
        $update->featured = $request->featured;
        $update->updated_at = Carbon::now();
        $update->update();


        return redirect()->route('all.product')->with('message','Product Updated Successfully');
    }


    public function multiUpdate(Request $request){
        $all_img = $request->multi_img;

        foreach ($all_img as $id => $img ){
                $unique_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(600,600)->save('uploads/products/multi/'.$unique_name);

                $update = MultiImg::findOrFail($id);

                @unlink('uploads/products/multi/'.$update->photo);
                $update->photo = $unique_name;
                $update->updated_at = Carbon::now();
                $update->update();
        }
        return redirect()->back()->with('message','Product Multi Image Updated Successfully');

    }


    public function multiImgDelete($id){
        $delete = MultiImg::find($id);
        $delete->delete();
        @unlink('uploads/products/multi/'.$delete->photo);
        return redirect()->back()->with('warning','Product Multi Image Deleted Successfully');
    }

    public function productDelete($id){
        $multiImages = MultiImg::where('product_id',$id)->get();
        foreach($multiImages as $img){
            @unlink('uploads/products/multi/'.$img->photo);
        }
        $delete = Product::find($id);
        $delete->delete();
        @unlink('uploads/products/thumbnail/'.$delete->product_thumbnail);
        return redirect()->back()->with('warning','Product Deleted Successfully');
    }

    public function singleProductDetails($id){
        $product = Product::with('brand','category','subcategory','vendor')->find($id);
        return view('admin.product.product_details',compact('product'));
    }

    public function productStock(){
        $products = Product::latest()->get();
        return view('admin.stock.product_stock',compact('products'));
    }

}
