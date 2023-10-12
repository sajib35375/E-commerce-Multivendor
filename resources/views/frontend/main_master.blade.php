<!DOCTYPE html>
<html class="no-js" lang="en">
@php
    $seo = \App\Models\Seo::find(1);
@endphp
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keywords" content="{{ $seo->meta_keywords }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/toastr.min.css') }}" />

</head>

<body>

<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- Header  -->
@include('frontend.body.header')
<!-- Quick view -->
{{--<style>--}}
{{--    #loader {--}}
{{--        display: none;--}}
{{--        position: fixed;--}}
{{--        top: 0;--}}
{{--        left: 0;--}}
{{--        right: 0;--}}
{{--        bottom: 0;--}}
{{--        width: 100%;--}}
{{--        background: rgba(0,0,0,0.75) url({{ asset('frontend/assets/imgs/theme/loading.gif') }}) no-repeat center center;--}}
{{--        z-index: 99999;--}}
{{--    }--}}
{{--</style>--}}

{{--<div id="loader"></div>--}}

<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" id="modalRemove" class="btn-close" ></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div id="thumbnail">
                                <img id="img" src="" alt=""/>
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            <span class="stock-status out-stock" id="stock">  </span>
                            <h3 class="title-detail"><a href="#" id="product_name" class="text-heading"></a></h3>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                </div>
                            </div>

                            <div id="color_display"  class="attr-detail attr-size mb-20">
                                <strong class="mr-10">Color: </strong>
                                <select style="border: 1px solid #e9e9e9" id="color" class="from-control">


                                </select>
                            </div>

                            <div id="size_display"  class="attr-detail attr-size mb-20">
                                <strong class="mr-10">Size: </strong>
                                <select style="border: 1px solid #e9e9e9" id="size" class="from-control">



                                </select>
                            </div>

                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span id="discount_price" class="current-price text-brand"></span>
                                    <span>
                                            <span id="regular_price" class="old-price font-md ml-15 "></span>
                                        </span>
                                </div>
                            </div>
                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="quantity" id="quantity" class="qty-val" value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <input id="product_id" type="hidden">
                                    <input id="vendor_id" type="hidden">
                                    <button type="submit" onclick="addToCart()" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            <div class="font-xs">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul>
                                            <li class="mb-5">Brand: <span class="text-brand" id="brand"></span></li>
                                            <li class="mb-5">Category:<span class="text-brand" id="category"></span></li>
                                        </ul>

                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <li class="mb-5">Stock:<span id="available" style="color: white; background-color: green;" class="text-brand badge badge-pill" ></span><span id="stockOut" style="color: white; background-color: red;" class="text-brand badge badge-pill"></span> </li>
                                            <li class="mb-5">Vendor Name:<span class="text-brand" id="vendor"> </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<main class="main">

    <!--End Vendor List -->
@yield('main')




</main>







@include('frontend.body.footer')
<!-- Preloader Start -->




<script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/app.js') }}"></script>
<script src="{{ asset('frontend/script.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/slider-range.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
<script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('frontend/assets/js/toastr.min.js') }}"></script>
<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
<!-- Template  JS -->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });


    // quick view
    function SingleProductQuickView(id){
        let main_url = "http://localhost:8000/";
        $.ajax({
            url : main_url + "quick/view/load/"+id,
            type : "GET",
            dataType : "json",
            success : function (data){
                $('#quickViewModal').modal('show');
                // add to cart info
                $('#quantity').val();
                $('#product_id').val(data.product.id);
                $('#product_name').html(data.product.product_name);
                $('#brand').html(data.product.brand.name);
                $('#category').html(data.product.category.name);
                $('#code').html(data.product.product_code);
                // product image
                $('#thumbnail #img').attr('src','');
                $('#thumbnail #img').attr('src',main_url+'uploads/products/thumbnail/'+data.product.product_thumbnail);
                // color and size
                $('select#color').html('');
                $('select#color').append(`<option value="">-Choose-</option>`);
                $.each(data.color,function (key,value){
                    $('select#color').append(`<option value="${value}">${value}</option>`);
                });
                $('select#size').html('');
                $('select#size').append(`<option value="">-Choose-</option>`);
                $.each(data.size,function (key,value){
                    $('select#size').append(`<option value="${value}">${value}</option>`);
                });

                if (data.product.vendor_id){
                    $('#vendor_id').val(data.product.vendor_id)
                }else{
                    $('#vendor_id').val(0)
                }

                // product price
                if (data.product.product_discount_price){
                    $('#regular_price').empty();
                    $('#discount_price').empty();
                    var discount_amount = Number(data.product.product_discount_price) + Number(data.product.vendor_charge);
                    var selling_amount = Number(data.product.product_selling_price) + Number(data.product.vendor_charge);

                    $('#regular_price').html(selling_amount+' ৳');
                    $('#discount_price').html(discount_amount+' ৳');
                }else{
                    $('#regular_price').empty();
                    $('#discount_price').empty();
                    var discount_amount = '';
                    var selling_amount = Number(data.product.product_selling_price) + Number(data.product.vendor_charge);
                    $('#discount_price').html(selling_amount+' ৳');
                    $('#regular_price').html(discount_amount);
                }
                // product stock
                if (data.product.product_qty > 0){
                    $('#available').text('');
                    $('#stockOut').text('');
                    $('#available').text('In Stock')
                }else{
                    $('#available').text('');
                    $('#stockOut').text('');
                    $('#stockOut').text('Stock Out')
                }
                // color area
                if (data.product.product_color){
                    $('#color_display').show();
                }else{
                    $('#color_display').hide();
                }
                // size area
                if (data.product.product_size){
                    $('#size_display').show();
                }else{
                    $('#size_display').hide();
                }
                // vendor
                if (data.product.vendor){
                    $('#vendor').html(data.product.vendor.name);
                }else {
                    $('#vendor').html(null);
                }

            }
        });

    }
    // add to cart

    $(document).on('click','#modalRemove',function (e){
        e.preventDefault();

        $('#thumbnail #img').attr('src','');
        $('#quickViewModal').modal('hide');
    })

    function addToCart(){
        let name = $('#product_name').text();
        let id = $('#product_id').val();
        let quantity = $('#quantity').val();
        let color = $('select#color option:selected').val();
        let size = $('select#size option:selected').val();
        let main_url = "http://localhost:8000/";
        let vendor_id = $('#vendor_id').val();

        $.ajax({
            url: main_url + "product/add/to/cart/"+id,
            type: "POST",
            dataType: "json",
            data: { name:name, quantity:quantity, color:color, size:size, vendor_id:vendor_id },
            success: function (data){

                miniCart();
                $('#modalRemove').click();
                const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if( $.isEmptyObject(data.error) ){
                    Toast.fire({
                        type : 'success',
                        icon: 'success',
                        title : data.success,
                    });
                }else{
                    Toast.fire({
                        type : 'error',
                        icon: 'error',
                        title : data.error,
                    });
                }
            }
        })
    }





</script>


<script>
    function miniCart(){
        let main_url = "http://localhost:8000/";
        $.ajax({
            url: main_url + "product/add/to/mini/cart",
            type: "GET",
            dataType: "json",
            success: function (data){
                $('.miniCount').text(data.cart_qty);
                $('#subTotal').text(data.cart_total+ ' ৳');

                var miniCart = '';
                $.each(data.carts,function (key,value){
                    miniCart += `
                    <ul>
                        <li>
                            <div class="shopping-cart-img">
                                <a href="#"><img alt="Nest" src="${main_url}uploads/products/thumbnail/${value.options.photo}" /></a>
                            </div>
                            <div class="shopping-cart-title">
                                <h4><a href="shop-product-right.html">${value.name}</a></h4>
                                <h4> <span class="mini_qty">${value.qty}</span> <span>×</span>${value.price} ৳</h4>
                            </div>
                            <div class="shopping-cart-delete">
                                <a type="submit" id="${value.rowId}" onclick="removeMiniCart(this.id)" ><i class="fi-rs-cross-small"></i></a>
                            </div>
                        </li>

                    </ul>

                    `

                });$('#miniCartLoad').html(miniCart)
            }
        })
    }

    miniCart();


    function removeMiniCart(rowId){
        let main_url = "http://localhost:8000/";
        $.ajax({
            url: main_url + "product/remove/mini/cart/"+rowId,
            type: "GET",
            dataType: "json",
            success: function (data){
                miniCart();
                cartPageLoad();
                CartPageCalculation();
                const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if( $.isEmptyObject(data.error) ){
                    Toast.fire({
                        type : 'success',
                        icon: 'success',
                        title : data.success,
                    });
                }else{
                    Toast.fire({
                        type : 'error',
                        icon: 'error',
                        title : data.error,
                    });
                }
            }
        })
    }


    function singleAddToCart(){

        let main_url = "http://localhost:8000/";
        let name = $('#single_product_name').text();
        let quantity = $('#singleQty').val();
        let color = $('select#single_color option:selected').val();
        let size = $('select#single_size option:selected').val();
        let id = $('#single_product_id').val();
        let vendor_id = $('#vendor').val();

        $.ajax({
            url: main_url + "single/addTo/cart",
            type: "POST",
            dataType: 'json',
            data: { name:name,quantity:quantity,color:color,size:size,id:id,vendor_id:vendor_id },
            success: function (data){

                miniCart();
                const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if( $.isEmptyObject(data.error) ){
                    Toast.fire({
                        type : 'success',
                        icon: 'success',
                        title : data.success,
                    });
                }else{
                    Toast.fire({
                        type : 'error',
                        icon: 'error',
                        title : data.error,
                    });
                }
            }
        });
    }

    function addToWishlist(id){
        let main_url = "http://localhost:8000/";
        $.ajax({
            url: main_url + "addTo/Wishlist/"+id,
            type: "POST",
            dataType: "json",
            success: function (data){
                loadWishList();
                const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if( $.isEmptyObject(data.error) ){
                    Toast.fire({
                        type : 'success',
                        icon: 'success',
                        title : data.success,
                    });
                }else{
                    Toast.fire({
                        type : 'error',
                        icon: 'error',
                        title : data.error,
                    });
                }
            }
        })
    }



    function loadWishList(){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/load/Wishlist/",
            type: "GET",
            dataType: "json",
            success: function (data){
                $('.wishCount').text(data.length);
                let wish = '';
                $.each(data,function (key,value){

                    wish += `
                        <tr class="pt-30">
                            <td class="custome-checkbox pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                <label class="form-check-label" for="exampleCheckbox1"></label>
                            </td>
                            <td class="image product-thumbnail pt-40"><img src="${main_url}/uploads/products/thumbnail/${value.product.product_thumbnail}" alt="#" /></td>
                            <td class="product-des product-name">
                                <h6><a class="product-name mb-10" href="#">${value.product.product_name}</a></h6>

                            </td>
                            <td class="price" data-title="Price">
                                <h3 class="text-brand">${value.product.actual_price} ৳</h3>
                            </td>
                            <td class="text-center detail-info" data-title="Stock">



 ${ value.product.product_qty ? `<span class="stock-status in-stock mb-0">In Stock</span>`:`<span class="stock-status out-stock mb-0">Stock Out</span>` }





                            </td>
                            <td class="text-right" data-title="Cart">
                                <button aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" type="submit" onclick="SingleProductQuickView(${value.product.id})" class="btn btn-sm">Add to cart</button>
                            </td>
                            <td class="action text-center" data-title="Remove">
                                <a id="${value.product.id}" onclick="removeProWish(this.id)" href="#" class="text-body"><i class="fi-rs-trash"></i></a>
                            </td>
                        </tr>

                    `
                });$('#wishLoad').html(wish)
            }
        })
    }

    loadWishList();



    function removeProWish(id){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/remove/wishlist/product/"+id,
            type: "GET",
            dataType: "json",
            success: function (data){
                loadWishList();
                const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if( $.isEmptyObject(data.error) ){
                    Toast.fire({
                        type : 'success',
                        icon: 'success',
                        title : data.success,
                    });
                }else{
                    Toast.fire({
                        type : 'error',
                        icon: 'error',
                        title : data.error,
                    });
                }
            }
        })
    }

    function AddToCompare(id){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/compare/add/"+id,
            type: "GET",
            dataType: "json",
            success: function (data){
                AllCompareProduct()
                const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if( $.isEmptyObject(data.error) ){
                    Toast.fire({
                        type : 'success',
                        icon: 'success',
                        title : data.success,
                    });
                }else{
                    Toast.fire({
                        type : 'error',
                        icon: 'error',
                        title : data.error,
                    });
                }
            }
        })
    }



    function AllCompareProduct(){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/compare/show/",
            type: "GET",
            dataType: 'json',
            success: function (data){
                $('.compareCount').text(data.length);
                $('#compareCount').text(data.length);
                var row = '';
                $.each(data,function (key,value){
                    row += `
                    <tr class="pr_image">
                            <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
                            <td class="row_img"><img style="height: 200px;width: 200px;" src="${main_url}/uploads/products/thumbnail/${value.product.product_thumbnail}" alt="compare-img" /></td>

                        </tr>
                        <tr class="pr_title">
                            <td class="text-muted font-sm fw-600 font-heading">Name</td>
                            <td class="product_name">
                                <h6><a href="#" class="text-heading">${ value.product.product_name }</a></h6>
                            </td>

                        </tr>
                        <tr class="pr_price">
                            <td class="text-muted font-sm fw-600 font-heading">Price</td>
                            <td class="product_price">
                                <h4 class="price text-brand">${ value.product.actual_price } ৳</h4>
                            </td>

                        </tr>


                        <tr class="pr_stock">
                            <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                            ${ value.product.product_qty != 0 ? `<td class="row_stock"><span class="stock-status in-stock mb-0">In Stock</span></td>` : `<td class="row_stock"><span class="stock-status out-stock mb-0">Out of stock</span></td>` }



                        </tr>
                        <tr class="pr_weight">
                            <td class="text-muted font-sm fw-600 font-heading">Size</td>
                            <td class="row_weight">${value.product.product_size}</td>

                        </tr>

                        <tr class="pr_add_to_cart">
                            <td class="text-muted font-sm fw-600 font-heading">Buy now</td>
${ value.product.product_qty >0 ? `<td class="row_btn">
                                <button id="${value.product.id}" onclick="SingleProductQuickView(this.id)" aria-label="Quick view"  data-bs-toggle="modal" data-bs-target="#quickViewModal" class="btn btn-sm btn-success"><i class="fi-rs-shopping-bag mr-5"></i>Add to cart</button>
                            </td>` : `<td class="row_btn">
                                <button class="btn btn-sm btn-secondary"><i class="fi-rs-headset mr-5"></i>Contact Us</button>
                            </td>` }




                        </tr>
                        <tr class="pr_remove text-muted">
                            <td class="text-muted font-md fw-600"></td>
                            <td class="row_remove">
                                <a id="${value.product.id}" onclick="compareRemove(this.id)" class="text-muted"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                            </td>

                        </tr>

                    `
                });$('#compareProducts').html(row)
            }
        })
    }


    AllCompareProduct()


    function compareRemove(id){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/compare/remove/"+id,
            type: "GET",
            dataType: "json",
            success: function (data){
                AllCompareProduct()
                const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if( $.isEmptyObject(data.error) ){
                    Toast.fire({
                        type : 'success',
                        icon: 'success',
                        title : data.success,
                    });
                }else{
                    Toast.fire({
                        type : 'error',
                        icon: 'error',
                        title : data.error,
                    });
                }
            }
        })
    }


    function cartPageLoad(){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/cart/page/load/",
            type: "GET",
            dataType: "json",
            success: function (data){
                $('.cart-count').html(data.cartQty)
                let rows = '';
                $.each(data.carts,function (key,value){
                    rows += `
                    <tr class="pt-30">
                            <td class="custome-checkbox pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                <label class="form-check-label" for="exampleCheckbox1"></label>
                            </td>
                            <td class="image product-thumbnail pt-40"><img src="${main_url}/uploads/products/thumbnail/${value.options.photo}" alt="#"></td>
                            <td class="product-des product-name">
                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="#">${value.name}</a></h6>

                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-body">${value.price} ৳</h4>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-body">${ value.options.color == '-Choose-' ? '...' : value.options.color } </h4>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-body">${ value.options.size == '-Choose-' ? '...' :  value.options.size } </h4>
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <div class="detail-extralink mr-15">
                                    <div class="detail-qty border radius">
                                        <a type="submit" id="${value.rowId}" onclick="cartDecrement(this.id)" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="qty" class="qty-val"  value="${value.qty}" min="1">
                                        <a type="submit" id="${value.rowId}" onclick="cartIncrement(this.id)" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-brand">${value.price * value.qty } ৳</h4>
                            </td>
                            <td class="action text-center" id="${value.rowId}" onclick="removeCart(this.id)" data-title="Remove"><a href="#" class="text-body"><i class="fi-rs-trash"></i></a></td>
                        </tr>


                    `
                });$('#cart_product').html(rows);
            }
        })
    }

    cartPageLoad();


    function cartDecrement(rowId) {
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/cart/decrement/" + rowId,
            type: "GET",
            dataType: "json",
            success: function (data) {
                CartPageCalculation()
                miniCart();
                cartPageLoad();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });

                }
            }
        })
    }


    function cartIncrement(rowId){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/cart/increment/" + rowId,
            type: "GET",
            dataType: "json",
            success: function (data) {
                CartPageCalculation()
                miniCart();
                cartPageLoad();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });

                }
            }
        })
    }



    function removeCart(rowId){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/cart/remove/"+ rowId,
            type: "GET",
            dataType: "json",
            success: function (data){
                miniCart();
                cartPageLoad();
                CartPageCalculation();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });

                }
            }
        })
    }
</script>


<script>

    $(document).on('change','select[name="division"]',function (e){
        e.preventDefault();
        let id = $(this).val();
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/cart/district/select/"+id,
            type: "GET",
            dataType: "json",
            success: function (data){
                CartPageCalculation();
                $('select[name="district"]').empty();
                $.each(data,function (key,value){
                    $('select[name="district"]').append('<option value="'+value.id+'">'+value.district_name+'</option>')
                })
            }
        })
    });

    $(document).on('change','select[name="district"]',function (e){
        e.preventDefault();
        let id = $(this).val();
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/cart/state/select/"+id,
            type: "GET",
            dataType: "json",
            success: function (data){
                $('select[name="state"]').empty();
                $('select[name="delivery_charge"]').empty();
                $.each(data,function (key,value){
                    $('select[name="state"]').append('<option value="'+value.id+'">'+value.state_name+'</option>')
                    $('select[name="delivery_charge"]').append('<option value="'+value.id+'">'+value.delivery_charge+'</option>')
                })
            }
        })
    });


    $(document).on('change','select[name="state"]',function (e){
        e.preventDefault();
        let id = $(this).val();
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/cart/charge/select/"+id,
            type: "GET",
            dataType: "json",
            success: function (data){
                CartPageCalculation();
                $('select[name="delivery_charge"]').empty();
                $('select[name="delivery_charge"]').append('<option value="'+data.id+'">'+data.delivery_charge+'</option>')

            }
        })
    })



    function couponApply(){
        let coupon_name = $('#coupon_name').val();
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/coupon/apply",
            type: "POST",
            dataType: "json",
            data: { coupon_name:coupon_name },
            success: function (data){
                CartPageCalculation();
                const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if( $.isEmptyObject(data.error) ){
                    Toast.fire({
                        type : 'success',
                        icon: 'success',
                        title : data.success,
                    });
                }else{
                    Toast.fire({
                        type : 'error',
                        icon: 'error',
                        title : data.error,
                    });
                }
            }
        })
    }

    function CartPageCalculation(){
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/cart/page/cal",
            type: "GET",
            dataType: "json",
            success: function (data){

                $('#calculation').html('');
                if(data.total && data.delivery_charge){
                    $('#calculation').html(`



                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${ data.delivery_charge ? data.total : '' } ৳</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Shipping</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-heading text-end text-success">${ data.delivery_charge ? data.delivery_charge : '' } ৳</h4></td> </tr> <tr>

                                         </tr> <tr>

                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${ data.delivery_charge ? Number(data.delivery_charge) + Number(data.total) : '' } ৳</h4>
                                        </td>
                                    </tr>


                `);
                }else{
                    $('#calculation').html(`
                            <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${ data.delivery_charge ? data.amount : '' } ৳</h4>
                                        </td>
                                    </tr>

                <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${ data.delivery_charge ? data.grand_total: '' } ৳</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Shipping</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-heading text-end text-success">${ data.delivery_charge ? data.delivery_charge : '' } ৳</h4></td> </tr> <tr>

                                         </tr> <tr>

                                    </tr>

                                     <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon Name</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-heading text-end text-success">${ data.delivery_charge ? data.coupon_name : '' } <a type="submit" id="coupon_delete" ><i class="fa fa-trash"></i></a> </h4></td> </tr> <tr>

                                         </tr> <tr>

                                    </tr>

                                        <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Discount Amount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-heading text-end text-success">${ data.delivery_charge ? data.discount_total : '' } ৳</h4></td> </tr> <tr>

                                         </tr> <tr>

                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${ data.delivery_charge ? Number(data.grand_total) + Number(data.delivery_charge) : '' } ৳</h4>
                                        </td>
                                    </tr>


                `);
                }
            }
        })
    }

    CartPageCalculation();


    $(document).on('click','#coupon_delete',function (e){
        e.preventDefault();
        let main_url = "http://localhost:8000";
        $.ajax({
            url: main_url + "/remove/coupon",
            type: "GET",
            dataType: "json",
            success: function (data){
                CartPageCalculation();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                });
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });

                }
            }
        })
    })

</script>

</body>

</html>
