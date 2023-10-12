@extends('vendor.vendor_dashboard')
@section('vendor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Bengal eCommerce</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Vendor Product</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product</h5>
                <hr/>
                <div class="form-body mt-4">

                    <form action="{{ route('vendor.pro.update',$edit_product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" name="product_name" value="{{ $edit_product->product_name }}" class="form-control" id="inputProductTitle" placeholder="Enter product Name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Selling Price</label>
                                        <input type="text" name="product_selling_price" value="{{ $edit_product->product_selling_price }}" class="form-control" id="inputProductTitle" placeholder="Enter product Selling Price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Discount Price</label>
                                        <input type="text" name="product_discount_price" value="{{ $edit_product->product_discount_price }}" class="form-control" id="inputProductTitle" placeholder="Enter product Discount Price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product tags</label>
                                        <input type="text" name="product_tags" value="{{ $edit_product->product_tags }}" class="form-control" data-role="tagsinput">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Color</label>
                                        <input type="text" name="product_color" value="{{ $edit_product->product_color }}" class="form-control" data-role="tagsinput">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Size</label>
                                        <input type="text" name="product_size" value="{{ $edit_product->product_size }}" class="form-control" data-role="tagsinput">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea class="form-control" name="short_desc" value="" id="inputProductDescription" rows="3">{{ $edit_product->short_desc }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="long_desc">{!! $edit_product->long_desc !!}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Product Thumbnail</label>
                                        <img id="thumbnail" style="width: 100px;height: 100px;" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $edit_product->product_thumbnail }}" alt=""><br>
                                        <input name="old_thumbnail" value="{{ $edit_product->product_thumbnail }}" type="hidden">
                                        <input id="image-thumb" class="form-control-file" name="product_thumbnail" type="file">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Product Hover Image</label>
                                        <img id="hover" style="width: 100px;height: 100px;" src="{{ URL::to('') }}/uploads/products/hover/{{ $edit_product->hover_image }}" alt=""><br>
                                        <input name="old_hover" value="{{ $edit_product->hover_image }}" type="hidden">
                                        <input id="hover_image" class="form-control-file" name="hover_image" type="file">
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Product Code</label>
                                            <input type="text" class="form-control" value="{{ $edit_product->product_code }}" id="inputPrice" name="product_code">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Product Quantity</label>
                                            <input type="text" class="form-control" name="product_qty" value="{{ $edit_product->product_qty }}" id="inputCompareatprice">
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select class="form-select" name="brand_id" id="inputProductType">
                                                <option></option>
                                                @foreach($brands as $brand)
                                                    <option {{ $edit_product->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Category</label>
                                            <select class="form-select" name="category_id" id="inputProductType">
                                                <option></option>
                                                @foreach($categories as $cat)
                                                    <option {{ $edit_product->category_id == $cat->id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Sub Category</label>
                                            <select class="form-select" name="subcategory_id" id="inputVendor">
                                                @foreach($subcategories as $subcat)
                                                    <option {{ $edit_product->subcategory_id == $subcat->id ? 'selected' : '' }} value="{{ $subcat->id }}">{{ $subcat->sub_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <input class="form-check-input" name="hot_deals" type="checkbox" {{ $edit_product->hot_deals == 1 ? 'checked' : '' }} value="1" id="flexCheckChecked1">
                                            <label class="form-check-label" for="flexCheckChecked1">Hot Deals</label>

                                        </div>
                                        <div class="col-6">
                                            <input class="form-check-input" name="special_offers" type="checkbox" {{ $edit_product->special_offers == 1 ? 'checked' : '' }} value="1" id="flexCheckChecked1">
                                            <label class="form-check-label" for="flexCheckChecked1">Special Offer</label>

                                        </div>
                                        <div class="col-6">
                                            <input class="form-check-input" name="special_deals" type="checkbox" {{ $edit_product->special_deals == 1 ? 'checked' : '' }} value="1" id="flexCheckChecked1">
                                            <label class="form-check-label" for="flexCheckChecked1">Special Deals</label>

                                        </div>
                                        <div class="col-6">
                                            <input class="form-check-input" name="recently_added" type="checkbox" {{ $edit_product->recently_added == 1 ? 'checked' : '' }} value="1" id="flexCheckChecked1">
                                            <label class="form-check-label" for="flexCheckChecked1">Recently Added</label>

                                        </div>
                                        <div class="col-6">
                                            <input class="form-check-input" name="featured" type="checkbox" {{ $edit_product->featured == 1 ? 'checked' : '' }} value="1" id="flexCheckChecked1">
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

        <div class="card">
            <div class="card-header">
                <h2>Multi Image Edit</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Image</th>
                        <th>Change Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <form action="{{ route('vendor.multi.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @foreach($multiImg as $img)

                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td><img style="width: 100px;height: 100px;" src="{{ URL::to('') }}/uploads/products/multi/{{ $img->photo }}" alt=""></td>
                                <td>
                                    <input name="multi_img[{{ $img->id }}]" type="file">
                                </td>
                                <td>
                                    <input class="btn btn-success" type="submit">
                                    <a id="delete" class="btn btn-danger" href="{{ route('vendor.multi.delete',$img->id) }}">Delete</a>
                                </td>
                            </tr>

                        @endforeach
                    </form>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        $(document).on('change','input#hover_image',function (e){
            e.preventDefault();

            let url = URL.createObjectURL(e.target.files[0]);
            $('img#hover').attr('src',url).width('200px').height('200px');
        })
    </script>

@endsection
