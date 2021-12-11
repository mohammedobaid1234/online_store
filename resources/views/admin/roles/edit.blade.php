{{-- {{dd($prevCategories->image_path)}} --}}
@extends('starter')
@section('links')
    <link rel="stylesheet" href={{asset('assets/admin/create/css/style.css')}}>
@endsection
@section('title','Edit Page')
    
@section('content')
    <form action={{ route('roles.update',[$prevRoles->id])  }} method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')
        @include('admin/roles/_form',[
          'btn' => 'Update'
        ])
    
    </form>
@endsection
@section('footer')
    <script src={{ asset('assets/admin/create/js/main.js') }}></script>
@endsection