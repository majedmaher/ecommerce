@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Edit Coupon</div>
				@if (session('message'))
				<div class="alert alert-success" role="alert">
					{{ session('message') }}
				</div>
				@endif

				<div class="card-body">
					<form method="POST" action="{{ route('coupon.update',['id'=> $coupon->id]) }}">
						@csrf

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Coupon Name <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('coupon_name') is-invalid @enderror" name="coupon_name" value="{{old('coupon_name')?old('coupon_name'):$coupon->coupon_name}}" required autofocus>

								@error('coupon_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>


						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Coupon Discount <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="number" min="0" max="100" class="form-control @error('coupon_discount') is-invalid @enderror" name="coupon_discount" value="{{old('coupon_discount')?old('coupon_discount'):$coupon->coupon_discount}}" required>

								@error('coupon_discount')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Coupon Validity <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="date" class="form-control @error('coupon_validity') is-invalid @enderror" name="coupon_validity" value="{{old('coupon_validity')?old('coupon_validity'):$coupon->coupon_validity}}" required>

								@error('coupon_validity')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="status" class="form-check-input" type="checkbox" id="status" @if(old('status')) @if(old('status')=='on' ) checked @endif @elseif($coupon->status == '1') checked @endif>
									<label class="form-check-label" for="status">Status</label>
								</div>
							</div>
						</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-md-8 offset-md-4">
						<button type="submit" class="btn btn-primary">
							Save
						</button>

					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	@endsection