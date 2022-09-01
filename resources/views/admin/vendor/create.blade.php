@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Vendor</div>
                @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('vendor.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Vendor image <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <label class="custom-file">
                                    <input type="file" name="photo_name" class="custom-file-input" value="{{old('photo_name')}}" onChange="mainThamUrl(this)" required>
                                    <span class="custom-file-control"></span>
                                </label>
                                @error('photo_name')
                                <span class="invalid-feedback alert-invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <img src="" id="photo_name">

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
                $('#photo_name').attr('src', e.target.result).width(200).height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection