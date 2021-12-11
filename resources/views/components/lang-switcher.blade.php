
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-globe"></i>
            
        </a>
        <div class="dropdown-menu  dropdown-menu-right">
            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
          {{-- /Route::current()->uri() --}}
          <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
            {{ $properties['native'] }}
        </a>
            {{-- <a href="{{ route(Route::currentRouteName())}}?lang={{$code}}" class="dropdown-item">{{$name}}</a> --}}
            @endforeach
        </div>
    </li>
 