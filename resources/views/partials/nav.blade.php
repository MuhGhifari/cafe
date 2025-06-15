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
              <li class="{{ Request::routeIs('kasir.index') ? 'active' : '' }}"><a  href="{{ route('kasir.index') }}">Pesanan Baru</a></li>
              <li class="{{ Request::routeIs('kasir.online.payment') ? 'active' : '' }}"><a href="{{ route('kasir.online.payment') }}">Pesanan Online</a></li>
              @elseif(auth()->user()->role == 'member')
              <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
              <li><a href="">Contact</a></li>
              <li><a href="">Special Offer</a></li>
              @endif
            @else
            <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
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
                @if(auth()->user()->role == 'member')
                <li><a href="{{ route('member.show.favorites') }}">Favoritku</a></li>
                <li><a href="{{ route('member.show.orders') }}">Pesanan</a></li>
                @endif
                <li><a href="{{ route('logout') }}">Logout</a></li>
              </ul>
            </div>
            @if(auth()->user()->role == 'member')
            <div class="header__top__right__auth">
              @if(Request::routeis('member.cart'))
              <a class="keranjang" href="{{ route('member.cart') }}" style="position: relative;" data-toggle="tooltip" data-placement="bottom" title="Keranjang"><i class="fa fa-shopping-bag"></i></a>
              @else
              <a class="keranjang" href="{{ route('member.cart') }}" style="position: relative;" data-toggle="tooltip" data-placement="bottom" title="Keranjang"><i class="fa fa-shopping-bag"></i>
                @if(auth()->user()->waitingOrder->first() == null)
                <span id="cart-item-qty" style="display: none;"></span>
                @else
                <span id="cart-item-qty">{{ count(auth()->user()->waitingOrder->first()->orderItems) }}</span>
                @endif
              </a>
              @endif
            </div>
            @endif
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