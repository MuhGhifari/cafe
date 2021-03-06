<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
   <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
   @include('partials.css')
</head>
<body>
    <main class="py-4">
      <header class="header">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <div class="header__logo">
                <!-- <a href="./index.html"><img src="img/logo2.png" alt=""></a> -->
                <h2 style="font-weight: bold; padding:5px;">DALGONA</h2>
              </div>
            </div>
            <div class="col-lg-6">
              <nav class="header__menu">
                <ul>
                  <li class="active"><a href="{{ route('home') }}">Menu</a></li>
                  <li><a href="">Pesanan</a></li>
                </ul>
              </nav>
            </div>
            <div class="col-lg-3">
              <div class="header__cart">
                @if(Route::has('login'))
                  @auth
                  <div class="header__top__right__language">
                      <div>{{ auth()->user()->name }}</div>
                      <span class="arrow_carrot-down"></span>
                      <ul>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                      </ul>
                  </div>
                  @else
                  <div class="header__top__right__auth">
                    <a href="{{ route('login') }}"> Login</a>
                  </div>
                    @if(Route::has('register'))
                     |
                    <div class="header__top__right__auth">
                      <a href="{{ route('register') }}"> Register</a>
                    </div>  
                    @endif
                  @endauth
                @endif
              </div>
            </div>
          </div>
        </div>
      </header>
      @yield('content')
    </main>
</body>
  <!-- Scripts -->
  @include('partials.js')
</html>
