<header class="header-area header-style-1 header-height-2">

    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>

                            <li><a href="#">My Cart</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>

                            <li>
                                <a class="language-dropdown-active" href="#">English <i class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-fr.png') }}" alt="" />Français</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-dt.png') }}" alt="" />Deutsch</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-ru.png') }}" alt="" />Pусский</a>
                                    </li>
                                </ul>
                            </li>

                            <li>Need help? Call Us: <strong class="text-brand"> +8801779435375</strong></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $setting = \App\Models\SiteSetting::find(1);
    @endphp
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('index') }}"><img src="{{ URL::to('') }}/uploads/logo/{{ $setting->logo }}" alt="logo" /></a>
                </div>
                @php
                    $categories = \App\Models\Category::latest()->get();
                @endphp
                <div class="header-right">
                    <div class="search-style-2">
                        {{-- // search box--}}
                        <form action="{{ route('product.search') }}" method="POST">
                            @csrf
                            <select class="select-active">
                                <option>All Categories</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <input onfocus="search_product_show()" onblur="search_product_hide()" name="search" id="search"  placeholder="Search for items..." />
                            <div id="searchSuggestion"></div>
                        </form>

                    </div>
                    {{-- // search box--}}




                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="search-location">
                                <div class="header-action-icon-2">
                                    <a href="{{ route('compare.view') }}">
                                        <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/icon/icon-compare.svg') }}" />
                                        <span class="pro-count blue compareCount">0</span>
                                    </a>
                                    <a href="{{ route('compare.view') }}"><span class="lable">Compare</span></a>
                                </div>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist.page') }}">
                                    <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count blue wishCount" >0</span>
                                </a>
                                <a href="{{ route('wishlist.page') }}"><span class="lable">Wishlist</span></a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('cart.page') }}">
                                    <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span  class="pro-count blue miniCount" >0</span>
                                </a>
                                <a href="{{ route('cart.page') }}"><span class="lable">Cart</span></a>


                                {{--mini cart--}}
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">


                                    <div id="miniCartLoad"></div>



                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                             <h4>Total <span id="subTotal"><span></span></span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('cart.page') }}" class="outline">View cart</a>
                                            <a href="{{ route('checkout.page') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                                {{--mini cart end--}}

                            </div>
                            @auth
                            <div class="header-action-icon-2">
                                <a href="{{ route('user.dashboard') }}">
                                    <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                </a>
                                <a href="{{ route('user.dashboard') }}"><span class="lable ml-0">Account</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                    <ul>
                                        <li>
                                            <a href="{{ route('user.dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                        </li>
                                        <li>
                                            <a href="page-account.html"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                        </li>
                                        <li>
                                            <a href="page-account.html"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                        </li>
                                        <li>
                                            <a href="shop-wishlist.html"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="page-account.html"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.logout') }}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @else
                                <a href="#">
                                    <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                </a>
                                <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>|
                                <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="index.html"><img src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}" alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span>   All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>

                                    @foreach($categories as $cat)
                                    <li>
                                        <a href="{{ route('category.products',$cat->id) }}"> <img src="{{ URL::to('') }}/uploads/category/{{ $cat->category_image }}" alt="" />{{ $cat->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <ul class="end">
                                    @foreach($categories as $cat)
                                        <li>
                                            <a href="{{ route('category.products',$cat->id) }}"> <img src="{{ URL::to('') }}/uploads/category/{{ $cat->category_image }}" alt="" />{{ $cat->name }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>

                                <li>
                                    <a class="active" href="{{ route('index') }}">Home  </a>

                                </li>
                                @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('category.products',$cat->id) }}">{{ $cat->name }}<i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @php
                                            $subcategories = \App\Models\SubCategory::where('category_id',$cat->id)->latest()->get();
                                        @endphp
                                        @foreach($subcategories as $subcat)
                                        <li><a href="{{ route('subcategory.products',$subcat->id) }}">{{ $subcat->sub_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('blog.page') }}">Blog</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>


                <div class="hotline d-none d-lg-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
                    <p>+8801779435375<span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="shop-wishlist.html">
                                <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                <span class="pro-count white">4</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count white">2</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html"><img alt="Nest" src="{{ asset('frontend/assets/imgs/shop/thumbnail-3.jpg') }}" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                            <h3><span>1 × </span>$800.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html"><img alt="Nest" src="{{ asset('frontend/assets/imgs/shop/thumbnail-4.jpg') }}" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                            <h3><span>1 × </span>$3500.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>$383.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="shop-cart.html">View cart</a>
                                        <a href="shop-checkout.html">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    #searchSuggestion{
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #ffffff;
        border-radius: 8px;
        margin-top: 5px;
        z-index: 999;
    }
</style>

{{--<script>--}}
{{--    function search_product_show(){--}}
{{--        $('#searchSuggestion').slideDown();--}}
{{--    }--}}

{{--    function search_product_hide(){--}}
{{--        $('#searchSuggestion').slideUp();--}}
{{--    }--}}
{{--</script>--}}

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul>

                        <li>
                            <a class="active" href="{{ route('index') }}">Home</a>

                        </li>
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('category.products',$cat->id) }}">{{ $cat->name }}<i class="fi-rs-angle-down"></i></a>
                                <ul class="sub-menu">
                                    @php
                                        $subcategories = \App\Models\SubCategory::where('category_id',$cat->id)->latest()->get();
                                    @endphp
                                    @foreach($subcategories as $subcat)
                                        <li><a href="{{ route('subcategory.products',$subcat->id) }}">{{ $subcat->sub_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('blog.page') }}">Blog</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-marker"></i> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>|
                    <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.</div>
        </div>
    </div>
</div>
