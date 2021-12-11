@extends('starter')
@section('title', 'Products')

@section('style')
    <style>
        button{
            width: 120%;
            padding: 0;
            display: inline-block;
            float: left;
        }
       
        .clearFix{
            clear: both;
        }
    </style>
@endsection

@section('title-a')
{{__('Product Page')}}  <a href="{{route('products.create')}}">{{__('Create')}}</a>
@endsection
@section('breadclumb')
     <li class="breadcrumb-item"><a href="{{route('home.index')}}">{{__('Home')}}</a></li>
     <li class="breadcrumb-item active">{{__('Categories Page')}}</li> 
@endsection

@section('trash')
    <div class="container" style="margin-top:10px">
        
        <a href="{{route('products.trash')}}" class="btn btn-outline-primary"><i class="fa fa-trash"></i> {{__('Trash')}}</a>
    </div>
    {{-- <a href="" class="btn-outline btn-dark"></a> --}}
@endsection
@section('content')
<x-message />
{{-- <x-alert /> --}}
<table class="table table-striped" >
    <thead>
        <th></th>
        <th>{{__('Product Name')}}</th>
        <th>{{__('price')}}</th>
        <th>{{__('quantity')}}</th>
        <th>{{__('Created At')}}</th>
        <th>{{__('Operation')}}</th>
    </thead>
 
    @foreach ($products as $product)
    <tr>
        <td ><img src="{{$product->image_url}}" alt="..." style="width: 50px; height:50px"></td>
        {{-- <td>{{$product['id']}}</td> --}}
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
   
</table>
{{$products->links()}}
@endsection
