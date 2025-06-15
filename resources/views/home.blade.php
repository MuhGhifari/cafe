@extends('layouts.app')

@section('stylesheets')
<style type="text/css">
.product__item__pic__hover li:hover a {
	background: white;
	border-color: white;
}

.product__item__pic__hover li:hover a i {
	color: #7fad39;
	transform: rotate(0);
}

.product__item__pic__hover li:hover a.remove i {
	color: black;
	transform: rotate(0deg);
}
</style>
@endsection

@section('content')
	<!-- Product Section Begin -->
	<section class="product spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-5">
					<div class="sidebar">
						<div class="sidebar__item">
							<h4>Kategori</h4>
							<ul>
								<li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Semua Produk</a></li>
								@foreach($categories as $category)
								<li class="{{ Request::is('products/categories/'.$category->id.'/'.str_replace(' ', '-', strtolower($category->name))) ? 'active' : '' }}"><a href="{{ route('products.category', ['id' => $category->id, 'slug' => str_replace(' ', '-', strtolower($category->name))]) }}">{{ $category->name }}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-7">
					<!-- Search -->
					<div class="col-lg-9">
						<div class="hero__search">
							<div class="hero__search__form">
								<form action="#">
									<input style="width: 100%" type="text" id="search" name="search" placeholder="Cari produk..." onkeypress="return event.keyCode != 13;"><!-- keycode 13 = enter key -->
										<button class="site-btn" disabled>PENCARIAN</button>
								</form>
							</div>
						</div>
					</div>
					<!-- End Search -->
					<div id="product-container">
					@auth
					@if(count(auth()->user()->waitingOrder) > 0)
					<input type="hidden" name="order_id" id="order_id" value="{{ auth()->user()->waitingOrder->first()->id }}">
					@else
					<input type="hidden" name="order_id" id="order_id">
					@endif
					@endauth
					@include('partials.product_data')
					<input type="hidden" name="hidden_page" id="hidden_page" value="1">
					</div>
				</div>
			</div>
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

		//ambil & tampilkan data
		function fetch_data(page, query){
			$.ajax({
				url:"/search?query="+query+"&page="+page,
				success:function(data){
					$('#product-container').html('');
					$('#product-container').html(data);

					// initialize tooltip
					$("[data-toggle='tooltip']").tooltip({
			      trigger : 'hover'
			    });
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

		//	menambah atau menghapus item favorit
		$(document).on('click', '.favorite', function(event){
			event.preventDefault();
			var thisElement = $(this);
			var product_id = thisElement.closest('ul').find('.product_id').val();
			var link = $(this).attr('href');
			$.ajax({
				url: link,
				success:function(data){
					if (thisElement.hasClass('remove')) {
						thisElement.css('background', '#ffff');	
						thisElement.css('border-color', '#ffff');	
						thisElement.css('color', '#1c1c1c');
						thisElement.removeClass('remove');
						newLink = "{{ route('member.save.favorite', ':id') }}";
						newLink = newLink.replace(':id', product_id);
						thisElement.attr('href', newLink);
						var newTitle = 'Tambah ke favorit';
						thisElement.attr('title', newTitle).attr('data-original-title', newTitle).tooltip('update').tooltip('show');;
					}
					else{
						thisElement.css('background', '#7fad39');	
						thisElement.css('border-color', '#7fad39');	
						thisElement.css('color', '#ffff');	
						thisElement.addClass('remove');
						newLink = "{{ route('member.remove.favorite', ':id') }}";
						newLink = newLink.replace(':id', data.fave_id);
						thisElement.attr('href', newLink);
						var newTitle = 'Hapus dari favorit';
						thisElement.attr('title', newTitle).attr('data-original-title', newTitle).tooltip('update').tooltip('show');;
					}
				}
			});
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
