@extends('layouts.app')

@section('content')
<!-- Breadcrumb Section Begin -->

<style type="text/css">
  a .invoice h1 p{
    text-decoration: none;
  }
  .invoice{
    width: 40%;
    height: 200px;
    background: grey;
    box-shadow: 3px 3px 5px 2px #ccc;
  }
  h3{
    padding: 50px;
    margin-bottom: -40px;
    text-align: center;

    color: white
  }
  p{
    text-align: center;
    color: white;
  }
</style>

<section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Keranjang Belanjaan</h2>
          <div class="breadcrumb__option">
            <a href="{{ route('home') }}">Home</a>
            <span>Keranjang</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        
      </div>
    </div>
  </div>
</section>
<!-- Shoping Cart Section End -->
@endsection