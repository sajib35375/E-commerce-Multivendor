
@if($search_item->isEmpty())
    <p class="text-danger">Product not found</p>
    @else
<div class="wrap">
    @foreach($search_item as $item)

            <div class="card">
                <div class="card-body">
                    <a href="{{ route('product.details',[$item->id,$item->product_slug]) }}">
                        <div class="row">

                                    <div class="col-md-6">
                                    <img style="width: 60px;height: 60px;" src="{{ URL::to('') }}/uploads/products/thumbnail/{{ $item->product_thumbnail }}" alt="">
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Product Name :</strong>{{ $item->product_name }}</p>
                                    <p><strong>Product Price :</strong>{{ $item->actual_price }}</p>
                                </div>

                        </div>

                    </a>
                </div>
            </div>

    @endforeach
</div>
@endif



