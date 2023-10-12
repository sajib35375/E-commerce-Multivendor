@extends('admin.admin_dashboard')
@section('admin')

   <div class="wrap " style="margin-top: 80px;margin-right: 20px;margin-left: 20px;">

       <div class="row d-flex justify-content-center">
           <div class="col-md-8">
               <div class="text-center">
                   <h2>Inactive Vendor Details</h2>
               </div>
               <div class="card ">
                   <img style="width: 250px;height: 250px;margin: auto;border-radius: 50%;" src="{{ URL::to('') }}/AdminBackend/upload/admin/{{ $inactive_details->photo ? $inactive_details->photo : 'avatar.jpg' }}" alt="">

                   <div class="card-body">
                       <form action="" method="POST" enctype="multipart/form-data">
                           @csrf

                           <div class="row mb-3">
                               <div class="col-sm-2">
                                   <h6 class="mb-0">Full Name</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                   <input type="text" name="name" class="form-control" value="{{ $inactive_details->name }}" />
                               </div>
                           </div>

                           <div class="row mb-3">
                               <div class="col-sm-2">
                                   <h6 class="mb-0">Username</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                   <input disabled type="text" name="username" class="form-control" value="{{ $inactive_details->username }}" />
                               </div>
                           </div>

                           <div class="row mb-3">
                               <div class="col-sm-2">
                                   <h6 class="mb-0">Email</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                   <input type="text" name="email" class="form-control" value="{{ $inactive_details->email }}" />
                               </div>
                           </div>
                           <div class="row mb-3">
                               <div class="col-sm-2">
                                   <h6 class="mb-0">Phone</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                   <input type="text" name="phone" class="form-control" value="{{ $inactive_details->phone }}" />
                               </div>
                           </div>
                           <div class="row mb-3">
                               <div class="col-sm-2">
                                   <h6 class="mb-0">Photo</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                   <img id="img" src="" alt="">
                                   <input name="old_photo" value="{{ $inactive_details->photo }}" type="hidden">
                                   <input type="file" id="photo" name="photo" class="form-control-file" />
                               </div>
                           </div>
                           <div class="row mb-3">
                               <div class="col-sm-2">
                                   <h6 class="mb-0">Address</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                   <input type="text" class="form-control" name="address" value="{{ $inactive_details->address }}" />
                               </div>
                           </div>
                           <div class="row mb-3">
                               <div class="col-sm-2">
                                   <h6 class="mb-0">Vendor Join Date</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                   <input type="text" class="form-control" name="vendor_join" value="{{ $inactive_details->vendor_join }}" />
                               </div>
                           </div>
                           <div class="row mb-3">
                               <div class="col-sm-2">
                                   <h6 class="mb-0">Vendor Info</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                   <textarea type="text" class="form-control" name="vendor_info">{{ $inactive_details->vendor_info }}</textarea>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-sm-2"></div>
                               <div class="col-sm-9 text-secondary">
                                   <a  class="btn btn-danger px-4" href="{{ route('vendor.status.active',$inactive_details->id) }}">Active Vendor</a>
                               </div>
                           </div>

                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>












@endsection
