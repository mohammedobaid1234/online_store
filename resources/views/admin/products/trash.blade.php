@extends('starter')
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

@section('title')
Trash Product Page  <a href="{{route('products.create')}}">Create</a>
@endsection
@section('breadclumb')
     <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
     <li class="breadcrumb-item active">Trash Products Page</li> 
@endsection
@section('trash')
@if ($products->first())
    <div class="container" style="margin-top:10px">
        
        <form action="{{ route('products.restore') }}" method="POST">
            @method('put')
            @csrf
            <td>
             <button type="submit"  style="width: 15%; margin-left: 10px" class="btn btn-outline-primary"> <i class="fas fa-trash-restore" ></i>Restore All</button>
            </td>
      </form>
  
    <form action="{{ route('products.force-delete') }}" method="POST">
        @method('delete')
        @csrf
        <td>
         <button type="submit"  style="width: 15%; margin-left: 10px" class="btn btn-outline-dark"> <i class="far fa-trash-alt" ></i> Delete All</button>
        </td>
  </form>
    </div>
    {{-- <a href="" class="btn-outline btn-dark"></a> --}}
@endsection
@section('content')
    <x-message />
    {{-- <x-alert /> --}}

<table class="table table-striped" >
    <thead>
        <th>#</th>
        <th>Product Name</th>
        <th>proice</th>
        <th>quantity</th>
        <th>width</th>
        <th>height</th>
        <th>wight</th>
        <th>length</th>
        <th>Created At</th>
        <th>Operation</th>
    </thead>
        @foreach ($products as $product)
            <tr>
                <td>{{$product['id']}}</td>
                <td>{{$product['name']}}</td>
                {{-- <td>{{$product['Product_name']}}</td> --}}
                <td>{{$product['price']}}</td>
                <td>{{$product['quantity']}}</td>
                <td>{{$product['width']}}</td>
                <td>{{$product['height']}}</td>
                <td>{{$product['wight']}}</td>
                <td>{{$product['length']}}</td>
                <td>{{$product['created_at']}}</td>
                             
                    <form action="{{ route('products.restore', $product->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <td>
                         <button type="submit"  style="width: 110%" class="btn btn-outline-primary"> <i class="fas fa-trash-restore" ></i>Restore</button>
                        </td>
                  </form>
              
                <form action="{{ route('products.force-delete', $product->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <td>
                     <button type="submit"  style="width: 110%" class="btn btn-outline-dark"> <i class="far fa-trash-alt" ></i>Force Delete</button>
                    </td>
              </form>
            </tr>   
        @endforeach
   
</table>
@else
    <div class="alert alert-primary" style="width:80%; margin:auto;text-align:center ;margin-top: 20px; font-size :20px; ">
        No Tarshed 
    </div>
@endif
{{$products->links()}}
@endsection
