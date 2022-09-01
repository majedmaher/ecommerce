@extends('page')

@section('content')
<!-- Page Header Start -->

@include('header', ['title' => getLanguage() == 'ar' ? ($page == 'category' ? 'الفئة' : 'الفئة الفرعية') : ($page == 'category' ? 'Category' : 'Sub Category')])

<!-- Page Header End -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">{{$page == 'sub_category' ? $data->sub_category_name : $data->category_name}}</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @include('layouts.product-item', ['products' => $data->products])
    </div>
</div>
@include('layouts.modal')

@endsection

@section('scripts')
@include('layouts.cart-js')
@endsection