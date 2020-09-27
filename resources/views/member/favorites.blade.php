@extends('layouts.app')

@section('stylesheets')
<style type="text/css">
  .card-btn a{
    text-decoration: none;
    background: #7fad39;
    color: white;
    font-size: 2em;
    border-radius: 50%;
    transition: all, 0.3s;
  }

  .order:hover {
    background: #63882c;
  }

  .remove:hover{
    background: #c10505;
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
          <h2>Favorit</h2>
          <div class="breadcrumb__option">
            <a href="#">Home</a>
            <span>Favorit</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
  <section class="product spad">
    <div class="container">
      <div class="section-title">
        <h2>Produk Favorit Anda</h2>
      </div>
        <div class="row justify-content-center">
          @if(count($faves) < 1)
          <div class="col-md-12 text-center m-5 pb-5">
            <h5 style="color: #a29f9f; font-size: 1.3em;">Belum ada produk favorit</h5>
          </div>
          @endif
          @if(count(auth()->user()->waitingOrder) > 0)
          <input type="hidden" name="order_id" id="order_id" value="{{ auth()->user()->waitingOrder->first()->id }}">
          @else
          <input type="hidden" name="order_id" id="order_id">
          @endif
          @foreach($faves as $fave)
          <div class="item col-md-3">
            <input type="hidden" name="product_id" id="product_id" value="{{ $fave->product->id }}" required>
            <div class="product__item pb-3" style="background: #dce0e2; border-radius: 3%;">
              <div class="thumbnail">
                <img src="{{ asset('img/products/'. $fave->product->image) }}">
              </div>
              <div class="product__item__text m-2">
                <h4 style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $fave->product->name }}</h4>
                <h5 class="m-2">{{ rupiah($fave->product->price) }}</h5>
              </div>
              <div class="row mt-4 mb-4">
                <div class="col-md-6 text-right card-btn">
                  <a class="remove p-2" data-toggle="tooltip" data-placement="bottom" title="Hapus dari favorit" href="{{ route('member.remove.favorite', $fave->id) }}"><i class="m-2 fa fa-trash"></i></a>
                </div>
                <div class="col-md-6 text-left card-btn">
                  <a class="order p-2" data-toggle="tooltip" data-placement="bottom" title="Tambah ke keranjang" href="{{ route('member.add.item') }}"><i class="m-2 fa fa-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        {{ $faves->links('partials.pagination') }}
    </div>
  </section><br>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function(){
    // token csrf untuk ajax

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click', '.order', function(event){
      event.preventDefault();
      var thisElement = $(this);
      var link = thisElement.attr('href');
      var product_id = thisElement.closest('.item').find('#product_id').val();
      var order_id = $('#order_id');
      $.ajax({
        url: link,
        method: 'POST',
        data:{product_id:product_id, order_id:order_id.val()},
        success:function(data){
          callSuccessAlert(data.success);
          $('#cart-item-qty').css('display', 'block').text(data.item_qty);
          order_id.val(data.order_id);
        },
        error:function(request, status, error){
          callDangerAlert(error); 
        }
      });

    });

  });
</script>
@endsection