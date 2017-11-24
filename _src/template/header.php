<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<?php wp_head(); ?>



	</head>
	<body <?php body_class(); ?>>
		<div class="wr nav-section">
			<header class="header clear block" role="banner">
					<!-- logo -->
					<div class="logo pull-left">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php bloginfo('template_directory'); ?>/img/Logo_transparent_white.png" alt="" />
						</a>
					</div>
					<!-- /logo -->

						<div class="mobile-header">
						<nav class="nav pull-right" role="navigation" style="position:relative;">
							<div class="search-form">
								<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
									<input class="search-input" type="search" name="s" placeholder="<?php _e( 'To search, type and hit enter.', 'html5blank' ); ?>">
									<input class="search-submit" type="submit" name="name" value="">
								</form>
							</div>
							<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
								<i class="icon-shop icon"></i>
								<?php echo sprintf ( _n( '%d item', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
							</a>
						</nav>

						<nav class="nav pull-left header-left-menu" role="navigation">
							<?php wp_nav_menu(array('menu'=>'Top menu EN')); ?>
						</nav>

						<nav class="nav pull-right" role="navigation" style="position:relative;">
							<?php
							$currentLanguage  = pll_current_language('slug');
							if($currentLanguage == 'en') { ?>
								<?php wp_nav_menu(array('menu'=>'Top Right EN')); ?>
								<ul>
									<li><a class="signup1" data-toggle="modal" data-target="#modal-signup" href="#">SIGN UP</a></li>
									<li><a class="login" data-toggle="modal" data-target="#modal-login"  href="#">LOGIN</a></li>
								</ul>
							<?php }else{ ?>
								<?php wp_nav_menu(array('menu'=>'Top Right DE')); ?>
								<ul>
									<li><a class="signup2" data-toggle="modal" data-target="#modal-signup" href="#">REGISTRIEREN</a></li>
									<li><a class="login2" data-toggle="modal" data-target="#modal-login"  href="#">ANMELDEN</a></li>
								</ul>
						<?php	} ?>

							<div class="search-form">
								<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
									<input class="search-input" type="search" name="s" placeholder="<?php _e( 'To search, type and hit enter.', 'html5blank' ); ?>">
									<input class="search-submit" type="submit" name="name" value="">
								</form>
							</div>
							<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
								<i class="icon-shop sprite"></i>
								<?php echo sprintf ( _n( '%d item', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
							</a>
						</nav>
					</div>
						<div class="shown-block" style="display:none;">
							<img class="menu-btn" src="<?php bloginfo('template_directory'); ?>/img/menu.png" alt="" />
							<a href="<?php echo home_url(); ?>">
								<img class="mobile-logo" src="<?php bloginfo('template_directory'); ?>/img/Logo_horizontal_transparent_white.png" alt="" />
							</a>
								<div class="shop-cart">
									<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
										<i class="icon-shop sprite"></i>
										<p>
											<?php echo sprintf ( _n( '%d item', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
										</p>
									</a>
								</div>
						</div>

					<nav class="nav pull-left header-left-menu" role="navigation">
						<!-- <?php wp_nav_menu(array('menu'=>'Top menu DE')); ?> -->
					</nav>

					<div class="hide-block">
						<p>swip.<span>world</span></p>
						<nav class="nav pull-right" role="navigation" style="position:relative;">
							<div class="search-form">
								<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
									<input class="search-input" type="search" name="s" placeholder="<?php _e( 'To search, type and hit enter.', 'html5blank' ); ?>">
									<input class="search-submit" type="submit" name="name" value="">
								</form>
							</div>
							<!-- <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
								<i class="icon-shop icon"></i>
								<?php echo sprintf ( _n( '%d item', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
							</a> -->
						</nav>
						<nav class="nav pull-right" role="navigation" style="position:relative;">
							<?php
							$currentLanguage  = pll_current_language('slug');
							if($currentLanguage == 'en') { ?>
								<ul>
									<li><a class="signup1" data-toggle="modal" data-target="#modal-signup" href="#">SIGN UP</a></li>
									<li><a class="login" data-toggle="modal" data-target="#modal-login"  href="#">LOGIN</a></li>
								</ul>
							<?php }else{ ?>
								<ul>
									<li><a class="signup2" data-toggle="modal" data-target="#modal-signup" href="#">REGISTRIEREN</a></li>
									<li><a class="login2" data-toggle="modal" data-target="#modal-login"  href="#">ANMELDEN</a></li>
								</ul>
						<?php	} ?>
						</nav>
						<nav class="nav pull-left header-left-menu" role="navigation">
							<?php wp_nav_menu(array('menu'=>'Top menu EN')); ?>
						</nav>
						<div class="languages">
							<?php
							$currentLanguage  = pll_current_language('slug');
							if($currentLanguage == 'en') { ?>
								<?php wp_nav_menu(array('menu'=>'Top Right EN')); ?>
							<?php }else{ ?>
								<?php wp_nav_menu(array('menu'=>'Top Right DE')); ?>
						<?php	} ?>
						</div>

				</header>
		</div>


		<div id="modal-login" class="modal fade" role="dialog">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="blur-svg">
		    <defs>
		        <filter id="blur-filter">
		            <feGaussianBlur stdDeviation="3"></feGaussianBlur>
		        </filter>
		    </defs>
		</svg>
	  	<div class="modal-dialog">
	    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-body">
						<iframe src="https://www.swip.world/external_forms" width="" height=""></iframe>
		      </div>
		      <!-- <div class="modal-footer">
		        <button style="width:60px; display:inline-block;" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div> -->
		    </div>
	  </div>
	</div>


	<div id="modal-signup" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<iframe name='frameSingup' src="https://www.swip.world/external_forms#registration" width="" height=""></iframe>
				</div>
				<!-- <div class="modal-footer">
					<button style="width:60px; display:inline-block;" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div> -->
			</div>
	</div>
</div>


