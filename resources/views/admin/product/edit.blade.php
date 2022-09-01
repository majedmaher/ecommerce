@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('css/tagsinput.css')}}" />
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Edit Product</div>
				@if (session('message'))
				<div class="alert alert-success" role="alert">
					{{ session('message') }}
				</div>
				@endif

				<div class="card-body">
					<form method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="id" value="{{$product->id}}">
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product name in English <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('product_name_en') is-invalid @enderror" name="product_name_en" value="{{old('product_name_en')?old('product_name_en'):$product->product_name_en}}" required autofocus>

								@error('product_name_en')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product name in Arabic <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('product_name_ar') is-invalid @enderror" name="product_name_ar" value="{{old('product_name_ar')?old('product_name_ar'):$product->product_name_ar}}" required>

								@error('product_name_ar')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Select Category <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<select name="category_id" class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
									<option label="Choose one"></option>
									@foreach ($categories as $category)
									<option @if (old('category_id')) @if (old('category_id')==$category->id)
										selected
										@endif
										@else
										@if ($product->category_id == $category->id)
										selected
										@endif
										@endif
										value="{{$category->id}}">{{$category->category_name_en}}</option>
									@endforeach
								</select>
								@error('category_id')
								<span class="invalid-feedback alert-invalid" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Select SubCategory</label>

							<div class="col-md-6">
								<select name="sub_category_id" class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
									<option label="Choose one"></option>
									@foreach ($sub_categories as $sub_category)
									<option @if (old('sub_category_id')) @if (old('sub_category_id')==$sub_category->id)
										selected
										@endif
										@else
										@if ($product->sub_category_id == $sub_category->id)
										selected
										@endif
										@endif
										value="{{$sub_category->id}}">{{$sub_category->sub_category_name_en}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product quantity <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="number" min="0" placeholder="5" step="1" class="form-control @error('product_qty') is-invalid @enderror" name="product_qty" value="{{old('product_qty') ? old('product_qty') : $product->product_qty}}" required>

								@error('product_qty')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product Size in English <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('product_size_en') is-invalid @enderror" name="product_size_en" value="{{old('product_size_en') ? old('product_size_en') : $product->product_size_en}}" data-role="tagsinput" required>

								@error('product_size_en')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product Size in Arabic <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('product_size_ar') is-invalid @enderror" name="product_size_ar" value="{{old('product_size_ar') ? old('product_size_ar') : $product->product_size_ar}}" data-role="tagsinput" required>

								@error('product_size_ar')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product Color in English <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('product_color_en') is-invalid @enderror" name="product_color_en" value="{{old('product_color_en') ? old('product_color_en') : $product->product_color_en }}" data-role="tagsinput" required>

								@error('product_color_en')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product Color in Arabic <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('product_color_ar') is-invalid @enderror" name="product_color_ar" value="{{old('product_color_ar') ? old('product_color_ar') : $product->product_color_ar}}" data-role="tagsinput" required>

								@error('product_color_ar')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product Selling Price <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="number" min="0" placeholder="210" step="1" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" value="{{old('selling_price') ? old('selling_price') : $product->selling_price}}" required>

								@error('selling_price')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product Discount Price</label>

							<div class="col-md-6">
								<input type="number" min="0" placeholder="280" step="1" class="form-control @error('discount_price') is-invalid @enderror" name="discount_price" value="{{old('discount_price') ? old('discount_price') : $product->discount_price}}">

								@error('discount_price')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Short Product Description in English <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<textarea name="short_product_description_en" class="form-control @error('short_product_description_en') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('short_product_description_en') ? old('short_product_description_en') : $product->short_product_description_en}}</textarea>

								@error('short_product_description_en')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Short Product Description in Arabic <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<textarea name="short_product_description_ar" class="form-control @error('short_product_description_ar') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('short_product_description_ar') ? old('short_product_description_ar') : $product->short_product_description_ar}}</textarea>

								@error('short_product_description_ar')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Long Product Description in English <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<textarea name="long_product_description_en" class="form-control @error('long_product_description_en') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('long_product_description_en') ? old('long_product_description_en') : $product->long_product_description_en}}</textarea>

								@error('long_product_description_en')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Long Product Description in Arabic <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<textarea name="long_product_description_ar" class="form-control @error('long_product_description_ar') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('long_product_description_ar') ? old('long_product_description_ar') : $product->long_product_description_ar}}</textarea>

								@error('long_product_description_ar')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Additional information in English <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<textarea name="additional_information_en" class="form-control @error('additional_information_en') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('additional_information_en') ? old('additional_information_en') : $product->additional_information_en}}</textarea>

								@error('additional_information_en')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Additional information in Arabic <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<textarea name="additional_information_ar" class="form-control @error('additional_information_ar') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('additional_information_ar') ? old('additional_information_ar') : $product->additional_information_ar}}</textarea>

								@error('additional_information_ar')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product Additional information items in English <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('additional_information_items_en') is-invalid @enderror" name="additional_information_items_en" value="{{old('additional_information_items_en') ? old('additional_information_items_en') : $product->additional_information_items_en}}" data-role="tagsinput" required>

								@error('additional_information_items_en')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product Additional information items in Arabic <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('additional_information_items_ar') is-invalid @enderror" name="additional_information_items_ar" value="{{old('additional_information_items_ar') ? old('additional_information_items_ar') : $product->additional_information_items_ar}}" data-role="tagsinput" required>

								@error('additional_information_items_ar')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="status" class="form-check-input" type="checkbox" id="status" @if(old('status')) @if(old('status')=='on' ) checked @endif @elseif($product->status == '1') checked @endif>
									<label class="form-check-label" for="status">Status</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="trandy" class="form-check-input" type="checkbox" id="trandy" @if(old('trandy')) @if(old('trandy')=='on' ) checked @endif @elseif($product->trandy == '1') checked @endif>
									<label class="form-check-label" for="trandy">Trandy</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="just_arrived" class="form-check-input" type="checkbox" id="just_arrived" @if(old('just_arrived')) @if(old('just_arrived')=='on' ) checked @endif @elseif($product->just_arrived == '1') checked @endif>
									<label class="form-check-label" for="just_arrived">Just Arrived</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="spring_collection" class="form-check-input" type="checkbox" id="spring_collection" @if(old('spring_collection')) @if(old('spring_collection')=='on' ) checked @endif @elseif($product->spring_collection == '1') checked @endif>
									<label class="form-check-label" for="spring_collection">Spring Collection</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="summer_collection" class="form-check-input" type="checkbox" id="summer_collection" @if(old('summer_collection')) @if(old('summer_collection')=='on' ) checked @endif @elseif($product->summer_collection == '1') checked @endif>
									<label class="form-check-label" for="summer_collection">Summer Collection</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="fall_collection" class="form-check-input" type="checkbox" id="fall_collection" @if(old('fall_collection')) @if(old('fall_collection')=='on' ) checked @endif @elseif($product->fall_collection == '1') checked @endif>
									<label class="form-check-label" for="fall_collection">Fall Collection</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="winter_collection" class="form-check-input" type="checkbox" id="winter_collection" @if( old('winter_collection')) @if(old('winter_collection')=='on' ) checked @endif @elseif($product->winter_collection == '1') checked @endif>
									<label class="form-check-label" for="winter_collection">Winter Collection</label>
								</div>
							</div>
						</div>
				</div>
				<input type="hidden" name="old_img" value="{{ $product->product_thambnail }}">

				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Product thambnail <span class="text-danger">*</span></label>

					<div class="col-md-6">
						<label class="custom-file">
							<input type="file" name="product_thambnail" class="custom-file-input" value="{{old('product_thambnail')}}" onChange="mainThamUrl(this)">
							<span class="custom-file-control"></span>
						</label>
						@error('product_thambnail')
						<span class="invalid-feedback alert-invalid" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror

						<img src="{{ asset($product->product_thambnail) }}" id="product_thambnail" width="200" height="200">
					</div>
				</div>


				<div class="form-group row ">
					<div class="col-md-8 offset-md-4">
						<button type="submit" class="btn btn-primary">
							Update data
						</button>

					</div>
				</div>
				</form>

				<br />
				<br />

				<section class="content">
					<div class="row">

						<div class="col-md-12">
							<div class="box bt-3 border-info">
								<div class="box-header">
									<h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
								</div>


								<form method="post" action="{{ route('product.multiimg.update') }}" enctype="multipart/form-data">
									@csrf
									<div class="row row-sm">
										@foreach($multiImgs as $img)
										<div class="col-md-3">

											<div class="card">
												<img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 130px; width: 280px; max-width: 100%;">
												<div class="card-body">
													<h5 class="card-title">
														<a href="{{ route('product.multiimg.delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
													</h5>
													<p class="card-text">
													<div class="form-group">
														<label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
														<input class="form-control" onchange="updateMultiimg(this)" type="file" name="multi_img[{{ $img->id }}]">
													</div>
													</p>

												</div>
											</div>

										</div><!--  end col md 3		 -->
										@endforeach

									</div>
									<br />
									<div class="form-group row ">
										<div class="col-md-8 offset-md-4">
											<button type="submit" class="btn btn-primary">
												Update Image
											</button>
										</div>
									</div>
									<br><br>

								</form>
							</div>
						</div>
					</div> <!-- // end row  -->

				</section>

				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Add new Multiple Image <span class="text-danger">*</span></label>

					<div class="col-md-6">
						<form action="{{route('product.new.muliimg')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="product_id" value="{{$product->id}}">
							<label class="custom-file">
								<input type="file" name="multi_img[]" class="custom-file-input" multiple="" id="multiImg" required>
								<span class="custom-file-control"></span>
							</label>
							@error('multi_img')
							<span class="text-danger">{{ $message }}</span>
							@enderror
							<div class="row" id="preview_img"></div>
							<br />
							<div class="form-group row ">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-primary">
										Add new multi image
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>


			</div>

		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$(function() {

		'use strict';

		$('.select2-show-search').select2({
			minimumResultsForSearch: ''
		});
	});
</script>

<script type="text/javascript">
	function mainThamUrl(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#product_thambnail').attr('src', e.target.result).width(200).height(200);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>

<script>
	function updateMultiimg(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				// alert($(input).attr('type'));
				// alert($(input).parents('.card-body').prop("tagName"));
				// alert($(input).parents('.card-body').siblings('.card-img-top').attr('src'));
				// alert($(input).closest('img').attr('class'));
				// alert($(input).parents('.card').find('img').attr('class'));
				// $(input).closest('.card-img-top').attr('src', e.target.result);
				$(input).parents('.card-body').siblings('.card-img-top').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	// $('input').each(function() {
	// 	if ($(this).attr('for') == ('multiimg')) {
	// 		alert($(this).pare);
	// 	}
	// });
</script>

<script>
	$(document).ready(function() {
		$('#multiImg').on('change', function() { //on file input change
			if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
			{
				var data = $(this)[0].files; //this file data

				$.each(data, function(index, file) { //loop though each file
					if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
						var fRead = new FileReader(); //new filereader
						fRead.onload = (function(file) { //trigger function on successful read
							return function(e) {
								var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
									.height(80); //create image element 
								$('#preview_img').append(img); //append image to output element
							};
						})(file);
						fRead.readAsDataURL(file); //URL representing the file's data.
					}
				});

			} else {
				alert("Your browser doesn't support File API!"); //if File API is absent
			}
		});
	});
</script>

@endsection