@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="wrap" style="margin-top: 80px; margin-left: 30px; margin-right: 30px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Active User</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('active.vendor.update',$edit_data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-3">
                                <label for="">Name</label>
                                <input name="name" value="{{ $edit_data->name }}" class="form-control" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Email</label>
                                <input name="email" value="{{ $edit_data->email }}" class="form-control" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Phone</label>
                                <input name="phone" value="{{ $edit_data->phone }}" class="form-control" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Address</label>
                                <input name="address" value="{{ $edit_data->address }}" class="form-control" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Photo</label>
                                <img id="img" style="width: 70px;height: 70px;" src="{{ $edit_data->photo ? 'http://localhost:8000/AdminBackend/upload/admin/'.$edit_data->photo : 'http://localhost:8000/uploads/user/no_image.jpg' }}" alt="">
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

    <script>
        $(document).ready(function (){
            $(document).on('change','input[name="photo"]',function (e){
                let url = URL.createObjectURL(e.target.files[0]);

                $('img#img').attr('src',url);
            })
        })
    </script>

@endsection
