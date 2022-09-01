@extends('page')

@section('content')
<!-- Page Header Start -->
@include('header', ['title' => getLanguage()== 'ar' ? 'عربة التسوق' :'Shopping Cart'])
<!-- Page Header End -->

<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>{{getLanguage()=='ar'?'المنتجات':'Products'}}</th>
                        <th>{{getLanguage()=='ar'?'السعر':'Price'}}</th>
                        <th>{{getLanguage()=='ar'?'الكمية':'Quantity'}}</th>
                        <th>{{getLanguage()=='ar'?'المجموع':'Total'}}</th>
                        <th>{{getLanguage()=='ar'?'ازالة':'Remove'}}</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($carts as $cart)

                    <tr class="tr-cart">
                        <input type="hidden" name="rowId" value="{{$cart->rowId}}">
                        <td class="align-middle"><img src="{{asset($cart->options->image)}}" alt="" style="width: 50px;">
                            <span class="cart-name"> {{$cart->name}}</span>
                        </td>
                        <td class="cart-price align-middle">${{$cart->price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button onclick="calculate(this)" class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="cart-qty form-control form-control-sm bg-secondary text-center" value="{{$cart->qty}}">
                                <div class="input-group-btn">
                                    <button onclick="calculate(this)" class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="cart-subtotal align-middle">${{$cart->subtotal}}</td>
                        <td class="align-middle"><button onclick="removeItem(this)" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="mb-5">
                <div id="coupon-exist" style="background-color: #edf1fe;" class="{{session()->has('coupon') ? 'd-flex' : 'd-none'}} justify-content-around">
                    <h3 id="coupon-name" class=" m-0" style="color: #d19c97;">{{session()->has('coupon') ? session()->get('coupon')['coupon_name'] : ''}}</h3>
                    <button onclick="removeCoupon()" class="btn btn-danger"><i class="fas fa-solid fa-trash"></i></button>
                </div>
                <div id="coupon-non-exist" class="input-group {{session()->has('coupon') ? 'd-none' : ''}}">
                    <input type="text" class="form-control p-4" placeholder="{{getLanguage()=='ar'?'رمز الكوبون':'Coupon Code'}}" name="coupon_name">
                    <div class="input-group-append">
                        <button onclick="couponApply()" class="btn btn-primary">{{getLanguage()=='ar'?'تطبيق القسيمة':'Apply Coupon'}}</button>
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">{{getLanguage()=='ar'?'ملخص العربة':'Cart Summary'}}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">{{getLanguage()=='ar'?'المجموع الفرعي':'Subtotal'}}</h6>
                        <h6 id="cart-subtotal" class="font-weight-medium">${{round($cartTotal)}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">{{getLanguage()=='ar'?'الشحن':'Shipping'}}</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">{{getLanguage()=='ar'?'خصم القسيمة':'Coupon Discount'}}</h6>
                        <h6 id="coupon-discount" class="font-weight-medium">{{session()->has('coupon') ? session()->get('coupon')['coupon_discount'] : '0'}}%</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">{{getLanguage()=='ar'?'مقدار الخصم':'Discount Amount'}}</h6>
                        <h6 id="discount-amount" class="font-weight-medium">${{session()->has('coupon') ? session()->get('coupon')['discount_amount'] : '0'}}</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">{{getLanguage()=='ar'?'المجموع':'Total'}}</h5>
                        <h5 id="cart-total" class="font-weight-bold">${{session()->has('coupon') ? session()->get('coupon')['total_amount']+10 : $cartTotal+10}}</h5>
                    </div>
                    <a href="{{route('checkout')}}" class="btn btn-block btn-primary my-3 py-3">{{getLanguage()=='ar'?'الشروع في الدفع':'Proceed To Checkout'}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

@section('scripts')
<script>
    function refreshCount() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: `{{route('refresh.count')}}`,
            success: function(data) {
                $('#cart-count').text(data.success);
            }
        })
    }


    function refreshTotal() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: `{{route('get.total')}}`,
            success: function(data) {
                if (data.total) {
                    $('#cart-subtotal').text('$' + parseInt(data.total));
                    $('#cart-total').text('$' + (parseInt(data.total) + 10));
                    $('#coupon-discount').text(0 + '%');
                    $('#discount-amount').text('$' + 0);
                } else {
                    $('#coupon-name').text(data.coupon_name);
                    $('#cart-subtotal').text('$' + parseInt(data.subtotal));
                    $('#cart-total').text('$' + (parseInt(data.total_amount) + 10));
                    $('#coupon-discount').text(data.coupon_discount + '%');
                    $('#discount-amount').text('$' + data.discount_amount);
                }
            }
        })
    }


    function couponApply() {
        var couponName = $('input[name="coupon_name"]').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                coupon_name: couponName,
            },
            url: `{{route('apply.coupon')}}`,
            success: function(data) {

                refreshTotal();

                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    $('#coupon-non-exist').addClass('d-none');
                    $('#coupon-exist').addClass('d-flex');
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

    function removeCoupon() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: `{{route('remove.coupon')}}`,
            success: function(data) {

                refreshTotal();


                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    $('#coupon-non-exist').removeClass('d-none');
                    $('#coupon-exist').removeClass('d-flex');
                    $('#coupon-exist').addClass('d-none');
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

<script>
    function calculate(input) {
        setTimeout(
            function() {
                var parent = $(input).parents('.tr-cart');
                var rowId = parent.find('input[name="rowId"]').val();
                var qty = parent.find('.cart-qty').val();
                var text = parent.find('.cart-price').text();
                var priceVal = text.substring(1, text.length);
                $(parent).find('.cart-subtotal').text('$' + qty * priceVal);
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: {
                        rowId: rowId,
                        qty: qty,
                    },
                    url: `{{route('update.to.cart')}}`,
                    success: function(data) {

                        refreshCount();
                        refreshTotal();
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
            }, 10);
    }

    function removeItem(input) {
        setTimeout(
            function() {
                var parent = $(input).parents('.tr-cart');
                var rowId = parent.find('input[name="rowId"]').val();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: {
                        rowId: rowId,
                    },
                    url: `{{route('remove.cart')}}`,
                    success: function(data) {

                        refreshCount();
                        refreshTotal();

                        $(parent).remove();
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
            }, 10);

    }
    // $('.cart-qty').change(function(e) {
    //     var text = $('#cart-price').text();
    //     var priceVal = text.substring(1, text.length);
    //     $('#add-total').text('$' + $('#add-qty').val() * priceVal);
    // });
</script>
@endsection