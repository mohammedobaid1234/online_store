<label for="" class="" >{{$label}}</label>
<select name="{{$name}}" class=" form-control @error($name) is-invalid @enderror" id="{{$name}}" class="form-control" style="display:inline-block; margin:0">
    <option value=''>{{$defalut ?? ''}}</option>
    @foreach ($items as $key=>$value)
        <option class="form-group" value={{$key}} @if ($key == old($name,$selected ?? null))
        selected
        @endif>{{$value}}</option>
    @endforeach      
</select>
<p class="invalid-feedback"> @error($name) {{$message}}   @enderror