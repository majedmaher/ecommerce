@extends('page')
@section('css')
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
@endsection
@section('content')

<!-- Page Header Start -->

@include('header', ['title' => getLanguage() == 'ar' ? 'الدفع' : 'Checkout'])

<!-- Page Header End -->


<!-- Checkout Start -->
<form method="POST" action="{{ route('stripe.order') }}">
    @csrf
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">{{getLanguage() == 'ar' ? 'عنوان وصول الفواتير' : 'Billing Address'}}</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'الاسم الاول' : 'First Name'}}</label>
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text" placeholder="John" name="first_name" value="{{old('first_name')}}" required>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'الكنية' : 'Last Name'}}</label>
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" placeholder="Doe" name="last_name" value="{{old('last_name')}}" required>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'البريد الإلكتروني' : 'E-mail'}}</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="example@email.com" name="email" value="{{old('email')}}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'رقم الموبايل' : 'Mobile No'}}</label>
                            <input class="form-control @error('mobile_number') is-invalid @enderror" type="text" placeholder="+123 456 789" name="mobile_number" value="{{old('mobile_number')}}" required>
                            @error('mobile_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'العنوان الأول' : 'Address Line 1'}}</label>
                            <input class="form-control @error('address_line_1') is-invalid @enderror" type="text" placeholder="123 Street" name="address_line_1" value="{{old('address_line_1')}}" required>
                            @error('address_line_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'سطر العنوان 2' : 'Address Line 2'}}</label>
                            <input class="form-control @error('address_line_2') is-invalid @enderror" type="text" placeholder="123 Street" name="address_line_2" value="{{old('address_line_2')}}" required>
                            @error('address_line_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'الدولة' : 'Country'}}</label>
                            <select class="custom-select  @error('country') is-invalid @enderror" name="country" required>
                                <option value="{{getLanguage()=='ar' ? 'الولايات المتحدة' : 'United States'}}" @if (old('country')=='United States' ) selected @elseif (old('country')=="الولايات المتحدة" ) selected @endif>{{getLanguage()=='ar' ? 'الولايات المتحدة' : 'United States'}}</option>
                                <option value="{{getLanguage()=='ar' ? 'أفغانستان' : 'Afghanistan'}}" @if (old('country')=='Afghanistan' ) selected @elseif (old('country')=="أفغانستان" ) selected @endif>{{getLanguage()=='ar' ? 'أفغانستان' : 'Afghanistan'}}</option>
                                <option value="{{getLanguage()=='ar' ? 'ألبانيا' : 'Albania'}}" @if (old('country')=='Albania' ) selected @elseif (old('country')=="ألبانيا" ) selected @endif>{{getLanguage()=='ar' ? 'ألبانيا' : 'Albania'}}</option>
                                <option value="{{getLanguage()=='ar' ? 'الجزائر' : 'Algeria'}}" @if (old('country')=='Algeria' ) selected @elseif (old('country')=="الجزائر" ) selected @endif>{{getLanguage()=='ar' ? 'الجزائر' : 'Algeria'}}</option>
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'المدينة' : 'City'}}</label>
                            <input class="form-control @error('city') is-invalid @enderror" type="text" placeholder="New York" name="city" value="{{old('city')}}" required>
                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'الولاية' : 'State'}}</label>
                            <input class="form-control @error('state') is-invalid @enderror" type="text" placeholder="New York" name="state" value="{{old('state')}}" required>
                            @error('state')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{getLanguage()=='ar' ? 'الرمز البريدي' : 'ZIP Code'}}</label>
                            <input class="form-control @error('zip_code') is-invalid @enderror" type="text" placeholder="123" name="zip_code" value="{{old('zip_code')}}" required>
                            @error('zip_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">{{getLanguage()=='ar' ? 'الطلب الكلي' : 'Order Total'}}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">{{getLanguage()=='ar' ? 'المنتجات' : 'Products'}}</h5>
                        @foreach ($carts as $cart)
                        <div class="d-flex justify-content-between">
                            <p>{{$cart->name}}</p>
                            <p>${{$cart->subtotal}}</p>
                        </div>
                        @endforeach
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">{{getLanguage()=='ar' ? 'المجموع الفرعي' : 'Subtotal'}}</h6>
                            <h6 class="font-weight-medium">${{round($cartTotal)}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">{{getLanguage()=='ar' ? 'الشحن' : 'Shipping'}}</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                        <hr class="mt-0">
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
                            <h5 class="font-weight-bold">{{getLanguage()=='ar' ? 'المجموع' : 'Total'}}</h5>
                            <h5 class="font-weight-bold">${{session()->has('coupon') ? session()->get('coupon')['total_amount']+10 : $cartTotal+10}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">{{getLanguage()=='ar' ? 'الدفع' : 'Payment'}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input value="paypal" type="radio" class="custom-control-input  @error('payment_method') is-invalid @enderror" name="payment_method" id="paypal" {{old('payment_method' == 'paypal' ? 'checked' : '')}}>
                                <label class="custom-control-label" for="paypal">{{getLanguage()=='ar' ? 'باي بال' : 'Paypal'}}</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input value="bank_transfer" type="radio" class="custom-control-input  @error('payment_method') is-invalid @enderror" name="payment_method" id="bank_transfer" {{old('payment_method' == 'bank_transfer' ? 'checked' : '')}}>
                                <label class="custom-control-label" for="bank_transfer">{{getLanguage()=='ar' ? 'حوالة بنكية' : 'Bank Transfer'}}</label>
                            </div>
                        </div>
                        @error('payment_method')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">{{getLanguage()=='ar' ? 'مكان الامر' : 'Place Order'}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Checkout End -->
@endsection