{{-- {{dd($messages)}} --}}
{{-- @foreach ($messages as $user)
{{dd($user->getName($user->from_id))}}
  {{dd($user->from_id)}}
@endforeach --}}
<li class="nav-item dropdown">    
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-comments"></i>
      <span class="badge badge-danger navbar-badge">{{$unread}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      
        @foreach ($messages as $msg)
        {{-- {{dd($msg)}} --}}
        {{-- {{dd('$user->id')}} --}}
        <a href="{{url('chatify')}}" class="dropdown-item">    
            <div class="media">
              {{-- <img src={{asset("uploads/tHLM0yf5hEPuldeFNQmYyhwKTlYplFZflPMH7P64.png")}} alt="User Avatar" class="img-size-50 mr-3 img-circle"> --}}
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{$msg->getName($msg->from_id)}}
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">{{$msg->body}}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$msg->created_at->diffForHumans()}}</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
        @endforeach
      
      
      <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
  </li>