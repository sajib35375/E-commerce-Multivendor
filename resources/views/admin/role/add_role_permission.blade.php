@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   <div class="wrap" style="margin-top: 80px; margin-right: 10px;margin-left: 10px">
       <div class="row">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header">
                       <h2>Add Roles in Permission</h2>
                   </div>
                   <div class="card-body">
                       <form action="{{ route('roles.permission.store') }}" method="POST">
                           @csrf
                           <div class="row">
                               <div class="col-md-12">
                                   <label for="">Select Role</label>
                                   <select class="form-control" name="role_id" id="">
                                       <option value="">-Select-</option>
                                       @foreach($roles as $role)
                                       <option value="{{ $role->id }}">{{ $role->name }}</option>
                                       @endforeach
                                   </select>
                                   @error('role_id')
                                   <p class="text-danger">{{ $message }}</p>
                                   @enderror
                               </div>
                               <div class="my-3">
                                   <input name="name_per" value="" id="name_per"  type="checkbox">
                                   <label for="name_per">All Permission Check</label>
                               </div>
                               <hr>
                               <div class="my-5">
                                   @foreach($data as $item)
                                  <div class="row">
                                      <div class="col-md-3">
                                          <input name="group_name" value="" id="group"  type="checkbox">
                                          <label for="group">{{ $item->group_name }}</label>
                                      </div>
                                      @php
                                          $permissions = \App\Models\User::getAllPermissionWithRole($item->group_name);
                                      @endphp

                                      <div class="col-md-9">
                                          @foreach($permissions as $data)
                                          <input name="permission_id[]" value="{{ $data->id }}" id="permission"  type="checkbox">
                                          <label for="permission">{{ $data->name }}</label>
                                          @endforeach
                                              @error('permission_id')
                                              <p class="text-danger">{{ $message }}</p>
                                              @enderror
                                              <br><br>
                                      </div>

                                  </div>
                                   @endforeach
                               </div>

                           </div>
                           <div class="my-3">
                               <input class="btn btn-success" type="submit">
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>


    <script>
        $(document).on('click','#name_per',function (){
            if ($(this).is(':checked')){
                $('input[type="checkbox"]').prop('checked',true);
            }else{
                $('input[type="checkbox"]').prop('checked',false);
            }
        })
    </script>


@endsection
