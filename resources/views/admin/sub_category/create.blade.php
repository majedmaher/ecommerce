@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Sub Category</div>
                @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('sub_category.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Sub Category name in English <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('sub_category_name_en') is-invalid @enderror" name="sub_category_name_en" value="{{old('sub_category_name_en')}}" required autofocus>

                                @error('sub_category_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Sub Category name in Arabic <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('sub_category_name_ar') is-invalid @enderror" name="sub_category_name_ar" value="{{old('sub_category_name_ar')}}" required>

                                @error('sub_category_name_ar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Sub Category image <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <label class="custom-file">
                                    <input type="file" name="sub_category_image" class="custom-file-input" value="{{old('sub_category_image')}}" onChange="mainThamUrl(this)" required>
                                    <span class="custom-file-control"></span>
                                </label>
                                @error('sub_category_image')
                                <span class="invalid-feedback alert-invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <img src="" id="sub_category_image">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Select Category</label>

                            <div class="col-md-6">
                                <select name="category_id" class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                                    <option label="Choose one"></option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name_en}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback alert-invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#sub_category_image').attr('src', e.target.result).width(200).height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(function() {

        'use strict';

        $('.select2-show-search').select2({
            minimumResultsForSearch: ''
        });
    });
</script>
@endsection