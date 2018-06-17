      <nav class="navbar navbar-expand navbar-dark bg-dark">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  {{ config('app.name', 'Laravel') }}
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">

                  </ul>

                  <ul class="navbar-nav mr-auto">
                    @if(Auth::guest())
                      <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    @endif
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="/about">About</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="/services">Services</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="/albums">Coin Albums</a>
                      </li>
                    </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto">
                      <!-- Authentication Links -->
                      @guest
                          <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                          <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a href="/profile/{{Auth::user()->id}}", class="dropdown-item">Profile</a>
                                <a href="/mycoins", class="dropdown-item">My Coins</a>
                                <a href="/myalbums", class="dropdown-item">My Albums</a>
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
                      @endguest
                  </ul>
              </div>
          </div>
      </nav>