@extends('admin.admin_dashboard')
@section('admin')

 <div class="wrap" style="margin-top: 80px; margin-left: 30px; margin-right: 30px;">
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-header">
                     <h2>Add New Role</h2>
                 </div>
                 <div class="card-body">

                     <form action="{{ route('store.roles') }}" method="POST">
                         @csrf

                         <div class="my-3">
                             <label for="">Role Name</label>
                             <input name="name" class="form-control" type="text">
                             @error('name')
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
