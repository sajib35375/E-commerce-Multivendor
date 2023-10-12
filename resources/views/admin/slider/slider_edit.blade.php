@extends('admin.admin_dashboard')
@section('admin')


  <div class="wrap" style="margin-top: 80px;margin-left: 15px;margin-right: 15px;">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h2>Edit Slider</h2>
                  </div>
                  <div class="card-body">

                      <form action="{{ route('slider.update',$edit_data->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf

                          <div class="my-3">
                              <label for="">Slider Title</label>
                              <input name="slider_title" value="{{ $edit_data->slider_title }}" class="form-control" type="text">
                              @error('slider_title')
                              <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="my-3">
                              <label for="">Slider Short Title</label>
                              <input name="short_title" value="{{ $edit_data->short_title }}" class="form-control" type="text">
                              @error('short_title')
                              <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="my-3">
                              <label for="">Slider Title</label>
                              <img id="img" style="width: 100px;height: 100px;" src="{{ URL::to('') }}/uploads/slider/{{ $edit_data->slider_image }}" alt="">
                              <input name="old_image" value="{{ $edit_data->slider_image }}" type="hidden">
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
