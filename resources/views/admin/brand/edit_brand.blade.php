@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px;margin-left: 10px;margin-right: 10px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Brand</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('brand.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="my-3">
                                <label for="">Brand Name</label>
                                <input name="name" value="{{ $edit->name }}" class="form-control" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Brand Image</label><br>
                                <img id="img" style="width: 150px;height: 150px;" src="{{ URL::to('') }}/AdminBackend/upload/admin/brand/{{ $edit->photo }}" alt="">
                                <input name="old_photo" value="{{ $edit->photo }}" type="hidden">
                                <input id="photo" name="photo" class="form-control-file" type="file">
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
