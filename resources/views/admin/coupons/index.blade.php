@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@extends('layouts.app')

@php
$count = 0;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <a href="{{route('coupon.create')}}">Add Coupon</a>
            </div>
            @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Coupon Name</th>
                        <th scope="col">Coupon Discount</th>
                        <th scope="col">Coupon Validity</th>
                        <th scope="col">Coupon Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                    <tr>
                        <th scope="row">{{++$count}}</th>
                        <td>{{$coupon->coupon_name}}</td>
                        <td>{{$coupon->coupon_discount}}</td>
                        <td>{{$coupon->coupon_validity}}</td>
                        <td>{{$coupon->status == 1 ? 'Active' : 'inActive'}}</td>
                        <td>
                            <a href="{{route('coupon.edit',['id'=> $coupon->id])}}"> <i class="fas fa-2x fa-edit"></i> </a>
                            &nbsp;&nbsp;
                            <a class="text-danger" href="{{route('coupon.destroy',['id'=> $coupon->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>

@endsection