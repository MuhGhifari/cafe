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
      <div class="che ckout__form">
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
                @if($order->status == 'selesai')
                <a id="showDetail" href="{{ route('member.transaction.detail', $order->id) }}" class="btn btn-success w-100">Lihat Detail Transaksi</a>
                @elseif($order->status == 'diproses')
                <a href="{{ route('member.cancel.order', $order->id) }}" class="btn btn-danger w-100">Batalkan Pesanan</a>
                @endif
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <div class="modal fade modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        ...
      </div>
    </div>
  </div>
  <!-- Checkout Section End -->

  <!-- Modal -->
  <div class="modal fade" id="dataModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless">
          <tr>
            <td width="40%">Kode Invoice</td>
            <td width="10%">:</td>
            <td id="invoice"></td>
          </tr>
          <tr>
            <td width="40%">Pemesan</td>
            <td width="10%">:</td>
            <td id="pemesan"></td>
          </tr>
          <tr>
            <td width="40%">Total tagihan</td>
            <td width="10%">:</td>
            <td id="total"></td>
          </tr>
          <tr>
            <td width="40%">Tunai</td>
            <td width="10%">:</td>
            <td id="tunai"></td>
          </tr>
          <tr>
            <td width="40%">Kembalian</td>
            <td width="10%">:</td>
            <td id="kembalian"></td>
          </tr>
          <tr>
            <td width="40%">Kasir</td>
            <td width="10%">:</td>
            <td id="kasir"></td>
          </tr>
          <tr>
            <td width="40%">Tanggal Transaksi</td>
            <td width="10%">:</td>
            <td id="tanggal"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function formatRibuan(bilangan){
      var number_string = bilangan.toString(),
        sisa  = number_string.length % 3,
        rupiah  = number_string.substr(0, sisa),
        ribuan  = number_string.substr(sisa).match(/\d{3}/g);
          
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
      return rupiah;
    }

    $(document).on('click', '#showDetail', function(event){
      event.preventDefault();
      $.ajax({
        url: $(this).attr('href'),
        success:function(data){
          $('#dataModal').modal('show');
          $('#invoice').html(data.invoice);
          $('#pemesan').html(data.pemesan);
          $('#total').html('Rp. ' + formatRibuan(data.total));
          $('#tunai').html('Rp. ' + formatRibuan(data.cash));
          $('#kembalian').html('Rp. ' + formatRibuan(data.change));
          $('#kasir').html(data.kasir);
          $('#tanggal').html(data.tanggal);
        }
      });
    });

  });
</script>
@endsection