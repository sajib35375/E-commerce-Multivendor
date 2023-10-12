@extends('frontend.main_master')
@section('main')

    @section('title')
        Home Page
    @endsection

<section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                @foreach($sliders as $item)
                <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ URL::to('') }}/uploads/slider/{{ $item->slider_image }})">
                    <div class="slider-content">
                        <h1 class="display-2 mb-40">
                            {{ \Illuminate\Support\Str::of($item->slider_title)->words(5) }}

                        </h1>
                        <p class="mb-65">{{ $item->short_title }}</p>
                        <form class="form-subcriber d-flex">
                            <input type="email" placeholder="Your emaill address" />
                            <button class="btn" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>
<!--End hero slider-->
<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">
        <div class="section-title">
            <div class="title">
                <h3>All Brand</h3>

            </div>
            <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
        </div>
        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns" >

                @foreach($brands as $brand)

                    @php
                    $items = \App\Models\Product::where('status',1)->where('brand_id',$brand->id)->count();
                    @endphp
                <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <figure class="img-hover-scale overflow-hidden">
                        <a href="{{ route('all.brand.product',$brand->id) }}"><img src="{{ URL::to('') }}/AdminBackend/upload/admin/brand/{{ $brand->photo }}" alt="" /></a>
                    </figure>
                    <h6><a href="#">{{ $brand->name }}</a></h6>
                    <span>{{ $items }} items</span>
                </div>

                @endforeach


            </div>
        </div>
    </div>
</section>
<!--End category slider-->
<section class="banners mb-25">
    <div class="container">
        <div class="row">


            @foreach($banners as $item)

            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <img src="{{ URL::to('') }}/uploads/banner/{{ $item->banner_image }}" alt="" />
                    <div class="banner-text">
                        <h4>
                           {{ $item->banner_title }}
                        </h4>
                        <a href="{{ route('banner.count',$item->id) }}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>

            @endforeach


        </div>
    </div>
</section>
<!--End banners-->




<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>

                @foreach($categories as $category)

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="nav-tab-two" href="#category{{ $category->id }}" data-bs-toggle="tab" role="tab" aria-controls="tab-two" aria-selected="false">{{ $category->name }}</a>
                </li>


                @endforeach

            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">





                    @foreach($products as $item)


                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap" >
                                <div class="product-img product-img-zoom" >
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                        <img class="default-img"  src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" />
                                        <img class="hover-img"  src="{{ URL::to('') }}/uploads/products/hover/{{ $item->hover_image }}" alt="" />
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
                                    <span class="font-small text-muted">By <a href="#">{{ $item->vendor_id ? $item->vendor->name : 'Owner' }}</a></span>
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
                                        <a class="add" href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><i class="fa fa-search-plus"></i>Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->

                    @endforeach
                        {{ $products->links('frontend.pagination.index_pagination') }}

                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->





            @foreach($categories as $category)


            <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel" aria-labelledby="category{{ $category->id }}">
                <div class="row product-grid-4">

                    @php
                    $catWiseProducts = \App\Models\Product::with('category')->where('status',1)->where('category_id',$category->id)->latest()->get();
                    @endphp


                    @forelse($catWiseProducts as $item)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                        <img class="default-img"  src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" />
                                        <img class="hover-img"  src="{{ URL::to('') }}/uploads/products/hover/{{ $item->hover_image }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" id="{{ $item->id }}" onclick="addToWishlist(this.id)" class="action-btn" type="submit" ><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="AddToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    <a href="#" onclick="SingleProductQuickView({{ $item->id }})" aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
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
                                    <span class="font-small text-muted">By <a href="#">{{ $item->vendor_id ? $item->vendor->name : 'Owner' }}</a></span>
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
                                        <a class="add" href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><i class="fa fa-search-plus"></i>Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    @empty
                        <h5 class="text-danger">No Product Found</h5>
                    @endforelse
                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab two-->

            @endforeach



            <!--En tab seven-->
        </div>
        <!--End tab-content-->
    </div>
</section>
<!--Products Tabs-->




<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>

        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100"> Bring nature into your home </h2>
                        <a href="#" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">


                                @foreach($featured as $item)

                                    <div class="product-cart-wrap">
                                        <div class="product-img-action-wrap" >
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                                    <img class="default-img"  src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" />
                                                    <img class="hover-img"  src="{{ URL::to('') }}/uploads/products/hover/{{ $item->hover_image }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Add To Wishlist" id="{{ $item->id }}" onclick="addToWishlist(this.id)" class="action-btn" type="submit" ><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="AddToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                                <a href="#" onclick="SingleProductQuickView({{ $item->id }})" aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @php
                                                    $discount_amount = $item->product_selling_price - $item->product_discount_price;
                                                    $discount = $discount_amount/$item->product_selling_price * 100;
                                                @endphp
                                                @if($item->product_discount_price)
                                                    <span class="hot">Save {{ round($discount) }}%</span>
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
                                            <div class="product-price mt-10">
                                                @if($item->product_discount_price)
                                                    <span>{{ $item->product_discount_price + $item->vendor_charge }} ৳</span>
                                                    <span class="old-price">{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                                @else
                                                    <span>{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                                @endif
                                            </div>
                                            <div class="sold mt-15 mb-15">
                                                <div class="progress mb-5">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span class="font-xs text-heading"> Sold: 90/120</span>
                                            </div>
                                            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}" class="btn w-100 hover-up"><i class="fa fa-search-plus"></i>Product Details</a>
                                        </div>
                                    </div>
                                    <!--End product Wrap-->

                                @endforeach


                                <!--End product Wrap-->
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->


                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
<!--End Best Sales-->



<!--End Best Sales-->

<section class="product-tabs section-padding position-relative">
    <div class="category text-center">
        <h1>All Category Wise Product</h1>
    </div>
    <div class="container">

        @foreach($categories as $category)
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $category->name }}</h3>

        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContentOne">
            <div class="tab-pane fade show active" id="tab-one_{{ $category->id }}" role="tabpanel" aria-labelledby="tab-one_{{ $category->id }}">
                <div class="row product-grid-4">
                    @php
                        $allCatProduct = \App\Models\Product::where('status',1)->where('category_id',$category->id)->latest()->limit(5)->get();
                     @endphp
                    @foreach($allCatProduct as $item)

                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap" >
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                        <img class="default-img"  src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" />
                                        <img class="hover-img"  src="{{ URL::to('') }}/uploads/products/hover/{{ $item->hover_image }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" id="{{ $item->id }}" onclick="addToWishlist(this.id)" class="action-btn" type="submit" ><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="AddToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    <a  onclick="SingleProductQuickView({{ $item->id }})" aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @php
                                        $discount_amount = $item->product_selling_price - $item->product_discount_price;
                                        $discount = $discount_amount/$item->product_selling_price * 100;
                                    @endphp
                                    @if($item->product_discount_price)
                                        <span class="hot">Save {{ round($discount) }}%</span>
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
                                    <span class="font-small text-muted">By <a href="#">{{ $item->vendor_id ? $item->vendor->name : 'Owner' }}</a></span>
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
                                        <a class="add" href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><i class="fa fa-search-plus"></i>Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->

                    @endforeach


                    <!--end product card-->

                </div>
                <!--End product-grid-4-->
            </div>


        </div>

        @endforeach


        <!--End tab-content-->
    </div>


</section>
<!--End TV Category -->


<!--End Computer Category -->


{{--// brand wise product--}}


{{--<section class="product-tabs section-padding position-relative">--}}
{{--    <div class="brand text-center">--}}
{{--        <h1>All Brand Wise Product</h1>--}}
{{--    </div>--}}
{{--    <div class="container">--}}

{{--        @foreach($brands as $brand)--}}
{{--            <div class="section-title style-2 wow animate__animated animate__fadeIn">--}}
{{--                <h3>{{ $brand->name }}</h3>--}}

{{--            </div>--}}
{{--            <!--End nav-tabs-->--}}
{{--            <div class="tab-content" id="myTabContent">--}}
{{--                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">--}}
{{--                    <div class="row product-grid-4">--}}
{{--                        @php--}}
{{--                            $allBrandProduct = \App\Models\Product::where('status',1)->where('brand_id',$brand->id)->latest()->limit(5)->get();--}}
{{--                        @endphp--}}
{{--                        @foreach($allBrandProduct as $item)--}}

{{--                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">--}}
{{--                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">--}}
{{--                                    <div class="product-img-action-wrap">--}}
{{--                                        <div class="product-img product-img-zoom">--}}
{{--                                            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">--}}
{{--                                                <img class="default-img"  src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" />--}}
{{--                                                <img class="hover-img"  src="{{ URL::to('') }}/uploads/products/hover/{{ $item->hover_image }}" alt="" />--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="product-action-1">--}}
{{--                                            <a aria-label="Add To Wishlist" id="{{ $item->id }}" onclick="addToWishlist(this.id)" class="action-btn" type="submit" ><i class="fi-rs-heart"></i></a>--}}
{{--                                            <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="AddToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>--}}
{{--                                            <a href="#" onclick="SingleProductQuickView({{ $item->id }})" aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>--}}
{{--                                        </div>--}}
{{--                                        <div class="product-badges product-badges-position product-badges-mrg">--}}
{{--                                            @php--}}
{{--                                                $discount_amount = $item->product_selling_price - $item->product_discount_price;--}}
{{--                                                $discount = $discount_amount/$item->product_selling_price * 100;--}}
{{--                                            @endphp--}}
{{--                                            @if($item->product_discount_price)--}}
{{--                                                <span class="hot">Save {{ round($discount) }}%</span>--}}
{{--                                            @else--}}
{{--                                                <span class="new">New</span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="product-content-wrap">--}}
{{--                                        <div class="product-category">--}}
{{--                                            <a href="#">{{ $item->category->name }}</a>--}}
{{--                                        </div>--}}
{{--                                        <h2><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a></h2>--}}
{{--                                        <div class="product-rate-cover">--}}
{{--                                            <div class="product-rate d-inline-block">--}}
{{--                                                <div class="product-rating" style="width: 90%"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="font-small ml-5 text-muted"> (4.0)</span>--}}
{{--                                        </div>--}}
{{--                                        <div>--}}
{{--                                            <span class="font-small text-muted">By <a href="#">{{ $item->vendor_id ? $item->vendor->name : 'Owner' }}</a></span>--}}
{{--                                        </div>--}}
{{--                                        <div class="product-card-bottom">--}}
{{--                                            <div class="product-price">--}}
{{--                                                @if($item->product_discount_price)--}}
{{--                                                    <span>{{ $item->product_discount_price + $item->vendor_charge }} BDT</span>--}}
{{--                                                    <span class="old-price">{{ $item->product_selling_price + $item->vendor_charge }} BDT</span>--}}
{{--                                                @else--}}
{{--                                                    <span>{{ $item->product_selling_price + $item->vendor_charge }} BDT</span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="add-cart">--}}
{{--                                                <a class="add" href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><i class="fa fa-search-plus"></i>Details </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end product card-->--}}

{{--                        @endforeach--}}


{{--                        <!--end product card-->--}}

{{--                    </div>--}}
{{--                    <!--End product-grid-4-->--}}
{{--                </div>--}}


{{--            </div>--}}

{{--        @endforeach--}}


{{--        <!--End tab-content-->--}}
{{--    </div>--}}


{{--</section>--}}
<!--End TV Category -->



<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">



                    @foreach($hot_deals as $item)
                    <article class="row align-items-center hover-up" >
                        <figure class="col-md-4 mb-0">
                            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img  src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a>
                            </h6>
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
                            <div class="product-price">
                                @if($item->product_discount_price)
                                    <span>{{ $item->product_discount_price + $item->vendor_charge }} ৳</span>
                                    <span class="old-price">{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                @else
                                    <span>{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                @endif
                            </div>
                        </div>
                    </article>


                    @endforeach


                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
                <div class="product-list-small animated animated">



                    @foreach($special_offers as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>
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
                                <div class="product-price">
                                    @if($item->product_discount_price)
                                        <span>{{ $item->product_discount_price + $item->vendor_charge }} ৳</span>
                                        <span class="old-price">{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                    @else
                                        <span>{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                    @endif
                                </div>
                            </div>
                        </article>

                    @endforeach

                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">



                    @foreach($recently_added as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>
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
                                <div class="product-price">
                                    @if($item->product_discount_price)
                                        <span>{{ $item->product_discount_price + $item->vendor_charge }} ৳</span>
                                        <span class="old-price">{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                    @else
                                        <span>{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                    @endif
                                </div>
                            </div>
                        </article>

                    @endforeach

                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">


                    @foreach($special_deals as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>
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
                                <div class="product-price">
                                    @if($item->product_discount_price)
                                        <span>{{ $item->product_discount_price + $item->vendor_charge }} ৳</span>
                                        <span class="old-price">{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                    @else
                                        <span>{{ $item->product_selling_price + $item->vendor_charge }} ৳</span>
                                    @endif
                                </div>
                            </div>
                        </article>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->

<!--Vendor List -->

<div class="container">

    <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
        <h3 class="">All Our Vendor List </h3>
        <a class="show-all" href="{{ route('vendor.shop.page') }}">
            All Vendors
            <i class="fi-rs-angle-right"></i>
        </a>
    </div>

    <div class="row vendor-grid">

            @foreach($vendors as $vendor)
                @php
                    $product_number = \App\Models\Product::where('status',1)->where('vendor_id',$vendor->id)->count();
                @endphp

        <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center">
            <div class="vendor-wrap mb-40">
                <div class="vendor-img-action-wrap">
                    <div class="vendor-img">
                        <a href="{{ route('vendor.details',$vendor->id) }}">
                            <img class="default-img" src="{{ $vendor->photo ? 'AdminBackend/upload/admin/'.$vendor->photo : 'AdminBackend/upload/vendor/avatar.jpg' }}" alt="" />
                        </a>
                    </div>
                    <div class="product-badges product-badges-position product-badges-mrg">
                        <span class="hot">Mall</span>
                    </div>
                </div>
                <div class="vendor-content-wrap" >
                    <div class="d-flex justify-content-between align-items-end mb-30" >
                        <div>
                            <div class="product-category">
                                <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                            </div>
                            <h4 class="mb-5"><a href="{{ route('vendor.details',$vendor->id) }}">{{ $vendor->name }}</a></h4>
                            <div class="product-rate-cover">

                                <span class="font-small total-product">{{ $product_number }} products</span>
                            </div>
                        </div>

                    </div>
                    <div class="vendor-info mb-30">
                        <ul class="contact-infor text-muted">

                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                        </ul>
                    </div>
                    <a href="{{ route('vendor.details',$vendor->id) }}" class="btn btn-xs">Visit Store <i class="fi-rs-arrow-small-right"></i></a>
                </div>
            </div>
        </div>




@endforeach






    </div>
</div>





@endsection
