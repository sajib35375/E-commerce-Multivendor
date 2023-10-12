@extends('admin.admin_dashboard')
@section('admin')

 <div class="wrap" style="margin-top: 80px;margin-right: 30px; margin-left: 30px;">
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-header">
                     <h2>All Blog Post</h2>
                     <a style="float: right;" class="btn btn-primary" href="{{ route('add.blog.post') }}">Add New Post</a>
                 </div>
                 <div class="card-body">
                     <table class="table table-bordered table-striped" id="example">
                         <thead>
                         <tr>
                             <th>#</th>
                             <th>Title</th>
                             <th>Blog Category</th>
                             <th width="35%">Short Description</th>
                             <th>Photo</th>
                             <th>Action</th>
                         </tr>
                         </thead>
                         <tbody>
                         @foreach($blog_posts as $post)
                         <tr>
                             <td>{{ $loop->index+1 }}</td>
                             <td>{{ $post->blog_title }}</td>
                             <td>{{ $post->blogCategory->name }}</td>
                             <td>{{ Str::of($post->short_des)->words(20) }}</td>
                             <td><img style="height: 100px; width: 100px;" src="{{ URL::to('') }}/uploads/blog/{{ $post->photo }}" alt=""></td>
                             <td>
                                 <a class="btn btn-info" href="{{ route('blog.post.edit',$post->id) }}">Edit</a>
                                 <a id="delete" class="btn btn-danger" href="{{ route('blog.post.delete',$post->id) }}">Delete</a>
                             </td>
                         </tr>
                         @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>





@endsection
