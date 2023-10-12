@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px; margin-right: 20px;margin-left: 20px;">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Division</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('division.update',$edit_data->id) }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label for="">Division Name</label>
                                <input name="division_name" value="{{ $edit_data->division_name }}" class="form-control" type="text">

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
