@extends('admin.admin_dashboard')
@section('admin')

<div class="wrap" style="margin-top: 80px;margin-left: 20px;margin-right: 20px;">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>All Division</h2>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Division Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                @foreach($all_division as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->division_name }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('division.edit',$item->id) }}">Edit</a>
                                <a class="btn btn-danger" id="delete" href="{{ route('division.delete',$item->id) }}">Delete</a>
                            </td>
                        </tr>
                     @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Division Name</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Add New Division</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('division.store') }}" method="POST">
                        @csrf
                        <div class="my-3">
                            <label for="">Division Name</label>
                            <input name="division_name" class="form-control" type="text">
                            @error('division_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







@endsection
