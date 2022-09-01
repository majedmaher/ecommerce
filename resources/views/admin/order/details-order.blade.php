@section('css')
<link rel="stylesheet" href="https//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@extends('layouts.app')

@php
$count = 0;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <h5>Name </h5>
                    <p>{{$orders->first_name}} {{$orders->last_name}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Email </h5>
                    <p>{{$orders->email}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Mobile Number </h5>
                    <p>{{$orders->mobile_number}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Address Line 1 </h5>
                    <p>{{$orders->address_line_1}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Address Line 2 </h5>
                    <p>{{$orders->address_line_2}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Country </h5>
                    <p>{{$orders->country}}</p>
                </div>
                <div class="col-md-4">
                    <h5>City </h5>
                    <p>{{$orders->city}}</p>
                </div>
                <div class="col-md-4">
                    <h5>State </h5>
                    <p>{{$orders->state}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Zip Code </h5>
                    <p>{{$orders->zip_code}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Payment Type </h5>
                    <p>{{$orders->payment_type}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Order Number </h5>
                    <p>{{$orders->order_number}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Invoice No </h5>
                    <p>{{$orders->invoice_no}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Order Date </h5>
                    <p>{{$orders->order_date}}</p>
                </div>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Color</th>
                        <th scope="col">Size</th>
                        <th scope="col">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->orders as $order)
                    <tr>
                        <th scope="row">{{++$count}}</th>
                        <td><a target="_blank" href="{{route('details',['product_slug'=>$order->product_slug])}}">Show Product</a></td>
                        <td>{{$order->color}}</td>
                        <td>{{$order->size}}</td>
                        <td>{{$order->qty}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>

@endsection