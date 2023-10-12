@extends('admin.admin_dashboard')
@section('admin')


<div class="wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Blog Category</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog.category.update',$edit_data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">
                            <label for="">Category Name</label>
                            <input name="name" value="{{ $edit_data->name }}" class="form-control" type="text">
                        </div>
                        <div class="my-3">
                            <label for="">Category Photo</label>
                            <img style="height: 200px;width: 200px;" id="img" src="{{ URL::to('') }}/uploads/blog/category/{{ $edit_data->photo }}" alt="">
                            <input name="old_photo" value="{{ $edit_data->photo }}" type="hidden">
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









@endsection
