@extends('starter')
@section('title', 'Roles')

@section('style')
    <style>
        button{
            width: 120px;
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
Product Page  <a href="{{route('roles.create')}}">Create</a>
@endsection
@section('breadclumb')
     <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
     <li class="breadcrumb-item active">Categories Page</li> 
@endsection
@section('trash')
    <div class="container" style="margin-top:10px">
        
        {{-- <a href="{{route('roles.trash')}}" class="btn btn-outline-primary"><i class="fa fa-trash"></i> Trash</a> --}}
    </div>
    {{-- <a href="" class="btn-outline btn-dark"></a> --}}
@endsection
@section('content')
    <x-message />
    {{-- <x-alert /> --}}
    <table class="table table-striped" >
    <thead>
       
        <th>Product Name</th>
        <th>Created_At</th>
        <th>Option</th>
    </thead>
        @foreach ($roles as $role)
            <tr> 
                <td>{{$role['name']}}</td>
                <td>{{$role->created_at}}</td>
                <td>
                    <a href={{route('roles.edit',$role->id)}}><button type="button" class="btn btn-primary"><i class="far fa-edit" style="margin-right:5px"></i>Edit</button></a>
                 </td>
                 <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                     @method('delete')
                     @csrf
                     <td>
                      <button type="submit" class="btn btn-dark"> <i class="far fa-trash-alt" style="margin-right:5px"></i>Delete</button>
                     </td>
               </form>
            </tr>   
        @endforeach
   
</table>
{{$roles->links()}}
@endsection
