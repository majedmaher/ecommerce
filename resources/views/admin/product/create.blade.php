@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/tagsinput.css')}}" />
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Create Product</div>
				@if (session('message'))
				<div class="alert alert-success" role="alert">
					{{ session('message') }}
				</div>
				@endif

				<div class="card-body">
					<form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
						@csrf

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product name in English <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="text" class="form-control @error('product_name_en') is-invalid @enderror" name="product_name_en" value="{{old('product_name_en')}}" required autofocus>

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
								<input type="text" class="form-control @error('product_name_ar') is-invalid @enderror" name="product_name_ar" value="{{old('product_name_ar')}}" required>

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
									<option {{old('category_id') == $category->id ? 'selected':''}} value="{{$category->id}}">{{$category->category_name_en}}</option>
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
									<option {{old('sub_category_id') == $sub_category->id ? 'selected':''}} value="{{$sub_category->id}}">{{$sub_category->sub_category_name_en}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Product quantity <span class="text-danger">*</span></label>

							<div class="col-md-6">
								<input type="number" min="0" placeholder="5" step="1" class="form-control @error('product_qty') is-invalid @enderror" name="product_qty" value="{{old('product_qty')}}" required>

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
								<input type="text" class="form-control @error('product_size_en') is-invalid @enderror" name="product_size_en" value="{{old('product_size_en')}}" data-role="tagsinput" required>

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
								<input type="text" class="form-control @error('product_size_ar') is-invalid @enderror" name="product_size_ar" value="{{old('product_size_ar')}}" data-role="tagsinput" required>

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
								<input type="text" class="form-control @error('product_color_en') is-invalid @enderror" name="product_color_en" value="{{old('product_color_en')}}" data-role="tagsinput" required>

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
								<input type="text" class="form-control @error('product_color_ar') is-invalid @enderror" name="product_color_ar" value="{{old('product_color_ar')}}" data-role="tagsinput" required>

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
								<input type="number" min="0" placeholder="210" step="1" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" value="{{old('selling_price')}}" required>

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
								<input type="number" min="0" placeholder="280" step="1" class="form-control @error('discount_price') is-invalid @enderror" name="discount_price" value="{{old('discount_price')}}">

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
								<textarea name="short_product_description_en" class="form-control @error('short_product_description_en') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('short_product_description_en')}}</textarea>

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
								<textarea name="short_product_description_ar" class="form-control @error('short_product_description_ar') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('short_product_description_ar')}}</textarea>

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
								<textarea name="long_product_description_en" class="form-control @error('long_product_description_en') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('long_product_description_en')}}</textarea>

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
								<textarea name="long_product_description_ar" class="form-control @error('long_product_description_ar') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('long_product_description_ar')}}</textarea>

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
								<textarea name="additional_information_en" class="form-control @error('additional_information_en') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('additional_information_en')}}</textarea>

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
								<textarea name="additional_information_ar" class="form-control @error('additional_information_ar') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{old('additional_information_ar')}}</textarea>

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
								<input type="text" class="form-control @error('additional_information_items_en') is-invalid @enderror" name="additional_information_items_en" value="{{old('additional_information_items_en')}}" data-role="tagsinput" required>

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
								<input type="text" class="form-control @error('additional_information_items_ar') is-invalid @enderror" name="additional_information_items_ar" value="{{old('additional_information_items_ar')}}" data-role="tagsinput" required>

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
									<input name="status" class="form-check-input" type="checkbox" id="status" {{old('status')?'checked':''}}>
									<label class="form-check-label" for="status">Status</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="trandy" class="form-check-input" type="checkbox" id="trandy" {{old('trandy')?'checked':''}}>
									<label class="form-check-label" for="trandy">Trandy</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="just_arrived" class="form-check-input" type="checkbox" id="just_arrived" {{old('just_arrived')?'checked':''}}>
									<label class="form-check-label" for="just_arrived">Just Arrived</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="spring_collection" class="form-check-input" type="checkbox" id="spring_collection" {{old('spring_collection')?'checked':''}}>
									<label class="form-check-label" for="spring_collection">Spring Collection</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="summer_collection" class="form-check-input" type="checkbox" id="summer_collection" {{old('summer_collection')?'checked':''}}>
									<label class="form-check-label" for="summer_collection">Summer Collection</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="fall_collection" class="form-check-input" type="checkbox" id="fall_collection" {{old('fall_collection')?'checked':''}}>
									<label class="form-check-label" for="fall_collection">Fall Collection</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check form-switch">
									<input name="winter_collection" class="form-check-input" type="checkbox" id="winter_collection" {{old('winter_collection')?'checked':''}}>
									<label class="form-check-label" for="winter_collection">Winter Collection</label>
								</div>
							</div>
						</div>
				</div>

				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Product thambnail <span class="text-danger">*</span></label>

					<div class="col-md-6">
						<label class="custom-file">
							<input type="file" name="product_thambnail" class="custom-file-input" value="{{old('product_thambnail')}}" onChange="mainThamUrl(this)" required>
							<span class="custom-file-control"></span>
						</label>
						@error('product_thambnail')
						<span class="invalid-feedback alert-invalid" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror

						<img src="" id="product_thambnail">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Multiple Image <span class="text-danger">*</span></label>

					<div class="col-md-6">
						<label class="custom-file">
							<input type="file" name="multi_img[]" class="custom-file-input" multiple="" id="multiImg" required>
							<span class="custom-file-control"></span>
						</label>
						@error('multi_img')
						<span class="text-danger">{{ $message }}</span>
						@enderror
						<div class="row" id="preview_img"></div>
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