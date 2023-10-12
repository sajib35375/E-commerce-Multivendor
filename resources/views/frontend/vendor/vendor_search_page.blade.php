@extends('frontend.main_master')
@section('main')
    @section('title')
        Vendor Search Page
    @endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Vendor <span></span> {{ $vendor->name }}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="archive-header-2 text-center pt-80 pb-50">
            <h1 class="display-2 mb-50">{{ $vendor->name }}</h1>

        </div>
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">


                    </div>
                </div>
                <div class="row product-grid">

                    @foreach($products as $item)

                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                        <img class="default-img" style="width: 150px;height: 150px;" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" />
                                        <img class="hover-img" style="width: 150px;height: 150px;" src="{{ URL::to('') }}/uploads/products/hover/{{ $item->hover_image }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" id="{{ $item->id }}" onclick="addToWishlist(this.id)" class="action-btn" type="submit" ><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="AddToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    <a type="submit" onclick="SingleProductQuickView({{ $item->id }})" aria-label="Quick view" class="action-btn" ><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @php
                                        $discount_amount = $item->product_selling_price - $item->product_discount_price;
                                        $discount = $discount_amount/$item->product_selling_price * 100;

                                    @endphp
                                    @if($item->product_discount_price)
                                        <span class="hot">{{ round($discount) }}%</span>
                                    @else
                                        <span class="new">New</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="#">{{ $item->category->name }}</a>
                                </div>
                                <h2><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a></h2>
                                @php
                                    $review_avg = \App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('quality');
                                    $review_count = \App\Models\Review::where('product_id',$item->id)->where('status',1)->count();
                                @endphp
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        @if(round($review_avg)==1)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif(round($review_avg)==2)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif(round($review_avg)==3)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif(round($review_avg)==4)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif(round($review_avg)==5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>
                                    <span class="font-small ml-5 text-muted"> ({{ $review_count }})</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a href="#">NestFood</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        @if($item->product_discount_price)
                                            <span>{{ $item->product_discount_price + $item->vendor_charge }} ৳</span>
                                            <span class="old-price">{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                        @else
                                            <span>{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                        @endif
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end product card-->

                    @endforeach





                    <!--end product card-->
                </div>
                <!--product grid-->
{{--                <div class="pagination-area mt-20 mb-20">--}}
{{--                    <nav aria-label="Page navigation example">--}}
{{--                        <ul class="pagination justify-content-start">--}}
{{--                            <li class="page-item">--}}
{{--                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>--}}
{{--                            </li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                            <li class="page-item active"><a class="page-link" href="#">2</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">6</a></li>--}}
{{--                            <li class="page-item">--}}
{{--                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </nav>--}}
{{--                </div>--}}

                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                    <div class="vendor-logo mb-30">
                        <img src="{{ URL::to('') }}/AdminBackend/upload/admin/{{ $vendor->photo }}" alt="" />
                    </div>
                    <div class="vendor-info">
                        <div class="product-category">
                            <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                        </div>
                        <h4 class="mb-5"><a href="{{ route('vendor.details',$vendor->id) }}" class="text-heading">{{ $vendor->name }}</a></h4>
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                        </div>
                        <div class="vendor-des mb-30">
                            <p class="font-sm text-heading">{{ $vendor->vendor_info }}</p>
                        </div>

                        <div class="vendor-info">
                            <ul class="font-sm mb-20">
                                <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span></li>
                                <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        @foreach($categories as $cat)
                            @php
                                $cat_pro_count = \App\Models\Product::where('status',1)->where('category_id',$cat->id)->where('vendor_id',$vendor->id)->count();
                            @endphp

                            <li>
                                <a href="{{ route('vendor.category.filter',[$cat->id,$vendor->id]) }}"> <img src="{{ URL::to('') }}/uploads/category/{{ $cat->category_image }}" alt="" />{{ $cat->name }}</a><span class="count">{{ $cat_pro_count }}</span>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fill by price</h5>
                    <form action="{{ route('vendor.price.filter',$vendor->id) }}" method="GET">
                        @csrf
                        <div class="price-filter mb-30">
                            <div class="price-filter-inner">
                                <label for="">Price Range</label>
                                <input name="price_range" min="0" max="6000" type="range">
                                {{--                            <div id="slider-range" class="mb-20"></div>--}}
                                <div class="d-flex justify-content-between">
                                    <div class="caption">From: <strong id="slider-range-value1" class="text-brand">0 BDT</strong></div>
                                    <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>

        $(document).on('change','input[name="price_range"]',function (){
            let price = $(this).val();

            $('#slider-range-value2').html(price+' BDT');
        })



    </script>
@endsection
