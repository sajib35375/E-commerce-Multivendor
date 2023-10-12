@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px;margin-left: 15px;margin-right: 15px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Banner</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('banner.update',$edit_data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="my-3">
                                <label for="">Banner Title</label>
                                <input name="banner_title" value="{{ $edit_data->banner_title }}" class="form-control" type="text">
                                @error('banner_title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">Banner Url</label>
                                <input name="banner_url" value="{{ $edit_data->banner_url }}" class="form-control" type="text">
                                @error('banner_url')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">Banner Image</label>
                                <img id="img" style="width: 100px;height: 100px;" src="{{ URL::to('') }}/uploads/banner/{{ $edit_data->banner_image }}" alt="">
                                <input name="old_image" value="{{ $edit_data->banner_image }}" type="hidden">
                                <input name="banner_image" class="form-control-file" type="file">
                                @error('banner_image')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
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
