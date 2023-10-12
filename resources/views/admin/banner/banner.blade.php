@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px; margin-right: 15px; margin-left: 15px;">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>All Banner</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner Title</th>
                                <th>Banner Url</th>
                                <th>Banner Clicks</th>
                                <th>Banner Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($banners as $banner)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $banner->banner_title }}</td>
                                    <td>{{ $banner->banner_url }}</td>
                                    <td><span class="badge badge-pill bg-success">{{ $banner->clicks ? $banner->clicks : 0 }}</span></td>
                                    <td><img style="width: 100px; height: 100px;" src="{{ URL::to('') }}/uploads/banner/{{ $banner->banner_image }}" alt=""></td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('banner.edit',$banner->id) }}">Edit</a>
                                        <a id="delete" class="btn btn-danger" href="{{ route('banner.delete',$banner->id) }}">Delete</a>
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
                        <h2>Add New Banner</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="my-3">
                                <label for="">Banner Title</label>
                                <input name="banner_title" class="form-control" type="text">
                                @error('banner_title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">Banner Url</label>
                                <input name="banner_url" class="form-control" type="text">
                                @error('banner_url')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">Banner Image</label>
                                <img id="img" src="" alt="">
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
