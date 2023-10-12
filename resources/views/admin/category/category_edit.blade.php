@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px;margin-right: 10px;margin-left: 10px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Category Edit</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="my-3">
                                <label for="">Category Name</label>
                                <input name="name" class="form-control" value="{{ $edit->name }}" type="text">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="">Category Image</label>
                                <img id="img" style="width: 100px;height: 100px;" src="{{ URL::to('') }}/uploads/category/{{ $edit->category_image }}" alt="">
                                <input name="old_cat_img" value="{{ $edit->category_image }}" type="hidden">
                                <input name="category_image" class="form-control-file" type="file">
                                @error('category_image')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="my-3">
                                <input class="btn btn-primary" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>









@endsection
