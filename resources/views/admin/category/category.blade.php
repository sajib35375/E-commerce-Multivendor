@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px; margin-right: 10px;margin-left: 10px">
        <div class="row">
            <div class="col-md-7">

                <div class="card">

                    <div class="card-header">
                        <h2>All Category</h2>

                    </div>
                    <div class="card-body text-center">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allCat as $cat)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td><img style="width: 60px;height: 60px;" src="{{ URL::to('') }}/uploads/category/{{ $cat->category_image }}" alt=""></td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('category.edit',$cat->id) }}">Edit</a>
                                        <a id="delete" class="btn btn-danger" href="{{ route('category.delete',$cat->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
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
                        <h2>Add New Category</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="my-3">
                                <label for="">Category Name</label>
                                <input name="name" class="form-control" type="text">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="">Category Image</label>
                                <img id="img" src="" alt="">
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
