<nav class="navbar navbar-expand-lg navbar-dark bg-logo-color">
  <div class="container">
    <a class="navbar-brand" href="/"><img src="{{asset('storage/_images/logo.png')}}" width="70px"></a>
    <div class="navbar-toggler" data-target="#navbarNav" aria-controls="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/"><img src="{{'../storage/_images/home.png'}}"><span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/posts"><img src="{{'../storage/_images/posts.png'}}"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/plans"><img src="{{'../storage/_images/plans.png'}}"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><img src="{{'../storage/_images/stats.png'}}"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link settings-menu" href="#"><img src="{{'../storage/_images/settings.png'}}"></a>
        </li>
      </ul>
    </div>

    <div class="sidenav">
      <a href="/home">
            Dashboard
      </a>
      @auth
        @if(auth()->user()->role == 'coach' || auth()->user()->role == 'admin')
          <a href="/gymnasts">
              Gymnast
          </a>
        @endif
      @endauth
      <a class="logout-bg" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>





<!-- PC NAV -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/posts">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/plans">Plans</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Stats</a>
        </li>
      </ul>
      <ul class="navbar-nav pull-right">
        <li class="nav-item"><a class="nav-link" href="/user/{{auth()->user()->id}}/show">{{auth()->user()->name}}</a></li>
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <img src="{{asset('storage/_images/settings.png')}}" width="20px"><span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/home">
                  Dashboard
              </a>
              @auth
                @if(auth()->user()->role == 'coach' || auth()->user()->role == 'admin')
                  <a class="dropdown-item" href="/gymnasts">
                      Gymnast
                  </a>
                @endif
              @endauth
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>