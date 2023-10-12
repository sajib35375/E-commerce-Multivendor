@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px; margin-right: 10px;margin-left: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Role</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('update.roles',$edit_data->id) }}" method="POST">
                            @csrf

                            <div class="my-3">
                                <label for="">Role Name</label>
                                <input name="name" value="{{ $edit_data->name }}" class="form-control" type="text">

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
