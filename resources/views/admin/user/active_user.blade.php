@extends('admin.admin_dashboard')
@section('admin')

 <div class="wrap" style="margin-top: 80px; margin-right: 30px; margin-left: 30px;">
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-header">
                     <h2>All Active User</h2>
                 </div>
                 <div class="card-body">
                     <table class="table table-bordered table-striped" id="example">
                         <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                         </thead>
                         <tbody>
                         @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td><img style="width: 100px;height: 100px; border-radius: 50%;" src="{{ $user->photo ? 'http://localhost:8000/uploads/user/'.$user->photo : 'http://localhost:8000/uploads/user/no_image.jpg' }}" alt=""></td>
                                <td>
                                    @if($user->userOnline())
                                    <span class="badge badge-pill bg-success">Active</span>
                                    @else
                                        <span class="badge badge-pill bg-danger">{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('active.user.edit',$user->id) }}">Edit</a>
                                    <a id="delete" class="btn btn-danger" href="{{ route('active.user.delete',$user->id) }}">Delete</a>
                                </td>
                            </tr>
                         @endforeach
                         </tbody>
                         <tfoot>
                         <tr>
                             <th>#</th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Phone</th>
                             <th>Address</th>
                             <th>Photo</th>
                             <th>Status</th>
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
