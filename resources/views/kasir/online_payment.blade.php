@extends('layouts.app')

@section('stylesheets')
<style type="text/css">
  .checkout__input input{
    font-size: 2.2em;
    height: 200px;
    color: red;
    text-align: center;
    letter-spacing: 5px;
    text-transform: uppercase;
  }
</style>
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Transaksi Online</h2>
          <div class="breadcrumb__option">
            <a href="{{ route('home') }}">Home</a>
            <span>Pesanan Online</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Checkout Section Begin -->
  <section class="checkout spad p-4">
    <div class="container">
      <div class="checkout__form">
        <h4 class="title text-center">Masukkan Kode Invoice Pelanggan</h4>
        <form>
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6" id="input-form">            
              <div class="checkout__input">
                <input class="border border-danger" maxlength="11" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" type="text" id="invoice" placeholder="kode invoice" onkeypress="return event.keyCode != 13;" required>
              </div>     
              <div class="checkout__input">
                <a class="btn btn-success btn-lg w-100" id="findInvoice" href="{{ route('kasir.find.online.order') }}">Cari Pesanan</a>
                <a class="btn btn-success btn-lg w-100" id="kembali" href="{{ route('kasir.online.payment') }}" style="display: none;">Kembali</a>
              </div>
            </div>
            @if(isset($order))
            @include('kasir.invoice_data')
            @endif
          </div>
        </form>
      </div>
    </div>
  </section>
<!-- Checkout Section End -->
@endsection

@section('scripts')
<script type="text/javascript">
  $(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#invoice').on('focus blur', function(){
      if($(this).attr('placeholder')){
        $(this).attr('placeholder', '');
      }
      else{
        $(this).attr('placeholder', 'KODE INVOICE');
      }
    });

    function bayar(){
      var tunai = $('#tunai').val();
      tunai = Number(tunai.replace(/\D/g, ''));
      var total = Number($('#total').val());
      var kembalian = 0;
      if (total == 0) {
        alert('Keranjang kosong!');
      }
      else{
        if(tunai >= total) {
          kembalian = tunai - total;
          $('#kembalian-container').css('display', 'block');
          $('#kembalian_value').val(kembalian);
          $('#kembalian').html('Rp ' + formatRibuan(kembalian));
          $('#bayar').css('display', 'none');
          $('#tunai').prop('disabled', true);
          $('#kembali-bayar').css('display', 'block');
          $('#checkout').css('display', 'block');
        }else{
          alert('Uang tunai tidak mencukupi');
        }
      }
    }

    $(document).on('click', '#bayar', function(event){
      event.preventDefault();
      bayar();
    });

    $(document).on('keypress', '#tunai', function(event){
      if (event.which == 13) {
        bayar();
      }
    });

    $(document).on('click', '#kembali-bayar', function(event){
      event.preventDefault();
      $('#kembalian-container').css('display', 'none');
      $('#bayar').css('display', 'block');
      $('#tunai').prop('disabled', false);
      $('#kembali-bayar').css('display', 'none');
      $('#checkout').css('display', 'none');
      $('#tunai').val('');
    });

    function getOrder(){
      var invoice = $('#invoice').val();
      if (invoice != null) {
        $.ajax({
          url: $('#findInvoice').attr('href'),
          method: 'POST',
          data:{invoice: invoice},
          success:function(data){
            $(data).insertAfter('#input-form');
            $('#invoice').prop('disabled', true);
            $('#findInvoice').css('display', 'none');
            $('#kembali').css('display', 'block');
            $('#tunai').focus();
            callSuccessAlert('Pesanan berhasil ditemukan!');
          },
          error:function(xhr, status, error){
            var jsonResponse = JSON.parse(xhr.responseText);
            callDangerAlert(error + ": " + jsonResponse.message);
          }
        });
      }
      else{
        callDangerAlert('Isi kode invoice terlebih dahulu!');
      }
    }

    // format rupiah dinamis
    function formatTunai(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }


    // format satuan angka
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

    $(document).on('keyup', '#tunai', function(){
      $(this).val(formatTunai($(this).val(), 'Rp '));
    });


    $("#invoice").keypress(function(e) {
        if(e.which == 13) {
          getOrder();
        }
    });

    $(document).on('click', '#findInvoice', function(event){
      event.preventDefault();
      getOrder();
    });

    $(document).on('click', '#checkout', function(event){
      event.preventDefault();
      var order_id = $('#order_id').val();
      var user_id = $('#user_id').val();
      var total = $('#total').val();
      var cash = $('#tunai').val();
      cash = Number(cash.replace(/\D/g, ''));
      var change = $('#kembalian_value').val();
      $.ajax({
        url: "{{ route('kasir.transaction.save') }}",
        method: "POST",
        data:{order_id:order_id, user_id:user_id, cash:cash, change:change, total:total,},
        success:function(data){
          callSuccessAlert(data.message);
          window.location.href = "{{ route('kasir.online.payment') }}";
        }
      });
    });

  });

</script>
@endsection