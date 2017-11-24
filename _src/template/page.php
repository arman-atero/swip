<?php get_header(); ?>
<!-- wrapper -->
<div class="wr">

<!-- /header -->
	<main role="main">
		<!-- section -->
		<section>

			<h1 class="home-title"><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<div class="section-project">
					<div class="container">
						<ul>
							<?php
               $the_query = new WP_Query(array('category'=>'challenges', 'posts_per_page'=>-1));
               while ( $the_query->have_posts() ) : $the_query->the_post();
							 if ( has_post_thumbnail() ) {?>
               <li class="col33">
                 <a href="<?php the_permalink(); ?>">
                   <div class="slide-content">
                     <?php the_post_thumbnail('thumbnail');?>
										<h3 class="slide-prod-title"><?php the_title(); ?></h3>
										<span class='award'>1500</span>
										<p>
											<span class='euro' >6500</span><span class='days'><i class="sprite icon-watch"></i>4 day</span>
										</p>
                   </div>
                 </a>
               </li>
             <?php } endwhile; wp_reset_query(); ?>
						</ul>
					</div>
				</div>

				<!-- <?php comments_template( '', true ); // Remove if you don't want comments ?> -->

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
