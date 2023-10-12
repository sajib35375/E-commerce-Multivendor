@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px; margin-right: 10px;margin-left: 10px">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h2>All SubCategory</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>SubCategory Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sub_cat as $cat)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $cat->category->name }}</td>
                                    <td>{{ $cat->sub_name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('subcategory.edit',$cat->id) }}">Edit</a>
                                        <a id="delete" class="btn btn-danger" href="{{ route('subcategory.delete',$cat->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>SubCategory Name</th>
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
                        <h2>Add New SubCategory</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subcategory.store') }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label for="">Category Select</label>
                                <select class="form-control" name="category_id" id="">
                                    <option value="">Select</option>
                                    @foreach($all_cat as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">Sub Category Name</label>
                                <input name="sub_name" class="form-control" type="text">
                                @error('sub_name')
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
