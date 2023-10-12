@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Bengal eCommerce</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Product</h5>
                <hr/>
                <div class="form-body mt-4">

                    <form id="myForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">

                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">
                                <div class="form-group mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="inputProductTitle" placeholder="Enter product Name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Selling Price</label>
                                    <input type="text" name="product_selling_price" class="form-control" id="inputProductTitle" placeholder="Enter product Selling Price">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Discount Price</label>
                                    <input type="text" name="product_discount_price" class="form-control" id="inputProductTitle" placeholder="Enter product Discount Price">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product tags</label>
                                    <input type="text" name="product_tags" class="form-control" data-role="tagsinput" value="boishak, eid,puja">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Color</label>
                                    <input type="text" name="product_color" class="form-control" data-role="tagsinput" value="red,blue,black">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Size</label>
                                    <input type="text" name="product_size" class="form-control" data-role="tagsinput" value="small,medium,large">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputProductDescription" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" id="inputProductDescription" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Long Description</label>
                                    <textarea id="mytextarea" name="long_desc">Hello, World!</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputProductDescription" class="form-label">Product Thumbnail</label>
                                    <img id="thumbnail" src="" alt=""><br>
                                    <input id="image-thumb" class="form-control-file" name="product_thumbnail" type="file">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputProductDescription" class="form-label">Product Hover Image</label>
                                    <img id="hover" src="" alt=""><br>
                                    <input id="hover_image" class="form-control-file" name="hover_image" type="file">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputProductDescription" class="form-label">Product Multiple Image</label><br>
                                    <div class="multi"></div>
                                    <input id="image-multiple" class="form-control-file" name="multi_img[]" type="file" multiple>
                                </div>
                            </div>
                        </div>
                        <style>
                            .multi img {
                                width: 100px;
                                height: 100px;
                                margin: 10px;
                            }
                        </style>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="form-group col-md-6">
                                        <label for="inputPrice" class="form-label">Product Code</label>
                                        <input type="text" class="form-control" id="inputPrice" name="product_code">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Product Quantity</label>
                                        <input type="text" class="form-control" name="product_qty" id="inputCompareatprice">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="inputProductType" class="form-label">Product Brand</label>
                                        <select class="form-select" name="brand_id" id="inputProductType">
                                            <option></option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputProductType" class="form-label">Product Category</label>
                                        <select class="form-select" name="category_id" id="inputProductType">
                                            <option></option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputVendor" class="form-label">Sub Category</label>
                                        <select class="form-select" name="subcategory_id" id="inputVendor">
                                            <option></option>

                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCollection" class="form-label">Vendor</label>
                                        <select class="form-select" name="vendor_id" id="inputCollection">
                                            <option></option>
                                            @foreach($activeVendor as $vendor)
                                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckChecked1">
                                        <label class="form-check-label" for="flexCheckChecked1">Hot Deals</label>

                                    </div>
                                    <div class="col-6">
                                        <input class="form-check-input" name="special_offers" type="checkbox" value="1" id="flexCheckChecked1">
                                        <label class="form-check-label" for="flexCheckChecked1">Special Offer</label>

                                    </div>
                                    <div class="col-6">
                                        <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckChecked1">
                                        <label class="form-check-label" for="flexCheckChecked1">Special Deals</label>

                                    </div>
                                    <div class="col-6">
                                        <input class="form-check-input" name="recently_added" type="checkbox" value="1" id="flexCheckChecked1">
                                        <label class="form-check-label" for="flexCheckChecked1">Recently Added</label>

                                    </div>
                                    <div class="col-6">
                                        <input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckChecked1">
                                        <label class="form-check-label" for="flexCheckChecked1">Featured Item</label>

                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Save Product</button>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
