@extends('frontend.main_master')
@section('main')
   @section('title')
       Error Page
   @endsection
   <div class="page-content pt-150 pb-150">
       <div class="container">
           <div class="row">
               <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">
                   <p class="mb-20"><img src="{{ asset('frontend/assets/imgs/page/page-404.png') }}" alt="" class="hover-up" /></p>
                   <h1 class="display-2 mb-30">Page Not Found</h1>
                   <div class="search-form">

                   </div>
                   <a class="btn btn-default submit-auto-width font-xs hover-up mt-30" href="{{ route('index') }}"><i class="fi-rs-home mr-5"></i> Back To Home Page</a>
               </div>
           </div>
       </div>
   </div>

@endsection
