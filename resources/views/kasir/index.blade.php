@extends('layouts.app')

@section('content')
  <!-- Product Section Begin -->
  <section class="product spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-5">
          <div class="sidebar">
            <div class="sidebar__item">
              <h4>Kategori</h4>
              <ul>
                <li class="{{ Request::is('kasir.index') ? 'active' : '' }}"><a href="{{ route('kasir.index') }}">Semua Produk</a></li>
                @foreach($categories as $category)
                <li class="{{ Request::is('products/categories/'.$category->id.'/'.str_replace(' ', '-', strtolower($category->name))) ? 'active' : '' }}"><a href="{{ route('products.category', ['id' => $category->id, 'slug' => str_replace(' ', '-', strtolower($category->name))]) }}">{{ $category->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-7">
          <!-- Search -->
          <div class="col-lg-9">
            <div class="hero__search">
              <div class="hero__search__form">
                <form action="#">
                  <input type="text" placeholder="Search what do yo u need?">
                  <button type="submit" class="site-btn">SEARCH</button>
                </form>
              </div>
            </div>
          </div>
          <!-- End Search -->
          <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset('img/products/'.$product->image)}}">
                  <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                  </ul>
                </div>
                <div class="product__item__text">
                  <h6><a href="#">{{ $product->name }}</a></h6>
                  <h5>{{ rupiah($product->price) }}</h5>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          {{ $products->links('partials.pagination') }}
        </div>
      </div>
    </div>
  </section><br>

@endsection
