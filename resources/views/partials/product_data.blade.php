@auth
@if(count(auth()->user()->waitingOrder) > 0)
<input type="hidden" name="order_id" id="order_id" value="{{ auth()->user()->waitingOrder->first()->id }}">
@else
<input type="hidden" name="order_id" id="order_id">
@endif
@endauth
<div class="row">
  @foreach($products as $product)
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
      <div class="product__item__pic">
        <div class="thumbnail">
          <img src="{{ asset('img/products/'.$product->image)}}">
        </div>
        <ul class="product__item__pic__hover item">
          @if(Route::has('login'))
            @auth
              <input type="hidden" class="product_id" id="product_id" name="product_id" value="{{ $product->id }}">
              @if($product->favorited() == true)
              <li><a data-toggle="tooltip" data-placement="top" title="Hapus dari Favorit" style="background: #7fad39; border-color: #7fad39; color: white;" class="favorite remove" href="{{ route('member.remove.favorite', $product->getFaveId()) }}"><i class="fa fa-heart"></i></a></li>
              @else
              <li><a data-toggle="tooltip" data-placement="top" title="Tambah ke Favorit" class="favorite" href="{{ route('member.save.favorite', $product->id) }}"><i class="fa fa-heart"></i></a></li>
              @endif
              <li><a data-toggle="tooltip" data-placement="top" title="Tambah ke keranjang" href="{{ route('member.add.item') }}" class="order"><i class="fa fa-shopping-cart"></i></a></li>
            @else
              <li><a href="{{ route('login') }}"><i class="fa fa-heart"></i></a></li>
              <li><a href="{{ route('login') }}"><i class="fa fa-shopping-cart"></i></a></li>
            @endauth
          @endif
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