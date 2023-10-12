@extends('admin.admin_dashboard')
@section('admin')


<div class="wrap" style="margin-top: 80px; margin-right: 10px;margin-left: 10px">
    <div class="row">
        <div class="col-md-7">

            <div class="card">

                <div class="card-header">
                    <h2>All Brand</h2>

                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allBrand as $brand)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $brand->name }}</td>
                            <td><img style="width:60px; height: 60px;" src="{{ URL::to('') }}/AdminBackend/upload/admin/brand/{{ $brand->photo }}" alt=""></td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('brand.edit',$brand->id) }}">Edit</a>
                                <a id="delete" class="btn btn-danger" href="{{ route('brand.delete',$brand->id) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h2>Add New Brand</h2>
                </div>
                <div class="card-body">

                    <form action="{{ route('brand.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="my-3">
                            <label for="">Brand Name</label>
                            <input name="name" class="form-control" type="text">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Brand Image</label><br>
                            <img id="img" src="" alt="">
                            <input id="photo" name="photo" class="form-control-file" type="file">
                            @error('photo')
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
