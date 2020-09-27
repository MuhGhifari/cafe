
<div class="row">
  @if(count($products) < 1)
  <div class="col-md-12 text-center">
    <h5>No results</h5>
  </div>
  @endif
  @foreach($products as $product)
  <div class="col-md-3" id="item">
    <div class="product__item p-2" style="background: #dce0e2;">
      <div class="thumbnail">
        <img src="{{ asset('img/products/'. $product->image) }}">
      </div>
      <div class="product__item__text">
        <h6 style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->name }}</h6>
        <h5>{{ rupiah($product->price) }}</h5>
      </div>
      <a href="{{ route('kasir.add.item', ['product_id' => $product->id]) }}" class="add-btn" id="{{ $product->id }}">
        <div class="btn-success text-center m-2 p-1">
          Tambah +
        </div>
      </a>
    </div>
  </div>
  @endforeach
</div>
{{ $products->links('partials.pagination') }}