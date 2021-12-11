@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<link rel="stylesheet" href="{{asset('assets/admin/formStyle/main.css')}}">
<div class="form-group">
    {{-- <x-form-input type = 'text' name =  'Name OF Category'  value = 'dfdfsd' /> --}}
    <label for="name">Name Of Category</label>
    <input type="text" name="name" id="name" value="{{old('name', $prevCategories->name)}}">
</div>
<div class="form-group">
    <label for="">Description</label>
    <textarea name="description" class=" form-control @error('description') is-invalid @enderror" cols="60" rows="3">{{old('description', $prevCategories->description)}}</textarea>
    <p class="invalid-feedback"> @error('description') {{$message}}   @enderror
  </div>
<div class="form-group">
  <label for="">Description</label>
  
  <img src="{{old('image', $prevCategories->image_url)}}" style="width: 50px; height: 50px">
   <input type="file" name="image" class="@error('image') is-invalid @enderror" value="{{old('image', $prevCategories->image_url)}}">
   <p class="invalid-feedback"> @error('image') {{$message}}   @enderror </p>

</div>
<div class="form-group">
  <x-form-select :label="__('Parent ID')" name='parent_id' :items="$categories" :selected='$prevCategories->parent_id' />
</div>
<div class="form-group">
  <label for="">Status</label>
  <input type="radio" value="active" class="@error('status') is-invalid @enderror" name="status" id="status"  style="margin-left: -10px" @if (old('status',$prevCategories->status) == 'active')
  checked
  @endif> <label for="Active">Active</label>
  <input type="radio" value="draft" class="@error('status') is-invalid @enderror" name="status" id="status" style="margin-left: -10px" @if (old('status',$prevCategories->status) == 'draft')
  checked
  @endif> <label for="Active">Draft</label>
  <p class="invalid-feedback"> @error('status') {{$message}}   @enderror
</div>
<div class="form-group">
  <button type="submit" class=" btn btn-primary" style="width: 8%; font-size:18px; margin:auto">{{$btn}}</button>
</div>