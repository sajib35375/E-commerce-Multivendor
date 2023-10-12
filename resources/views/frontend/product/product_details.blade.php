@extends('frontend.main_master')
@section('main')
    @section('title')
        {{ $details->product_name }}
    @endsection

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span>{{ $details->category->name }}</span> <a href="#">{{ $details->subcategory->sub_name }}</a> <span></span> {{ $details->product_name }}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    @foreach($multiImg as $img)
                                    <figure class="border-radius-10">
                                        <img src="{{ URL::to('') }}/uploads/products/multi/{{ $img->photo }}" alt="product image" />
                                    </figure>
                                    @endforeach
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    @foreach($multiImg as $img)
                                    <div><img src="{{ URL::to('') }}/uploads/products/multi/{{ $img->photo }}" alt="product image" /></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                @if($details->product_qty>0)
                                    <span class="stock-status in-stock"> In Stock  </span>
                                    @else
                                <span class="stock-status out-stock"> Out Stock  </span>
                                @endif
                                <h2 class="title-detail" id="single_product_name">{{ $details->product_name }}</h2>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">

                                            @php
                                                $review = \App\Models\Review::where('product_id',$details->id)->where('status',1)->avg('quality');
                                            @endphp
                                            <div class="product-rate d-inline-block">
                                                @if(round($review)==1)
                                                    <div class="product-rating" style="width: 20%"></div>
                                                @elseif(round($review)==2)
                                                    <div class="product-rating" style="width: 40%"></div>
                                                @elseif(round($review)==3)
                                                    <div class="product-rating" style="width: 60%"></div>
                                                @elseif(round($review)==4)
                                                    <div class="product-rating" style="width: 80%"></div>
                                                @elseif(round($review)==5)
                                                    <div class="product-rating" style="width: 100%"></div>
                                                @endif


                                        </div>
                                        @php
                                            $count = \App\Models\Review::where('product_id',$details->id)->count();
                                        @endphp
                                        <span class="font-small ml-5 text-muted"> ({{ $count }} reviews)</span>
                                    </div>
                                </div>
                                @php
                                    $discount_amount = $details->product_selling_price - $details->product_discount_price;
                                    $amount = $discount_amount/$details->product_selling_price*100;
                                @endphp
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        @if(!$details->product_discount_price)
                                            <span class="current-price text-brand">{{ $details->product_selling_price + $details->vendor_charge }} ৳</span>
                                            @else

                                        <span>
                                                <span class="save-price font-md color3 ml-15">{{ round($amount) }}% Off</span>
                                                <span class="old-price font-md ml-15">{{ $details->product_selling_price + $details->vendor_charge }} ৳</span>
                                            <span class="current-price text-brand">{{ $details->product_discount_price + $details->vendor_charge }} ৳</span>
                                            </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">{{ $details->short_desc }}</p>
                                </div>

                                    @if($details->product_size)
                                <div class="attr-detail attr-size mb-10">
                                    <strong class="mr-10">Size / Weight: </strong>
                                    <ul class="list-filter size-filter font-small">
                                        @php
                                            $sizes = explode(',',$details->product_size)
                                        @endphp

                                        @if($details->product_size)
                                            <select class="form-control" style="width: 200px;height: 35px;" name="size" id="single_size">
                                                <option value="">-Choose-</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size }}">{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                    </ul>
                                </div>
                                    @endif
                                    @if($details->product_color)
                                    <div  class="attr-detail attr-size mb-20">
                                        <strong class="mr-10">Color: </strong>
                                        <ul class="list-filter size-filter font-small">
                                            @php
                                                $colors = explode(',',$details->product_color)
                                            @endphp

                                            @if($details->product_color)

                                                    <select class="form-control" style="width: 200px;height: 35px;" name="color" id="single_color">
                                                        <option value="">-Choose-</option>
                                                        @foreach($colors as $color)
                                                            <option value="{{ $color }}">{{ $color }}</option>
                                                        @endforeach
                                                        </select>
                                            @endif

                                        </ul>
                                    </div>
                                    @endif
                                <div class="detail-extralink mb-50">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" id="singleQty" class="qty-val" value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <input value="{{ $details->id }}" id="single_product_id" type="hidden">
                                        <input value="{{ $details->vendor_id ? $details->vendor_id : null }}" id="vendor" type="hidden">
                                        <button type="button" onclick="singleAddToCart()" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" id="{{ $details->id }}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" id="{{ $details->id }}" onclick="AddToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                </div>




                                <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        <li class="mb-5">Brand: <span class="text-brand">{{ $details->brand->name }}</span></li>
                                        <li class="mb-5">Category:<span class="text-brand">{{ $details->category->name }}</span></li>
                                        <li>Sub Category: <span class="text-brand">{{ $details->subcategory->sub_name }}</span></li>
                                    </ul>
                                    <ul class="float-start">
                                        <li class="mb-5">Product Code: <a href="#">{{ $details->product_code }}</a></li>

                                        <li class="mb-5">Tags:
                                            @php
                                                $tags = explode(',',$details->product_tags);
                                            @endphp
                                            @foreach($tags as $tag)
                                            <a href="#" rel="tag">{{ $tag }}</a>,
                                        @endforeach

                                        <li>Stock:<span class="in-stock text-brand ml-5">{{ $details->product_qty }} Items In Stock</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>{!! $details->long_desc !!}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                        <tr class="stand-up">
                                            <th>Stand Up</th>
                                            <td>
                                                <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-wo-wheels">
                                            <th>Folded (w/o wheels)</th>
                                            <td>
                                                <p>32.5″L x 18.5″W x 16.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-w-wheels">
                                            <th>Folded (w/ wheels)</th>
                                            <td>
                                                <p>32.5″L x 24″W x 18.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="door-pass-through">
                                            <th>Door Pass Through</th>
                                            <td>
                                                <p>24</p>
                                            </td>
                                        </tr>
                                        <tr class="frame">
                                            <th>Frame</th>
                                            <td>
                                                <p>Aluminum</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-wo-wheels">
                                            <th>Weight (w/o wheels)</th>
                                            <td>
                                                <p>20 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-capacity">
                                            <th>Weight Capacity</th>
                                            <td>
                                                <p>60 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="width">
                                            <th>Width</th>
                                            <td>
                                                <p>24″</p>
                                            </td>
                                        </tr>
                                        <tr class="handle-height-ground-to-handle">
                                            <th>Handle height (ground to handle)</th>
                                            <td>
                                                <p>37-45″</p>
                                            </td>
                                        </tr>
                                        <tr class="wheels">
                                            <th>Wheels</th>
                                            <td>
                                                <p>12″ air / wide track slick tread</p>
                                            </td>
                                        </tr>
                                        <tr class="seat-back-height">
                                            <th>Seat back height</th>
                                            <td>
                                                <p>21.5″</p>
                                            </td>
                                        </tr>
                                        <tr class="head-room-inside-canopy">
                                            <th>Head room (inside canopy)</th>
                                            <td>
                                                <p>25″</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_color">
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Red, White</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_size">
                                            <th>Size</th>
                                            <td>
                                                <p>M, S</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="tab-pane fade" id="Vendor-info">
                                    @if($details->vendor_id == NULL)
                                        <div class="vendor-logo d-flex mb-30">
                                            <img src="{{ URL::to('') }}/AdminBackend/upload/admin/avatar.jpg" alt="" />
                                            <div class="vendor-name ml-15">


                                                    <h6>
                                                        <a class="text-danger" href="#">Owner</a>
                                                    </h6>


                                                <div class="product-rate-cover text-end">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                                </div>
                                            </div>
                                        </div>



                                        <ul class="contact-infor mb-50">
                                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>Owner</span></li>
                                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Contact Seller:</strong><span>+8801779435375</span></li>
                                        </ul>
                                        <div class="d-flex mb-55">
                                            <div class="mr-30">
                                                <p class="text-brand font-xs">Rating</p>
                                                <h4 class="mb-0">92%</h4>
                                            </div>
                                            <div class="mr-30">
                                                <p class="text-brand font-xs">Ship on time</p>
                                                <h4 class="mb-0">100%</h4>
                                            </div>
                                            <div>
                                                <p class="text-brand font-xs">Chat response</p>
                                                <h4 class="mb-0">89%</h4>
                                            </div>
                                        </div>
                                        <p class="text-danger">Owner Information</p>
                                </div>
                                    @else
                                    <div class="vendor-logo d-flex mb-30">
                                        <img src="{{ $details->vendor_id == NULL ? '/AdminBackend/upload/admin/avatar.jpg' : '/AdminBackend/upload/admin/'.$details->vendor->photo }}" alt="" />
                                        <div class="vendor-name ml-15">

                                            @if($details->vendor_id)
                                                <h6>
                                                   <a href="#">{{ $details->vendor->name }}</a>
                                                </h6>
                                            @else
                                                <h6>
                                                    <a href="#">Owner</a>
                                                </h6>
                                                @endif

                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                            </div>
                                        </div>
                                    </div>



                                    <ul class="contact-infor mb-50">
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>{{ $details->vendor->address }}</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Contact Seller:</strong><span>{{ $details->vendor->phone }}</span></li>
                                    </ul>
                                    <div class="d-flex mb-55">
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Rating</p>
                                            <h4 class="mb-0">92%</h4>
                                        </div>
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Ship on time</p>
                                            <h4 class="mb-0">100%</h4>
                                        </div>
                                        <div>
                                            <p class="text-brand font-xs">Chat response</p>
                                            <h4 class="mb-0">89%</h4>
                                        </div>
                                    </div>
                                    <p>{{ $details->vendor->vendor_info }}</p>
                                </div>
                                @endif
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                @php
                                                    $all_review = \App\Models\Review::with('user')->where('status',1)->where('product_id',$details->id)->latest()->limit(5)->get();
                                                @endphp
                                                    @foreach($all_review as $item)
                                                    <div class="single-comment justify-content-between d-flex mb-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ $item->user->photo ? 'http://localhost:8000/uploads/user/'.$item->user->photo : 'http://localhost:8000/uploads/no_image.jpg' }}" alt="" />
                                                                <a href="#" style="margin-right: 0px;display: block;" class="font-heading text-brand">{{ $item->user->name }}</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">{{ date('d, F Y',strtotime($item->created_at)) }}</span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block" style="display: block;margin-left: 400px;">
                                                                        @php
                                                                            $user_review = \App\Models\Review::find($item->id);
                                                                        @endphp

                                                                            @if($user_review->quality==1)
                                                                                <div class="product-rating" style="width: 20%"></div>
                                                                            @elseif($user_review->quality==2)
                                                                                <div class="product-rating" style="width: 40%"></div>
                                                                            @elseif($user_review->quality==3)
                                                                                <div class="product-rating" style="width: 60%"></div>
                                                                            @elseif($user_review->quality==4)
                                                                                <div class="product-rating" style="width: 80%"></div>
                                                                            @elseif($user_review->quality==5)
                                                                                <div class="product-rating" style="width: 100%"></div>
                                                                            @endif
                                                                        @php
                                                                            $count = \App\Models\Review::find($item->id);
                                                                        @endphp
                                                                        <span class="font-small ml-5 text-muted"> ({{ $count->quality }})</span>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">{{ $item->comment }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @endforeach


                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->

                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>

                                        <div class="row">

                                            @auth
                                            <div class="col-lg-8 col-md-12">

                                                <form class="form-contact comment_form" action="{{ route('product.review') }}" id="commentForm" method="POST">
                                                    @csrf

                                                    <div class="row">
                                                        <input name="product_id" value="{{ $details->id }}" type="hidden">
                                                        <input name="vendor_id" value="{{ $details->vendor_id ? $details->vendor_id : '' }}" type="hidden">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="rating-container">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="col-span-1">&nbsp;</th>
                                                                            <th >Star Rate 1</th>
                                                                            <th >Star Rate 2</th>
                                                                            <th >Star Rate 3</th>
                                                                            <th >Star Rate 4</th>
                                                                            <th >Star Rate 5</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="col-span-1">Quality</td>
                                                                            <td><input name="quality" value="1" type="radio"></td>
                                                                            <td><input name="quality" value="2" type="radio"></td>
                                                                            <td><input name="quality" value="3" type="radio"></td>
                                                                            <td><input name="quality" value="4" type="radio"></td>
                                                                            <td><input name="quality" value="5" type="radio"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    @error('quality')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                            @error('comment')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>



                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit Review</button>
                                                    </div>

                                                </form>
                                            </div>

                                            @else
                                                <p>For Comment You have to <a class="text-danger" href="{{ route('login') }}">Login</a>First</p>
                                            @endauth


                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Related products</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                                @php
                                    $category_id = $details->category->id;
                                    $related = \App\Models\Product::where('status',1)->where('category_id',$category_id)->latest()->limit(4)->get();
                                @endphp
                                @foreach($related as $item)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6" style="margin-top: 20px;">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}" tabindex="0">
                                                    <img class="default-img" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="" />
                                                    <img class="hover-img" src="{{ URL::to('') }}/uploads/products/hover/{{ $item->hover_image }}" alt="" />
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
                                            <h2><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}" tabindex="0">{{ $details->product_name }}</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span> </span>
                                            </div>
                                            <div class="product-price">
                                                @if($item->product_discount_price)
                                                    <span>{{ $item->product_discount_price }} ৳</span>
                                                    <span class="old-price">{{ $item->product_selling_price }} ৳</span>
                                                @else
                                                    <span>{{ $item->product_selling_price }} ৳</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
