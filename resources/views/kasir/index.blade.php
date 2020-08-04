@extends('layouts.app')

@section('stylesheets')
<style type="text/css">
	.hero__search__form {
		width: 100%;
	}

	.btn-success {
	   background-color: #7fad39;
	}

	.btn-success:hover {
	   background-color: #709834;
	}
 
	.btn-success:active {
	   background-color: #59792a;
	}
 
	.btn-success:click {
	   background-color: #59792a;
	}
</style>
@endsection

@section('content')
  <!-- Shoping Cart Section Begin -->
	<section class="shoping-cart spad p-2">
		<div class="row">
			<div class="col-lg-7 p-4" style="background: #f2f2f2;">
				<div class="row justify-content-center">
					<div class="col-3 text-center">
						<h3 class="p-2" style="background: #dce0e2; color: #7fad39;">Menu</h3>
					</div>
					<div class="col-9">
						<div class="hero__search">
							<div class="hero__search__form">
								<form class="row p-0">
										<input style="width: 100%" type="text" id="search" name="search" placeholder="Cari produk..." onkeypress="return event.keyCode != 13;"><!-- keycode 13 = enter key -->
										<button class="site-btn" disabled>PENCARIAN</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="item_container" id="result">
					@include('kasir.product_data')
					<input type="hidden" name="hidden_page" id="hidden_page" value="1" />
				</div>
			</div>
			<div class="col-lg-5 p-4" style="background: #dce0e2;">
				<div class="row">
					<div class="col-8">
						<div class="hero__search">
							<div class="hero__search__form">
								<form class="row">
									@if(count(auth()->user()->waitingOrder) < 1)
									<input style="width: 100%" type="text" id="customer_name" name="customer_name" placeholder="Nama Customer" onkeypress="return event.keyCode != 13;"><!-- keycode 13 = enter key -->
									@else
									<input style="width: 100%" type="text" id="customer_name" name="customer_name" placeholder="Nama Customer" value="{{ auth()->user()->waitingOrder->first()->name }}" disabled onkeypress="return event.keyCode != 13;"><!-- keycode 13 = enter key -->
									@endif
								</form>
							</div>
						</div>
					</div>
					@if(count(auth()->user()->waitingOrder) < 1)
					<input type="hidden" name="order_id" id="order_id" value="">
					<a href="{{ route('kasir.order') }}" id="order-btn" class="col-4 text-center">
						<h3 class="p-2 btn-success">Pesan</h3>
					</a>
					@else
					<input type="hidden" name="order_id" id="order_id" value="{{ auth()->user()->waitingOrder->first()->id }}">
					<a href="#" id="order-btn" class="col-4 text-center">
						<h3 class="p-2 btn-success">Pesan</h3>
					</a>
					@endif
				</div>
				<div class="row">
					<div class="col-12">
						<div class="shoping__cart__table">
							<table>
								<thead>
									<tr>
										<th class="shoping__product" colspan="2">Produk</th>
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Total</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="orderItems">
									@if(count(auth()->user()->waitingOrder) > 0)
									@foreach($cart as $item)
									<tr>
										<td align="left" width="15%">
											<img style="height: 80px; width: 80px;" src="{{ asset('img/products/'. $item->product->image) }}">
										</td>
										<td align="center" width="20%">
											{{ $item->product->name }}
										</td>
										<td>
											{{ rupiah($item->product->price) }}
										</td>
										<td width="14%">
											<input type="hidden" id="order_item_id" name="order_item_id" value="{{ $item->id }}">
											<input type="number" class="quantity form-control" id="quantity" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" onkeydown="return false">
										</td>
										<td class="item-total">
											{{ rupiah($item->product->price * $item->quantity)}}
										</td>
										<td>
											<a href="{{ route('kasir.remove.item', $item->product->id) }}" class="remove-btn">
												<i class="fa fa-close"></i>
											</a>
										</td>
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row" id="cart-footer">
					@if(isset($order_id))
					<div class="col-lg-12">
						<div class="shoping__checkout" style="background: #f2f2f2; ">
							<h5>Keranjang</h5>
							<ul>
								<li>Total Tagihan<span id="cart-total">{{ rupiah($cart_total) }}</span></li>
								<input type="hidden" name="total" id="total" value="{{ $cart_total }}">
								<li>Uang Tunai<span><input type="text" min="0" name="tunai" id="tunai" class="form-control"></span></li>
								<li style="display: none;" id="kembalian-container">Kembalian <span id="kembalian"></span></li>
								<input type="hidden" name="kembalian_value" id="kembalian_value">
							</ul>
							<div class="row">
								<a href="{{ route('kasir.delete.order', $order_id) }}" id="remove-order-btn" class="col-md-6 text-center">
									<h5 style="color: white;" class="btn-success m-0 p-3">Cancel Order</h5>
								</a>
								<a href="#" class="col-md-6 text-center" id="bayar">
									<h5 style="color: white;" class="btn-success m-0 p-3">Bayar</h5>
								</a>
								<a href="#" class="col-md-6 text-center" id="kembali" style="display: none;">
									<h5 style="color: white;" class="btn-success m-0 p-3">Kembali</h5>
								</a>
								<a href="#" class="col-md-6 text-center" id="checkout" style="display: none;">
									<h5 style="color: white;" class="btn-success m-0 p-3">Selesai</h5>
								</a>
							</div>
						</div>
					</div>
					@else
					<div class="col-md-12 text-center">
					  <h5>Belum ada pesanan</h5>
					</div>
					@endif
				</div>
			</div>
		</div>
	</section>
	<!-- Shoping Cart Section End -->

@endsection

@section('scripts')
<script type="text/javascript">

	$(document).ready(function(){
		// token csrf untuk ajax
		$.ajaxSetup({
	    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});

		//ambil & tampilkan data
		function fetch_data(page, query){
			var disabled = false;
			if ($('#tunai').prop('disabled') == true) {disabled = true;}
			$.ajax({
				url:"/kasir/search?query="+query+"&page="+page,
				success:function(data){
						console.log(disabled);
					$('#result').html('');
					$('#result').html(data);
					if (disabled == true) {
						$('#result').find('.add-btn').addClass('disabled');
					}
				}
			});
		}

		//waktu delay function keyup
		function delay(fn, ms) {
		  let timer = 0
		  return function(...args) {
		    clearTimeout(timer)
		    timer = setTimeout(fn.bind(this, ...args), ms || 0)
		  }
		}

		//function livesearch (pencarian langsung)
		$('#search').keyup(delay(function(){
			var query = $('#search').val();
			var page = $('#hidden_page').val();
			fetch_data(page, query);
		}, 400));//delay 400 miliseconds

		//pagination
		$(document).on('click', '.product__pagination a', function(event){
			event.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			$('#hidden_page').val(page);
			var query = $('#search').val();

			$('a').removeClass('active');
			$(this).parent().addClass('active');
			fetch_data(page, query);
		});

		// tambah item ke cart
		$(document).on('click', '.add-btn', function(event){
			event.preventDefault();
			if ($(this).hasClass('disabled')) {
				alert('Tekan kembali untuk mengubah order');
			}else{
				$.ajax({
					url: $(this).attr('href'),
					success:function(data){
						$('#orderItems').html(data.output);
						$('#cart-total').html(data.cart_total);
						$('#total').val(data.total);
					}
				});
			}
		});

		$(document).on('change', '#quantity', function(){
			var order_item_id = $(this).closest('td').find('#order_item_id').val();
			var quantity = $(this).val();
			var thisElement = $(this); // inisiasi element untuk ajax
			$.ajax({
				url: "{{ route('kasir.add.item.quantity') }}",
				method: 'POST',
				data:{order_item_id:order_item_id, quantity:quantity},
				success:function(data){
					thisElement.closest('tr').find('.item-total').html('Rp ' + formatRupiah(data.total));
					$('#cart-total').html('Rp. '+ formatRupiah(data.cart_total));
					// elemen '$(this)' tidak bisa dipakai lagi di ajax
				}
			});	
		});

		// hapus item dari cart
		$(document).on('click', '.remove-btn', function(event){
			event.preventDefault();
			if($(this).hasClass('disabled')){
				alert('Tekan kembali untuk mengubah order');
			}else{
				$.ajax({
					url: $(this).attr('href'),
					success:function(data){
						$('#orderItems').html(data.output);
						$('#cart-total').html(data.cart_total);
						$('#total').val(data.total);
					}
				});
			}
		});

		// function untuk buat pesanan baru
		function order(){
			var customer_name = $('#customer_name').val();
			var link = $('#order-btn').attr('href');
			if (link != '#') {
				$.ajax({
					type: 'POST',
					url: link,
					data: {name:customer_name},
					success:function(data){
						$('#order_id').val(data.order_id);
						$('#customer_name').prop('disabled', true);
						$('#order-btn').attr('href', '#');
						$('#cart-footer').html("");
						$('#cart-footer').html(data.output);
					}
				});
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
		function formatRupiah(bilangan){
			var	number_string = bilangan.toString(),
				sisa 	= number_string.length % 3,
				rupiah 	= number_string.substr(0, sisa),
				ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
					
			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
			return rupiah;
		}

		// jalankan function order saat menekan enter di input #customer_name
		$("#customer_name").keypress(function(e) {
		    if(e.which == 13) {
		    	order();
		    }
		});

		// jalankan function order saat menekan tombol pesan
		$(document).on('click', '#order-btn', function(event){
			event.preventDefault();
			order();
		});

		// format rupiah di input tunai
		$(document).on('keyup', '#tunai', function(){
		    $(this).val(formatTunai($(this).val(), 'Rp '));
		});

		// menghitung kembalian
		$(document).on('click', '#bayar', function(event){
			event.preventDefault();
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
					$('#kembalian').html('Rp ' + formatRupiah(kembalian));
					$(this).css('display', 'none');
					$('#tunai').prop('disabled', true);
					$('#remove-order-btn').css('display', 'none');
					$('#kembali').css('display', 'block');
					$('#checkout').css('display', 'block');
					$('.quantity').prop('disabled', true);
					$('.remove-btn').addClass('disabled');
					$('.add-btn').addClass('disabled');
				}else{
					alert('Uang tunai tidak mencukupi');
				}
			}
		});

		// membatalkan dan menghapus order dari database
		$(document).on('click', '#remove-order-btn', function(event){
			event.preventDefault();
			var link = $(this).attr('href');
			var order_link = "{{ route('kasir.order') }}";
			$.ajax({
				url: link,
				success:function(data){
					$('#customer_name').prop('disabled', false);
					$('#customer_name').val('');
					$('#order-btn').attr('href', order_link);
					$('#order_id').val('');
					$('#cart-footer').html("");
					$('#orderItems').html("");
					$('.add-btn').removeClass('disabled');
					$('#cart-footer').html(data.output);
				}
			});
		});

		// batalkan bayar
		$(document).on('click', '#kembali', function(event){
			event.preventDefault();
			$('.add-btn').removeClass('disabled');
			$('#kembalian-container').css('display', 'none');
			$('#kembalian_value').val(0);
			$('#kembalian').html('Rp ' + 0);
			$('#bayar').css('display', 'block');
			$('#tunai').prop('disabled', false);
			$('#remove-order-btn').css('display', 'block');
			$('#kembali').css('display', 'none');
			$('#checkout').css('display', 'none');
			$('.quantity').prop('disabled', false);
			$('.remove-btn').removeClass('disabled');
			$('.add-btn').removeClass('disabled');
		});

		// simpan transaksi ke database
		$(document).on('click', '#checkout', function(event){
			event.preventDefault();
			var order_id = $('#order_id').val();
			var total = $('#total').val();
			var cash = $('#tunai').val();
			cash = Number(cash.replace(/\D/g, ''));
			var change = $('#kembalian_value').val();
			$.ajax({
				url: "{{ route('kasir.transaction.save') }}",
				method: 'POST',
				data: {order_id:order_id, total:total, cash:cash, change:change},
				success:function(data){
					alert(data.message);
					$('#customer_name').prop('disabled', false);
					$('#customer_name').val('');
					$('#order-btn').attr('href', "{{ route('kasir.order') }}");
					$('#order_id').val('');
					$('#cart-footer').html("");
					$('#orderItems').html("");
					$('.add-btn').removeClass('disabled');
					$('#cart-footer').html(data.output);
				},
				error: function(xhr, status, error){
	        var errorMessage = xhr.status + ': ' + error.message
	        alert('Error - ' + errorMessage);
	     	}
			});
		});

		//function pencarian awal
		// $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
		
		// const all = document.getElementById('result');
		// $('#search').keyup(function(){
		// 	var value = $(this).val();
		// 		$.ajax({
		// 			type : 'get',
		// 			url : "{{ route('kasir.search') }}",
		// 			data:{'search':value},
		// 			success:function(data){
		// 				$('#result').html(data);
		// 			}
		// 		});
		// });
	});

</script>
@endsection