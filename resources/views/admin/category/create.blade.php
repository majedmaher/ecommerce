@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Category</div>
                @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Category name in English <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('category_name_en') is-invalid @enderror" name="category_name_en" value="{{old('category_name_en')}}" required autofocus>

                                @error('category_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Category name in Arabic <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('category_name_ar') is-invalid @enderror" name="category_name_ar" value="{{old('category_name_ar')}}" required>

                                @error('category_name_ar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Category image <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <label class="custom-file">
                                    <input type="file" name="category_image" class="custom-file-input" value="{{old('category_image')}}" onChange="mainThamUrl(this)" required>
                                    <span class="custom-file-control"></span>
                                </label>
                                @error('category_image')
                                <span class="invalid-feedback alert-invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <img src="" id="category_image">

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
                $('#category_image').attr('src', e.target.result).width(200).height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection