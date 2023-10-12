@extends('frontend.main_master')
@section('main')
    @section('title')
        {{ $cat->name }} Category
    @endsection
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{ $cat->name }}</h1>
                        <div class="breadcrumb">
                            <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Category <span></span> {{ $cat->name }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($all_cat_pro) }}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">

                    </div>
                </div>
                <div class="row product-grid">


                    @foreach($all_cat_pro as $item)

                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                        <img class="default-img" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" />
                                        <img class="hover-img" src="{{ URL::to('') }}/uploads/products/hover/{{ $item->hover_image }}" alt="" />
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
                                        <span class="hot">{{ round($discount) }}%</span>
                                    @else
                                        <span class="new">New</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="#">{{ $cat->name }}</a>
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
                                    <span class="font-small text-muted">By @if($item->vendor_id) <a href="{{ route('vendor.details',$item->vendor->id) }}">{{ $item->vendor->name }}</a> @else <a href="#">Owner</a> @endif </span>
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
                                        <a class="add" href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">Details </a>
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


                {{ $all_cat_pro -> links('frontend.pagination.category_pagination') }}


                <!--End Deals-->


            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        @foreach($categories as $category)
                            @php
                                $pro_numb = \App\Models\Product::where('status',1)->where('category_id',$category->id)->count();
                            @endphp
                        <li>
                            <a href="{{ route('category.products',$category->id) }}"> <img src="{{ URL::to('') }}/uploads/category/{{ $category->category_image }}" alt="" />{{ $category->name }}</a><span class="count">{{ $pro_numb }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fill by price</h5>
                    <form action="{{ route('category.price.filter',$cat->id) }}" method="GET">
                        @csrf
                        <div class="price-filter mb-30">
                            <div class="price-filter-inner">
                                <label for="">Price Range</label>
                                <input name="price_range" min="0" max="10000" type="range">
                                <div class="d-flex justify-content-between">
                                    <div class="caption">From: <strong id="slider-range-value1" class="text-brand">0 BDT</strong></div>
                                    <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</button>
                    </form>
                    <div class="list-group">
                        <div class="list-group-item mb-10 mt-10">

                        </div>
                    </div>

                </div>
                <!-- Product sidebar Widget -->


            </div>
        </div>
    </div>

@endsection
