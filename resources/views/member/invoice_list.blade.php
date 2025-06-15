@extends('layouts.app')

@section('content')
<!-- Breadcrumb Section Begin -->

<style type="text/css">
  .invoice{
    letter-spacing: 3px;
    text-transform: uppercase;
  }

  .invoice a{
    color: red;
    text-decoration: none;
    text-decoration-line: none;
  }

  .invoice a:hover{
    text-decoration-line: underline;
  }
</style>

<section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Pesanan Anda</h2>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
  <div class="container">
    <div class="shoping__cart__table">
      @if(count($orders) == 0)
      <div class="col-md-12 text-center">
        <h4>Belum ada pesanan</h4>
      </div>
      @else
      <table id="table">
        <thead>
          <tr>
            <th class="shoping__product">Kode Invoice</th>
            <th></th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal Dipesan</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td class="text-left">
              <h4 class="invoice">
                <a href="{{ route('member.invoice', $order->invoice) }}">{{ $order->invoice }}</a>
              </h4>
            </td>
            <td class="text-left">
              @if($order->status == 'selesai')
              <a id="showDetail" href="{{ route('member.transaction.detail', $order->id) }}" class="btn btn-success" style="color: white;">Detail</a>
              @elseif($order->status == 'diproses')
              <a href="{{ route('member.cancel.order', $order->id) }}" class="btn btn-danger" style="color: white;">Batal</a>
              @endif
            </td>
            <td>{{ rupiah($order->total) }}</td>
            <td>{{ ucfirst($order->status )}}</td>
            <td>{{ FormatTanggal($order->created_at) . ' ' . AmbilJam($order->created_at) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
</section>
<!-- Shoping Cart Section End -->

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