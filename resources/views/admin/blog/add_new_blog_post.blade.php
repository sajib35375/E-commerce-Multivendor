@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="wrap" style="margin-top: 80px; margin-left: 30px; margin-right: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Add New Blog Post</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.blog.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">
                            <label for="">Category</label>
                            <select class="form-control" name="blog_category_id" id="">
                                <option value="">-Select-</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('blog_category_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Title</label>
                            <input name="blog_title" class="form-control" type="text">
                            @error('blog_title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Short Description</label>
                            <textarea class="form-control" name="short_des" id="" cols="30" rows="10"></textarea>
                            @error('short_des')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Long Description</label>
                            <textarea id="mytextarea" name="long_des">Hello, World!</textarea>
                            @error('long_des')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Photo</label>
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
