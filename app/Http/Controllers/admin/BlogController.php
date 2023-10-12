<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class BlogController extends Controller
{
    public function blogCategory(){
        $all_cat = BlogCategory::latest()->get();
        return view('admin.blog.blog_category',compact('all_cat'));
    }

    public function blogCategoryStore(Request $request){
        $this->validate($request,[
            'name' => 'required'
        ]);

        if ($request->hasFile('photo')){
            $img = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(80,80)->save('uploads/blog/category/'.$unique_name);
        }

        BlogCategory::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'photo' => $unique_name
        ]);

        return redirect()->back()->with('message','Blog Category Inserted Successfully');
    }

    public function blogCategoryEdit($id){
        $edit_data = BlogCategory::find($id);
        return view('admin.blog.blog_category_edit',compact('edit_data'));
    }


    public function blogCategoryUpdate(Request $request,$id){
        $update_data = BlogCategory::find($id);
        if ($request->hasFile('photo')){
            $img = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(80,80)->save('uploads/blog/category/'.$unique_name);
            @unlink('uploads/blog/category/'.$request->old_photo);
        }else{
            $unique_name = $request->old_photo;
        }

        $update_data->name = $request->name;
        $update_data->photo = $unique_name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('blog.category')->with('message','Blog Category Inserted Successfully');
    }


    public function blogCategoryDelete($id){
        $delete_data = BlogCategory::find($id);
        $delete_data->delete();
        @unlink('uploads/blog/category/'.$delete_data->photo);
        return redirect()->back()->with('warning','Blog Category Deleted Successfully');
    }

    public function addBlogPost(){
        $categories = BlogCategory::latest()->get();
        return view('admin.blog.add_new_blog_post',compact('categories'));
    }

    public function storeBlogPost(Request $request){
        $this->validate($request,[
            'blog_category_id' => 'required',
            'blog_title' => 'required',
            'short_des' => 'required',
            'long_des' => 'required',
        ]);
        if ($request->hasFile('photo')){
            $image = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1103,906)->save('uploads/blog/'.$unique_name);
        }
        BlogPost::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_slug' => Str::slug($request->blog_title),
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'photo' => $unique_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('blog.post')->with('message','Blog Post Inserted Successfully');
    }


    public function blogPost(){
        $blog_posts = BlogPost::with('blogCategory')->latest()->get();
        return view('admin.blog.blog_post',compact('blog_posts'));
    }

    public function blogPostEdit($id){
        $categories = BlogCategory::latest()->get();
        $edit_data = BlogPost::find($id);
        return view('admin.blog.edit_blog_post',compact('edit_data','categories'));
    }

    public function blogPostUpdate(Request $request,$id){
        $update_data = BlogPost::find($id);

        if ($request->hasFile('photo')){
            $image = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1103,906)->save('uploads/blog/'.$unique_name);
            @unlink('uploads/blog/'.$request->old_photo);
        }else{
            $unique_name = $request->old_photo;
        }

        $update_data->blog_category_id = $request->blog_category_id;
        $update_data->blog_title = $request->blog_title;
        $update_data->short_des = $request->short_des;
        $update_data->long_des = $request->long_des;
        $update_data->photo = $unique_name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('blog.post')->with('message','Blog Post Updated Successfully');
    }


    public function blogPostDelete($id){
        $delete_data = BlogPost::find($id);
        $delete_data->delete();
        @unlink('uploads/blog/'.$delete_data->photo);

        return redirect()->back()->with('warning','Blog Post Deleted Successfully');
    }

}
