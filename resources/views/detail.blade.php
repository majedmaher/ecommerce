@extends('page')

@section('content')
<!-- Page Header Start -->
@include('header', ['title' => 'Shop Detail'])
<!-- Page Header End -->




<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{asset($product->product_thambnail)}}" alt="Image">
                    </div>
                    @foreach ($product->multiImgs as $value)
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="{{asset($value->photo_name)}}" alt="Image">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold" id="pname">{{$product->name}}</h3>
            <!-- <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">(50 Reviews)</small>
            </div> -->
            <h3 class="font-weight-semi-bold mb-4">${{$product->discount_price}}</h3>
            @if ($product->selling_price)
            <h6 class="text-muted ml-2"><del>${{$product->selling_price}}</del></h6>
            @endif

            <p class="mb-4">{{$product->short_product_description}}</p>
            <div class="d-flex mb-3">
                <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                <form>
                    @foreach (explode(",", $product->product_size) as $key => $value)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-{{$key}}" value="{{$value}}" name="size">
                        <label class="custom-control-label" for="size-{{$key}}">{{$value}}</label>
                    </div>
                    @endforeach
                </form>
            </div>
            <div class="d-flex mb-4">
                <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                <form>
                    @foreach (explode(",", $product->product_color) as $key => $value)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-{{$key}}" value="{{$value}}" name="color">
                        <label class="custom-control-label" for="color-{{$key}}">{{$value}}</label>
                    </div>
                    @endforeach
                </form>
            </div>
            <div class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-minus">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" id="qty" max="{{$product->product_qty}}" min="1" class="form-control bg-secondary text-center" value="1">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-plus">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <button onclick="addToCart()" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
            </div>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                <!-- <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a> -->
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    <p>{{$product->long_product_description}}</p>
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3">Additional Information</h4>
                    <p>{{$product->additional_information}}</p>
                    <div class="row">
                        @php
                        $numofrows = round(count(explode(',', ($product->additional_information_items))) / 2);
                        $numofallrows = count(explode(',', ($product->additional_information_items)));
                        $items = explode(',', ($product->additional_information_items));
                        @endphp
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                @for ($i = 0; $i < $numofrows ; $i++) <li class="list-group-item px-0">
                                    {{$items[$i]}}
                                    </li>
                                    @endfor
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                @for ($i=$numofrows; $i < $numofallrows; $i++) <li class="list-group-item px-0">
                                    {{$items[$i]}}
                                    </li>
                                    @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                            <div class="media mb-4">
                                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                                <div class="text-primary">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <form>
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Your Name *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

@endsection

@section('scripts')
<script>
    function addToCart() {
        var product_name = `{{$product->name}}`;
        var id = `{{$product->id}}`;
        var color = $('input[name="color"]:checked').val();
        var size = $('input[name="size"]:checked').val();
        var quantity = $('#qty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                id: id,
                color: color,
                size: size,
                quantity: quantity,
                product_name: product_name
            },
            url: `{{route('add.to.cart')}}`,
            success: function(data) {

                // miniCart()
                // $('#closeModel').click();
                // console.log(data)

                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })

                } else {
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })

                }

                // End Message 
            }
        })

    }
</script>
@endsection