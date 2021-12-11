<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Route::is('categories.*') ? 'active' : ' ' }} ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Categories
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          @foreach ($categories as $category)
          {{-- {{dd(Route::is('http://localhost:8000/en/admin/categories/mohammed-obaid'))}} --}}
          {{-- {{dd(Route::getPath())}} --}}
          <li class="nav-item  ">
            <a href="/en/admin/categories/{{$category->slug}}" id='a' class="nav-link {{ Route::is('Categories.show',[$category->slug]) ? 'active' : ' '}}"
              <i class="far fa-circle nav-icon"></i>
              <p>{{$category->name}}</p>
            </a>
          </li>
          @endforeach
          
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Simple Link
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-dropdown-link class="nav-link" :href="route('logout')"
                  onclick="event.preventDefault();
                              this.closest('form').submit();">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                {{ __('Log Out') }} 
              </p>
          </x-dropdown-link>
      </form>
        {{-- <a href="{{route('logout')}}" class="nav-link"> --}}
          
        {{-- </a> --}}
      </li>
    </ul>
  </nav>