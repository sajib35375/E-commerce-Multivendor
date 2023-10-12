@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px;margin-left: 20px;margin-right: 20px;">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>All District</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Division Name</th>
                                <th>District Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($districts as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->division->division_name }}</td>
                                    <td>{{ $item->district_name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('district.edit',$item->id) }}">Edit</a>
                                        <a class="btn btn-danger" id="delete" href="{{ route('district.delete',$item->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Division Name</th>
                                <th>District Name</th>
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
                        <h2>Add New District</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('district.store') }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label for="">Division Name</label>
                                <select class="form-control" name="division_id" id="">
                                    <option value="">-Select-</option>
                                    @foreach($divisions as $item)
                                    <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                    @endforeach
                                </select>
                                @error('division_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">District Name</label>
                                <input name="district_name" class="form-control" type="text">
                                @error('district_name')
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
