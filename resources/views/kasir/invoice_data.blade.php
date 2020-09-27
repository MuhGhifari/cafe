<div class="col-lg-4 col-md-6">
  <div class="checkout__order">
    <h4 class="text-center">Pesanan Online</h4>
    <div class="checkout__order__total">Nama <span>{{ $order->user->name }}</span></div>
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
    <input type="hidden" name="total" id="total" value="{{ $total }}">
    <div class="checkout__order__total">
      <div class="row">
        <div class="col-4">Tunai</div>
        <input type="text" class="form-control col-8" id="tunai" name="tunai" autocomplete="off">
      </div>
    </div>
    <div class="checkout__order__total" style="display: none;" id="kembalian-container">
      <input type="hidden" name="kembalian-value" id="kembalian_value">
      Kembalian <span id="kembalian">{{ rupiah(0) }}</span>
    </div>
    <div class="row">
      <div class="col-md-12" id>
        <a href="#" id="bayar" class="btn btn-success btn-lg w-100">Hitung Pembayaran</a>
      </div>
      <div class="col-md-6" id="kembali-bayar" style="display: none;">
        <a href="#" class="btn btn-success btn-lg w-100">Kembali</a>
      </div>
      <div class="col-md-6" id="checkout" style="display: none;">
        <a href="#" class="btn btn-success btn-lg w-100">Checkout</a>
      </div>
      <input type="hidden" id="order_id" name="order_id" value="{{ $order->id }}">
      <input type="hidden" id="user_id" name="user_id" value="{{ $order->user_id }}">
    </div>
  </div>
</div>