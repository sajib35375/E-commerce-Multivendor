@extends('frontend.main_master')
@section('main')
    @section('title')
        Vendor Shop
    @endsection

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Vendors List
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="archive-header-2 text-center">
                <h1 class="display-2 mb-50">Vendors List</h1>
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form action="{{ route('vendor.search.all.page') }}" method="GET">
                                    @csrf
                                    <input type="text" name="vendor_search" placeholder="Search vendors (by name or ID)..." />
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row vendor-grid">

                    @foreach($vendors as $vendor)

                        @php
                            $product_number = \App\Models\Product::where('status',1)->where('vendor_id',$vendor->id)->count();
                        @endphp

                <div class="col-lg-3 col-md-6 col-12 col-sm-6">
                    <div class="vendor-wrap mb-40">
                        <div class="vendor-img-action-wrap">
                            <div class="vendor-img">
                                <a href="{{ route('vendor.details',$vendor->id) }}">
                                    <img class="default-img" src="{{ URL::to('') }}/AdminBackend/upload/admin/{{ $vendor->photo }}" alt="" />
                                </a>
                            </div>
                            <div class="product-badges product-badges-position product-badges-mrg">
                                <span class="hot">Mall</span>
                            </div>
                        </div>
                        <div class="vendor-content-wrap">
                            <div class="d-flex justify-content-between align-items-end mb-30">
                                <div>
                                    <div class="product-category">
                                        <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                                    </div>
                                    <h4 class="mb-5"><a href="{{ route('vendor.details',$vendor->id) }}">{{ $vendor->name }}</a></h4>

                                </div>
                                <div class="mb-10">
                                    <span class="font-small total-product">{{ $product_number }} products</span>
                                </div>
                            </div>
                            <div class="vendor-info mb-30">
                                <ul class="contact-infor text-muted">
                                    <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span></li>
                                    <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                                </ul>
                            </div>
                            <a href="{{ route('vendor.details',$vendor->id) }}" class="btn btn-xs">Visit Store <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <!--end vendor card-->


              @endforeach





                <!--end vendor card-->
            </div>

        </div>
    </div>












@endsection
