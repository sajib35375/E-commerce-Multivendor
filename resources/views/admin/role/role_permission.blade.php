@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px; margin-right: 10px;margin-left: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Role Permission</h2>
                    </div>
                    <div class="card-body text-center">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="">Edit</a>
                                        <a id="delete" class="btn btn-danger" href="">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
