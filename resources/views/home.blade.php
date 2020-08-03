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
									<input type="text" placeholder="Search what do yo u need?">
									<button type="submit" class="site-btn">SEARCH</button>
								</form>
							</div>
						</div>
					</div>
					<!-- End Search -->
					<div class="row">
						@foreach($products as $product)
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="{{ asset('img/products/'.$product->image)}}">
									<ul class="product__item__pic__hover">
										@if(Route::has('login'))
											@auth
												<input type="hidden" class="product_id" name="product_id" value="{{ $product->id }}">
												@if($product->favorited() == true)
												<li><a title="Tambah ke Favorit" style="background: #7fad39; border-color: #7fad39; color: white;" class="favorite remove" href="{{ route('member.remove.favorite', $product->getFaveId()) }}"><i class="fa fa-heart"></i></a></li>
												@else
												<li><a title="Tambah ke Favorit" class="favorite" href="{{ route('member.save.favorite', $product->id) }}"><i class="fa fa-heart"></i></a></li>
												@endif
												<li><a href="{{ route('member.add.item') }}"><i class="fa fa-shopping-cart"></i></a></li>
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
				</div>
			</div>
		</div>
	</section><br>
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

		$('.favorite').on('click', function(event){
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
					}
					else{
						thisElement.css('background', '#7fad39');	
						thisElement.css('border-color', '#7fad39');	
						thisElement.css('color', '#ffff');	
						thisElement.addClass('remove');
						newLink = "{{ route('member.remove.favorite', ':id') }}";
						newLink = newLink.replace(':id', data.fave_id);
						thisElement.attr('href', newLink);	
					}
				}
			});
		});

	});
</script>
@endsection
