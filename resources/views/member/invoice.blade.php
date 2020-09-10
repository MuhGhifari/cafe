@extends('layouts.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Invoice</h2>
          <div class="breadcrumb__option">
            <a href="{{ route('home') }}">Home</a>
            <span>Invoice</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
  <section class="checkout spad">
    <div class="container">
      <div class="checkout__form">
        <h4>Kode Invoice Anda</h4>
        <form action="#">
          <div class="row">
            <div class="col-lg-8 col-md-6">
              <div class="bg-success rounded h-50 mb-4 d-flex justify-content-center align-items-center">
                  <h1 class="border rounded border-white p-5" style="font-weight: bold; letter-spacing: 5px; color: white;">{{ $order->invoice }}</h1>
              </div>
              <p class="text-justify">Salin kode ini ke media yang anda punya seperti kertas atau simpan secara digital ke telepon genggam anda. Kemudian pergilah ke derai kami dan jangan lupa untuk membawa salinan kode ini dengan anda. Saat sampai di derai, mohon mengantri seperti biasa di antrian kasir. Mohon tunjukkan kode ini ke kasir untuk mengkonfirmasi pesanan anda. Jika pesanan yang kasir sebutkan sesuai dengan yang anda pesan, mohon bayar sesuai dengan yang tagihan yang diminta. <br><br> Terima kasih sudah berbelanja di toko kami!</p>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="checkout__order">
                <h4>Pesanan Anda</h4>
                <div class="checkout__order__total">Nama <span>{{ $order->user->name}}</span></div>
                <div class="checkout__order__products">Produk <span>Harga </span></div>
                <ul>
                  @foreach($order->orderItems as $item)
                  <?php if (strlen($item->product->name) > 20) {
                    $productName = substr($item->product->name, 0, 20) . '...';
                  }else{
                    $productName = $item->product->name;
                  } ?>
                  <li>{{ $productName  }} ({{ $item->quantity }})
                    <span>{{ rupiah($item->product->price * $item->quantity) }}</span>
                  </li>
                  @endforeach
                </ul>
                <div class="checkout__order__total">Total <span>{{ rupiah($total) }}</span></div>
                <a href="{{ route('home') }}" class="btn btn-success w-100">Selesai</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- Checkout Section End -->
@endsection
