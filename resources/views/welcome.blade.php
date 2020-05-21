@extends('layouts.app')

@section('content')

<header class="header">
		<div class="header__top">
			<div class="container">
				
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="header__logo">
                        <!-- <a href="./index.html"><img src="img/logo2.png" alt=""></a> -->
                        <h2 style="font-weight: bold; padding:5px;">DALGONA</h2>
					</div>
				</div>
				<div class="col-lg-6">
					<nav class="header__menu">
						<ul>
							<li class="active"><a href="./shop-grid.html">Home</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="">Special Offer</a></li>
						</ul>
					</nav>
				</div>
				<div class="col-lg-3">
					<div class="header__cart">
					 <div class="header__top__right__auth">
              <a href="{{ route('login') }}"><i class="fa fa-user"></i>Sign In</a>
           </div>
           <div class="header__top__right__auth">
              <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register </a>
           </div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Product Section Begin -->
	<section class="product spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-5">
					<div class="sidebar">
						<div class="sidebar__item">
							<h4>Department</h4>
							<ul>
								<li><a href="#">Hot Drink</a></li>
								<li><a href="#">Hot Coffees</a></li>
								<li><a href="#">Hot Teas</a></li>
								<li><a href="#">Frappuccino Blended Beverages</a></li>
								<li><a href="#">Ocean Foods</a></li>
								<li><a href="#">Butter & Eggs</a></li>
								<li><a href="#">Fastfood</a></li>
								<li><a href="#">Fresh Onion</a></li>
								<li><a href="#">Papayaya & Crisps</a></li>
								<li><a href="#">Oatmeal</a></li>
							</ul>
						</div>
						
					</div>
				</div>
				<div class="col-lg-9 col-md-7">
					

						<div class="col-lg-9">
							<!-- Search -->

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
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/breakfast/paleo-irish-breakfast.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/hotcoffee/Kickedup_drink.jpg ">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/breakfast/Meal-Prep-Egg-and-Sausage-McMuffin.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-5.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-6.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-8.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-9.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-10.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-11.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="img/product/product-12.jpg">
									<ul class="product__item__pic__hover">
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-retweet"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
									</ul>
								</div>
								<div class="product__item__text">
									<h6><a href="#">Crab Pool Security</a></h6>
									<h5>$30.00</h5>
								</div>
							</div>
						</div>
					</div>
					<div class="product__pagination">
						<a href="#">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#"><i class="fa fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section><br>

@endsection
