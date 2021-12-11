<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      <span class="badge badge-warning navbar-badge unread">{{$unread}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-header"> <span class="unread" id="unread">{{$unread}} </span> Notification</span>
      <div id='notification1'>
      @foreach ($notification as $item)
      <a href="#" class="dropdown-item">
                @if ($item->read_at == null)
                  <b style="color: #f00">*</b>
                  
                @endif
                {{$item->data['title']}}
            <span class="float-right text-muted text-sm time">{{$item->created_at->diffForHumans()}}</span>
        </a>
        @endforeach
      </div>
        <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>