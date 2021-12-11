@extends('starter')
@section('title', 'Category '. $category_id)
@section('title-a')
    This Page For Products For Category <span style="padding: 3px; line-height:50px" class="alret alert-warning"> {{$category_name}} </span>
@endsection
@php
    $count = 0;
@endphp
@section('content')
@if ($products->count() == 0)
    <div style="padding:10px; font-size:18px;font-weight:500; margin-bottom:40%" class="alret alert-danger">No Products For This Cateogry<div>
@else
<table class="table">
    <thead>
      <tr>
        <th>$loop</th>
        <th>Image</th>
        <th scope="col">{{__('Product Name')}}</th>
        <th scope="col">{{__('price')}}</th>
        <th scope="col">{{__('quantity')}}</th>
        <th scope="col">{{__('Created At')}}</th>
        <th scope="col">{{__('Operation')}}</th>
      </tr>
    </thead>
@endif
    <tbody>

        
         @foreach ($products as $product)
         @php
             $count++;
         @endphp
            <tr>
            <th scope="row">{{ $count}}</th>
            <td ><img src="{{$product->image_url}}" alt="..." style="width: 50px; height:50px"></td>
            <td>{{$product['name']}}</td>
            <td>{{$product['formatted_price']}}</td>
            <td>{{$product['quantity']}}</td>
            
            <td>{{$product['created_at']}}</td>
            <td>
                <a href={{route('products.edit',$product->id)}}><button type="button" class="btn btn-primary"><i class="far fa-edit" style="margin-right:5px"></i>{{__('Edit')}}</button></a>
            </td>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @method('delete')
                @csrf
                <td>
                    <button type="submit" class="btn btn-dark"> <i class="far fa-trash-alt" style="margin-right:5px"></i>{{__('Delete')}}</button>
                </td>
            </form>
            </tr>
         @endforeach   
    </tbody>
  </table>
  
@endsection