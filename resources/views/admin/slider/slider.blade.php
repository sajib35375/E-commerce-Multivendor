@extends('admin.admin_dashboard')
@section('admin')

<div class="wrap" style="margin-top: 80px; margin-right: 15px; margin-left: 15px;">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>All Slider</h2>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Slider Title</th>
                                <th>Slider Short Title</th>
                                <th>Slider Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($all_slider as $slider)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $slider->slider_title }}</td>
                                <td>{{ $slider->short_title }}</td>
                                <td><img style="width: 100px; height: 100px;" src="{{ URL::to('') }}/uploads/slider/{{ $slider->slider_image }}" alt=""></td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('slider.edit',$slider->id) }}">Edit</a>
                                    <a id="delete" class="btn btn-danger" href="{{ route('slider.delete',$slider->id) }}">Delete</a>
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
                    <h2>Add New Slider</h2>
                </div>
                <div class="card-body">

                    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="my-3">
                            <label for="">Slider Title</label>
                            <input name="slider_title" class="form-control" type="text">
                            @error('slider_title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Slider Short Title</label>
                            <input name="short_title" class="form-control" type="text">
                            @error('short_title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Slider Image</label>
                            <img id="img" src="" alt="">
                            <input name="slider_image" class="form-control-file" type="file">
                            @error('slider_image')
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
