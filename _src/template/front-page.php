<?php
/*
Template Name: Front Page
*/

get_header();
// the_content();
?>

<!-- wrapper -->
<div class="wr wr1 front-page">
	<div id="cs-content" class="cs-content">
		<div id="x-section-1" class="x-section cs-ta-center" style="margin: 0px;padding: 380px 0px 380px; background-color: transparent;">
			<div class="x-container max width" style="margin: 0px auto;padding: 0px;">
				<div class="x-column x-sm x-1-1" style="padding: 0px;">
					<h1 class="h-custom-headline cs-ta-center" style="color: hsl(0, 0%, 100%);font-size:50px;margin-top:20px;margin-bottom:0px;">
						<span><?php pll_e('The Crowd Can Innovate Better!'); ?></span>
					</h1>
					<a class="x-btn signup-join x-btn-global" style="width: 270px;" href="#" data-options="thumbnail: ''"><?php pll_e('JOIN SWIP and WORLD'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<main role="main" class="main">
	<section class="section-project">
		<div class="container sl-wrapper">
			<a  class="sl-prv-arrow"></a>
			<a  class="sl-next-arrow"></a>
			<ul class="slider">
				<?php
         $the_query = new WP_Query(array('category'=>'challenges', 'posts_per_page'=>-1));
         while ( $the_query->have_posts() ) : $the_query->the_post();
				 if ( has_post_thumbnail() ) {?>
         <li class="col33">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
           <a href="<?php echo get_post_meta(get_the_ID(), 'Link', true); ?>">
             <div class="slide-content">
               <?php the_post_thumbnail('362x262');?>
							<p class="slide-prod-excerpt"><?php the_excerpt(); ?></p>
							<span class='award'>$ 1500</span>
							<p>
								<span class='euro' >(&euro; 6500)</span><span class='days'><i class="sprite icon-watch"></i><i class="num-days">4 days</i></span>
							</p>
             </div>
           </a>
				 </article>
         </li>
       <?php } endwhile; wp_reset_query(); ?>
			</ul>
        <div class="project-button">
          <button type="button" name="button"><?php pll_e('BROWSE ALL PROJECTS'); ?></button>
      </div>
		</div>
		<div class="clearfix"></div>
	</section>
	<?php the_content(); ?>
	<section>
		<div class="section-winners">
      <div class="win-top-bg"></div>
				<div class="container sl-wrapper">
					<h2><?php pll_e('Recent Winners'); ?></h2>
					<a  class="sl-prv-arrow1"></a>
					<a  class="sl-next-arrow1"></a>
						<ul class="slide-win winners-block">
							<?php
			         $the_query = new WP_Query(array('post_type' => 'winners', 'posts_per_page'=>-1));
			         while ( $the_query->have_posts() ) : $the_query->the_post();
							 if ( has_post_thumbnail() ) {?>
			         <li class="win1 col25">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			           <a href="<?php the_permalink(); ?>">
			             <div class="slide-content">
			               <?php the_post_thumbnail('full');?>
										 <h3><?php the_title(); ?></h3>
										<div class="about-winner"><?php the_content(); ?></div>
										<span class='win-price'><?php echo get_post_meta(get_the_ID(), 'Amount', true); ?></span>
			             </div>
			           </a>
							 </article>
			         </li>
			       <?php } endwhile; wp_reset_query(); ?>
						</ul>
					<div class="clearfix"></div>
						<div class="solution-button">
						<button type="button" name="button"><?php pll_e('I WANT TO WIN TOO'); ?></button>
					</div>
			</div>
		</div>
			<div class="section-stories">
				<div class="container sl-wrapper">
					<h2><?php pll_e('Success Stories'); ?></h2>
					<p class="sub-title">We have nurtured a number of successful, innovative ideas over the years. Have a look.
						<?php pll_e('We have nurtured a number'); ?>
					</p>
					<ul class="slide-story">
						<?php
		         $the_query = new WP_Query(array('category'=>'challenges', 'posts_per_page'=>-1));
		         while ( $the_query->have_posts() ) : $the_query->the_post();
						 if ( has_post_thumbnail() ) {?>
							<li class="col50">
								<a href="<?php the_permalink(); ?>">
									<div class="full-bg">
										<?php the_post_thumbnail('640x440');?>
									<div class="story-slide-content">
										<h5><?php the_title(); ?></h5>
										<p><?php the_excerpt(); ?></p>
									</div>
								</div>
							</a>
							</li>
						 <?php } endwhile; wp_reset_query(); ?>
					</ul>
				</div>
				<div class="clearfix"></div>
				<div class="explore-button">
					<button type="button" name="button"><?php pll_e('EXPLORE MORE') ?></button>
				</div>
			</div>
			<div class="section-swip">
				<div class="container">
					<h2><?php pll_e('Who is Swip?'); ?></h2>
					<p class="sub-title">
						<?php pll_e('swip.world belongs to the privately') ?>

					</p>
					<ul class="members-block">
						<?php
						 $the_query = new WP_Query(array('post_type' => 'members', 'posts_per_page'=>8));
						 while ( $the_query->have_posts() ) : $the_query->the_post();
						 if ( has_post_thumbnail() ) {?>
						
							<li class="member col25">
							 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="swip-content">
										<?php the_post_thumbnail('248x238');?>
										<h3><?php the_title(); ?></h3>
									 <div class="about-winner"><?php the_content(); ?></div>
									 <div class="socials-icons">
										 <a class='swip-social icon icon-twitter' href="<?php echo get_post_meta(get_the_ID(), 'Twitter', true); ?>"></a>
  									 <a class='swip-social icon icon-in' href="<?php echo get_post_meta(get_the_ID(), 'Linkedin', true); ?>"></a>
									 </div>
									</div>
							</article>
							<div class="clearfix"></div>
							</li>
						
					 <?php } endwhile; wp_reset_query(); ?>
			
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="section-values">
				<div class="container">
					<?php
					$currentLanguage  = pll_current_language('slug');
					$pageslug = '';
					if($currentLanguage == 'en') {
						$pageslug = 'our-values';
					}else{
						$pageslug = 'onze-waarden';
					} ?>
					<?php $query = new WP_Query( array( 'pagename' => $pageslug ) );
		        while ( $query->have_posts() ) {
		        $query->the_post();
		        echo '<h2>'. get_the_title() .'</h2>';?>
						<p class="sub-title">
							<?php pll_e('Lets`s all buils on a fundament of shared values.'); ?>
						</p>
			      <?php  the_content();
							    }
							    wp_reset_postdata();
							?>
				</div>
				<div class="swip-button">
					<button type="button" name="button"><?php pll_e('MORE ABOUT SWIP') ?> &rarr;</button>
				</div>
			</div>
			<div class="section-partners">
				<div class="container">
					<h2><?php pll_e('OUR PARTNERS'); ?>:</h2>
					<ul class="partners-block">
						<?php
						 $the_query = new WP_Query(array('post_type' => 'partners', 'posts_per_page'=>8));
						 while ( $the_query->have_posts() ) : $the_query->the_post();
						 if ( has_post_thumbnail() ) {?>
							<li class="partner col25">
							 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="partners-content">
									 <div class="socials-icons">
										 <a class='partner-social' href="<?php echo get_post_meta(get_the_ID(), 'Partner', true); ?>">
											 <?php the_post_thumbnail('full');?>
										 </a>
									 </div>
									</div>
							</article>
							<div class="clearfix"></div>
							</li>
					 <?php } endwhile; wp_reset_query(); ?>
					 <div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</section>
		<!-- /section -->
</main>
<script type="text/javascript">
	jQuery(document).ready(function(){
		if ($(window).width()<= 768) {
			jQuery('ul.slider').slick({
				prevArrow: jQuery('a.sl-next-arrow'),
				nextArrow: jQuery('a.sl-prv-arrow'),
				infinite: true,
				slidesToShow: 2,
				slidesToScroll: 1,
				dots: false
			});
		}else{
			jQuery('ul.slider').slick({
				prevArrow: jQuery('a.sl-next-arrow'),
				nextArrow: jQuery('a.sl-prv-arrow'),
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				dots: false
			});
		}
		if ($(window).width()<= 768) {
			jQuery('ul.slide-win').slick({
        prevArrow: jQuery('a.sl-next-arrow1'),
				nextArrow: jQuery('a.sl-prv-arrow1'),	
				infinite: true,
				slidesToShow: 2,
				slidesToScroll: 4,
				dots: false
			});
		}else{
			jQuery('ul.slide-win').slick({
        prevArrow: jQuery('a.sl-next-arrow1'),
				nextArrow: jQuery('a.sl-prv-arrow1'),				
				infinite: true,
				slidesToShow: 4,
				slidesToScroll: 4,
				dots: false
			});
		}
		if ($(window).width()<= 768) {
			jQuery('ul.slide-story').slick({
				prevArrow: jQuery('a.sl-prv-arrow-st'),
				nextArrow: jQuery('a.sl-next-arrow-st'),
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: false,
				autoplay: true,
			});
		}else{
			jQuery('ul.slide-story').slick({
				prevArrow: jQuery('a.sl-prv-arrow-st'),
				nextArrow: jQuery('a.sl-next-arrow-st'),
				infinite: true,
				slidesToShow: 2,
				slidesToScroll: 1,
				dots: false,
				autoplay: true,
			});
		}
    if ($(window).width()<= 360) {
			jQuery('ul.slider').slick({
				prevArrow: jQuery('a.sl-next-arrow'),
				nextArrow: jQuery('a.sl-prv-arrow'),
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: false
			});
		}
		$('.shown-block .menu-btn').click(function(){
			$('header .hide-block').toggleClass('shown-menu');
			$('.front-page, .main, .header').toggleClass('body-transform');
		})

	});
</script>

<?php get_footer(); ?>


