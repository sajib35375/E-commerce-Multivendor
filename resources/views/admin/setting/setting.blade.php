@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
 <div class="wrap" style="margin-top: 80px; margin-left: 30px; margin-right: 30px;">
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-header">
                     <h2>Site Setting Info</h2>
                 </div>
                 <div class="card-body">
                     <form action="{{ route('site.setting.store') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="my-3">
                             <label for="">Logo</label>
                             <img id="img" style="width: 150px; height: 150px;" src="{{ URL::to('') }}/uploads/logo/{{ $data->logo }}" alt="">
                             <input name="old_logo" value="{{ $data->logo }}" type="hidden">
                             <input name="logo" class="form-control-file" type="file">
                         </div>
                         <div class="my-3">
                             <label for="">Address</label>
                             <textarea class="form-control" name="address" id="" cols="30" rows="10">{{ $data->address }}</textarea>
                         </div>
                         <div class="my-3">
                             <label for="">Cell</label>
                             <input name="cell" class="form-control" value="{{ $data->cell }}" type="text">
                         </div>
                         <div class="my-3">
                             <label for="">Email</label>
                             <input name="email" class="form-control" value="{{ $data->email }}" type="text">
                         </div>
                         <div class="my-3">
                             <label for="">Hours</label>
                             <input name="hours" class="form-control" value="{{ $data->hours }}" type="text">
                         </div>
                         <div class="my-3">
                             <label for="">Support Center</label>
                             <input name="support_center" class="form-control" value="{{ $data->support_center }}" type="text">
                         </div>
                         <div class="my-3">
                             <label for="">FaceBook</label>
                             <input name="facebook" class="form-control" value="{{ $data->facebook }}" type="text">
                         </div>
                         <div class="my-3">
                             <label for="">Twitter</label>
                             <input name="twitter" class="form-control" value="{{ $data->twitter }}" type="text">
                         </div>
                         <div class="my-3">
                             <label for="">Linkedin</label>
                             <input name="linkedin" class="form-control" value="{{ $data->linkedin }}" type="text">
                         </div>
                         <div class="my-3">
                             <label for="">Instagram</label>
                             <input name="instagram" class="form-control" value="{{ $data->instagram }}" type="text">
                         </div>
                         <div class="my-3">
                             <label for="">Youtube</label>
                             <input name="youtube" class="form-control" value="{{ $data->youtube }}" type="text">
                         </div>
                         <div class="my-3">
                             <button class="btn btn-success" type="submit">Submit</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>



 <script>
     $(document).on('change','input[name="logo"]',function (e){
         e.preventDefault();
         let url = URL.createObjectURL(e.target.files[0]);
         $('img#img').attr('src',url);
     })
 </script>





@endsection
