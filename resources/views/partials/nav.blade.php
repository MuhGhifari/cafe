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
          @if(Route::has('login'))
            @auth
              @if(auth()->user()->role == 'kasir')
              <li class="active"><a href="{{ route('home') }}">Menu</a></li>
              <li><a href="">Pesanan</a></li>
              @endif
            @else
            <li class="active"><a href="{{ route('home') }}">Home</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">Special Offer</a></li>
            @endauth
          @endif
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