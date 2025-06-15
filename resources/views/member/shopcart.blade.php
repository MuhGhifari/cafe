@extends('layouts.app')

@section('stylesheets')
<style type="text/css">
  .inline-group {
    max-width: 100%;
    padding: 0 60px 0 60px;
  }

  .inline-group .form-control {
    text-align: center;
  }

  .form-control[type="number"]::-webkit-inner-spin-button,
  .form-control[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
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
      <div class="col-lg-12">
        <div class="shoping__cart__table">
          @if(isset($cart))
          <table id="cart-table">
            <thead>
              <tr>
                <th class="shoping__product">Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($cart as $item)
              <tr>
                <input type="hidden" name="item_id" id="item_id" value="{{ $item->id }}">
                <td class="shoping__cart__item">
                  <img style="height: 120px; width: 120px;" src="{{ asset('img/products/'. $item->product->image )}}" alt="{{ $item->product->image }}">
                  <h5>{{ $item->product->name }}</h5>
                </td>
                <td class="shoping__cart__price">
                  <input type="hidden" name="price" id="item_price" value="{{ $item->product->price }}">
                  {{ rupiah($item->product->price) }}
                </td>
                <td class="text-center">
                  <div class="input-group inline-group">
                    <div class="input-group-prepend">
                      <button class="btn btn-success btn-minus">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <input class="form-control quantity" min="1" max="{{ $item->product->stock }}" name="quantity" id="quantity" value="{{ $item->quantity }}" type="number" disabled>
                    <div class="input-group-append">
                      <button class="btn btn-success btn-plus">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                  </div>
                </td>
                <td class="shoping__cart__total" id="item_total">
                  {{ rupiah($item->product->price * $item->quantity) }}
                </td>
                <td class="shoping__cart__item__close">
                  <a style="text-decoration: none;" href="{{ route('member.remove.item', $item->id) }}" class="remove-btn">
                    <i class="fa fa-close"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="col-md-12 text-center">
            <h4>Keranjang masih kosong</h4>
          </div>
          @endif
        </div>
      </div>
    </div>
    @if(isset($cart))
    <div class="row" id="total-box">
      <div class="col-lg-6"></div>
      <div class="col-lg-6">
        <div class="shoping__checkout">
          <h5>Total belanjaan</h5>
          <ul>
            <li>Total harga <span id="cart-total">{{ rupiah($cart_total) }}</span></li>
          </ul>
          <form method="post" action="{{ route('member.save.order') }}">
          @csrf
            <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}" required>
            <input type="submit" class="btn btn-success w-100" value="Pesan">
          </form>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
<!-- Shoping Cart Section End -->
@endsection

@section('scripts')
<script type="text/javascript">
  $(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function delay(fn, ms) {
      let timer = 0
      return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
      }
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

    function hitungTotalCart(){
      var cart_total = 0;
      $('#cart-table > tbody  > tr').each(function(){
        var price = $(this).find('#item_price').val();
        var qty = $(this).find('#quantity').val();
        cart_total += price * qty;
      });
      $('#cart-total').html('Rp ' + formatRibuan(cart_total));
    }
    
    $(document).on('click', '.btn-plus, .btn-minus', function(e) {
      const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
      const input = $(e.target).closest('.input-group').find('input');
      if (input.is('input')) { 
        input[0][isNegative ? 'stepDown' : 'stepUp']()

      }

      input.attr('value', input.val()).trigger('change'); 

      var qtyInput = $(this).closest('tr').find('#quantity').val();
      var itemID = $(this).closest('tr').find('#item_id').val();
      var item_price = $(this).closest('tr').find('#item_price').val();
      var item_total_value = qtyInput * item_price;
      var item_total = $(this).closest('tr').find('#item_total');
      item_total.html('Rp ' + formatRibuan(item_total_value));

      hitungTotalCart();
    });

    $(document).on('change', '#quantity', delay(function(){
      var qtyInput = $(this).val();
      var itemID = $(this).closest('tr').find('#item_id').val();
      $.ajax({
        url: "{{ route('member.add.item.quantity') }}",
        method: 'POST',
        data:{quantity: qtyInput, order_item_id: itemID},
        error:function(error){
          callDangerAlert(error);
        }
      });    
    }, 400));

    // hapus item dari cart
    $(document).on('click', '.remove-btn', function(event){
      event.preventDefault();
      var thisDiv = $(this).closest('tr');
      $.ajax({
        url: $(this).attr('href'),
        success:function(data){
          $('#cart-total').html(data.cart_total);
          $('#total').val(data.total);
          thisDiv.remove();
          if (data.kosong == true) {
            $('#total-box, #cart-table').remove();
            $('.shoping__cart__table').html('<div class="col-md-12 text-center"><h4>Keranjang masih kosong</h4></div>');
          }
          callSuccessAlert(data.success);
          hitungTotalCart();
        },
        error:function(error){
          callDangerAlert(error);
        }
      });
    });
  });
</script>
@endsection