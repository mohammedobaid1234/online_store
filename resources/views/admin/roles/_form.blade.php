
<link rel="stylesheet" href="{{asset('assets/admin/formStyle/main.css')}}">
<div class="form-group">
   <x-form-input  type="text" name="name" label="Name Of Category" :value="$prevRoles->name" />
 </div>
<div class="form-group">
  @foreach (config('abilities') as $key => $value)
  <div class="form-check">
    <input class="form-check-input" 
    
    @if (in_array($key,$prevRoles->abilities ?? []))
        checked
    @endif
    type="checkbox" name="abilities[]" value="{{$key}}">
    <label class="form-check-label"  style="width: 700px">
      {{$value}}
    </label>
  </div> 
  @endforeach
</div>
<div class="form-group">
  <button type="submit" class=" btn btn-primary" style="width: 8%; font-size:18px; margin:auto">{{$btn}}</button>
</div>