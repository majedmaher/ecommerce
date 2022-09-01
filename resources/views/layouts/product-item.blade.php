@foreach ($products as $product)
<div class="col-lg-3 col-md-6 col-sm-12 pb-1">
    <div class="card product-item border-0 mb-4">
        <input type="hidden" name="id" value="{{$product->id}}">
        <input type="hidden" name="colors" value="{{$product->product_color}}">
        <input type="hidden" name="sizes" value="{{$product->product_size}}">
        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
            <img class="img-fluid w-100" src="{{asset($product->product_thambnail)}}" alt="">
        </div>
        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
            <h6 class="text-truncate mb-3">{{$product->name}}</h6>
            <div class="d-flex justify-content-center">
                <h6 class="add-price">${{$product->discount_price ? $product->discount_price : $product->selling_price}}</h6>
                @if ($product->discount_price)
                <h6 class="text-muted ml-2"><del>${{$product->selling_price}}</del></h6>
                @endif
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-light border">
            <a href="{{route('details',['product_slug'=>$product->slug])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>{{getLanguage() == 'ar' ? 'رؤية التفاصيل' : 'View Detail'}}</a>
            <button onclick="openModal(this)" data-toggle="modal" data-target="#cartModal" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>{{getLanguage() == 'ar' ? 'اضف الى السلة' : 'Add To Cart'}}</a>
        </div>
    </div>
</div>
@endforeach