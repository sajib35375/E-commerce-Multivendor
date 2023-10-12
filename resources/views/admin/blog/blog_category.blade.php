@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

 <div class="wrap" style="margin-top: 80px;margin-right: 30px;margin-left: 30px;">
     <div class="row">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">
                     <h2>All Blog Category</h2>
                 </div>
                 <div class="card-body">
                     <table class="table table-striped table-bordered" id="example">
                         <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                         </thead>
                         <tbody>
                         @foreach($all_cat as $cat)
                         <tr>
                             <td>{{ $loop->index+1 }}</td>
                             <td>{{ $cat->name }}</td>
                             <td><img style="width: 80px;height: 80px;" src="{{ URL::to('') }}/uploads/blog/category/{{ $cat->photo }}" alt=""></td>
                             <td>
                                 <a class="btn btn-info" href="{{ route('blog.category.edit',$cat->id) }}">Edit</a>
                                 <a id="delete" class="btn btn-danger" href="{{ route('blog.category.delete',$cat->id) }}">Delete</a>
                             </td>
                         </tr>
                         @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         <div class="col-md-4">
             <div class="card">
                 <div class="card-header">
                     <h2>Add New Category</h2>
                 </div>
                 <div class="card-body">
                     <form action="{{ route('blog.category.store') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="my-3">
                             <label for="">Category Name</label>
                             <input name="name" class="form-control" type="text">
                             @error('name')
                             <p class="text-danger">{{ $message }}</p>
                             @enderror
                         </div>
                         <div class="my-3">
                             <label for="">Category Photo</label>
                             <img id="img" src="" alt="">
                             <input name="photo" class="form-control-file" type="file">
                         </div>
                         <div class="my-3">
                             <input class="btn btn-success" type="submit">
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>




    <script>
        $(document).ready(function (){
            $(document).on('change','input[name="photo"]',function (e){
                e.preventDefault();
                let url = URL.createObjectURL(e.target.files[0]);
                $('img#img').attr('src',url).width('200px').height('200px');
            });
        });
    </script>




@endsection
