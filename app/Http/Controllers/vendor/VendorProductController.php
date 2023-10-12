<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;

class VendorProductController extends Controller
{
    public function vendorAllProduct(){
        $id = Auth::id();
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.product.vendor_product',compact('products'));
    }

    public function vendorAddProduct(){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('vendor.product.vendor_add_product',compact('brands','categories'));
    }

    public function vendorStoreProduct(Request $request){
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
            if ($request->product_discount_price){
                $charge = $request->product_discount_price*10/100;
                $discount_price = $request->product_discount_price;
                $selling_price = $request->product_selling_price;
            }else if(!$request->product_discount_price){
                $charge = $request->product_selling_price*10/100;
                $selling_price = $request->product_selling_price;
            }

            if ($request->product_discount_price){
                $charge = $request->product_discount_price*10/100;
                $price = $request->product_discount_price + $charge;
            }else if(!$request->product_discount_price){
                $charge = $request->product_selling_price*10/100;
                $price = $request->product_selling_price + $charge;
            }




        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'vendor_id' => Auth::id(),
            'vendor_charge' => $charge,
            'product_name' => $request->product_name,
            'product_slug' => Str::slug($request->product_name),
            'product_tags' => $request->product_tags,
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
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
        return redirect()->route('vendor.all.product')->with('message','Vendor Product Inserted Successfully');
    }



    public function vendorSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->get();
        return json_encode($subcat);
    }


    public function vendorProductInactive($id){
        $inactive = Product::findOrFail($id);
        $inactive->status = 0;
        $inactive->update();
        return redirect()->back()->with('message','Vendor Product Inactive Successfully');
    }


    public function vendorProductActive($id){
        $active = Product::findOrFail($id);
        $active->status = 1;
        $active->update();
        return redirect()->back()->with('message','Vendor Product Active Successfully');
    }


    public function vendorProEdit($id){
        $edit_product = Product::find($id);
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $multiImg = MultiImg::where('product_id',$id)->get();
        return view('vendor.product.vendor_edit',compact('edit_product','brands','categories','subcategories','multiImg'));
    }


    public function vendorProUpdate(Request $request,$id){
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
            if ($request->product_discount_price){
                $charge = $request->product_discount_price*10/100;
                $discount_price = $request->product_discount_price;
                $selling_price = $request->product_selling_price;
            }else if(!$request->product_discount_price){
                $charge = $request->product_selling_price*10/100;
                $selling_price = $request->product_selling_price;
            }

            if ($request->product_discount_price){
                $charge = $request->product_discount_price*10/100;
                $price = $request->product_discount_price + $charge;
            }else if(!$request->product_discount_price){
                $charge = $request->product_selling_price*10/100;
                $price = $request->product_selling_price + $charge;
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
        $update->product_qty = $request->product_qty;
        $update->brand_id = $request->brand_id;
        $update->category_id = $request->category_id;
        $update->subcategory_id = $request->subcategory_id;
        $update->vendor_id = Auth::id();
        $update->vendor_charge = $charge;
        $update->hot_deals = $request->hot_deals;
        $update->special_offers = $request->special_offers;
        $update->special_deals = $request->special_deals;
        $update->recently_added = $request->recently_added;
        $update->featured = $request->featured;
        $update->updated_at = Carbon::now();
        $update->update();


        return redirect()->route('vendor.all.product')->with('message','Vendor Product Updated Successfully');
    }

    public function vendorMultiUpdate(Request $request){
        $multiImg = $request->multi_img;
        //dd($multiImg);
        if (is_array($multiImg) || is_object($multiImg))
        {
            foreach ($multiImg as $id => $img){
                $unique = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(1100,1100)->save('uploads/products/multi/'.$unique);
                $image = MultiImg::find($id);
                @unlink('uploads/products/multi/'.$image->photo);
                $image->photo = $unique;
                $image->updated_at = Carbon::now();
                $image->update();
            }
        }

        return redirect()->back()->with('message','Vendor Product MultiImage Updated Successfully');
    }


    public function vendorMultiDelete($id){
        $multiDelete = MultiImg::find($id);
        $multiDelete->delete();
        @unlink('uploads/products/multi/'.$multiDelete->photo);
        return redirect()->back()->with('warning','Vendor Product MultiImage Deleted Successfully');
    }

    public function vendorProductDelete($id){
        $deleteSingle = Product::find($id);
        @unlink('uploads/products/thumbnail/'.$deleteSingle->product_thumbnail);
        $delete_multi = MultiImg::where('product_id',$id)->get();
        foreach ($delete_multi as $multi){
            @unlink('uploads/products/multi/'.$multi->photo);
        }
        $deleteSingle->delete();


        return redirect()->back()->with('warning','Vendor Product Deleted Successfully');
    }


    public function vendorProductDetails($id){
        $product = Product::with('vendor','category','brand','subcategory')->where('status',1)->where('id',$id)->first();

        return view('vendor.product.vendor_product_details',compact('product'));
    }






}
