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
                <a href="{{route('sub_category.create')}}">Add Sub Category</a>
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
                        <th scope="col">Image Sub Category</th>
                        <th scope="col">Title Sub Category</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sub_categories as $sub_category)
                    <tr>
                        <th scope="row">{{++$count}}</th>
                        <td><img width="150px" src="{{URL::asset($sub_category->sub_category_image)}}" alt="{{$sub_category->sub_category_image}}"></td>
                        <td>{{$sub_category->sub_category_name_en}}</td>
                        <td>
                            <a href="{{route('sub_category.edit',['id'=> $sub_category->id])}}"> <i class="fas fa-2x fa-edit"></i> </a>
                            &nbsp;&nbsp;
                            <a class="text-danger" href="{{route('sub_category.destroy',['id'=> $sub_category->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>

@endsection