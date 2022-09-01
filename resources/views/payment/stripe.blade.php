@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Stripe Payment') }}</div>

                <div class="card-body">
                    @if ($message = session()->get('success'))
                    <div class="custom-alerts alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! $message !!}
                    </div>
                    <?php session()->forget('success'); ?>
                    @endif
                    @if ($message = session()->get('error'))
                    <div class="custom-alerts alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! $message !!}
                    </div>
                    <?php session()->forget('error'); ?>
                    @endif
                    <form method="POST" action="{{ route('stripe.payment') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="card_no" type="text" class="form-control @error('card_no') is-invalid @enderror" name="card_no" value="{{ old('card_no') }}" required autocomplete="card_no" placeholder="Card No." autofocus>
                                @error('card_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="first_name" value="{{$data['first_name']}}">
                        <input type="hidden" name="last_name" value="{{$data['last_name']}}">
                        <input type="hidden" name="email" value="{{$data['email']}}">
                        <input type="hidden" name="mobile_number" value="{{$data['mobile_number']}}">
                        <input type="hidden" name="address_line_1" value="{{$data['address_line_1']}}">
                        <input type="hidden" name="address_line_2" value="{{$data['address_line_2']}}">
                        <input type="hidden" name="country" value="{{$data['country']}}">
                        <input type="hidden" name="city" value="{{$data['city']}}">
                        <input type="hidden" name="state" value="{{$data['state']}}">
                        <input type="hidden" name="zip_code" value="{{$data['zip_code']}}">
                        <input type="hidden" name="payment_method" value="{{$data['payment_method']}}">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="exp_month" type="text" class="form-control @error('exp_month') is-invalid @enderror" name="exp_month" value="{{ old('exp_month') }}" required autocomplete="exp_month" placeholder="Exp. Month (Eg. 02)">
                                @error('exp_month')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input id="exp_year" type="text" class="form-control @error('exp_year') is-invalid @enderror" name="exp_year" value="{{ old('exp_year') }}" required autocomplete="exp_year" placeholder="Exp. Year (Eg. 2028)">
                                @error('exp_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="cvv" type="password" class="form-control @error('cvv') is-invalid @enderror" name="cvv" required autocomplete="current-password" placeholder="CVV">
                                @error('cvv')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('PAY NOW') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection