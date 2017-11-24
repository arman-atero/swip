<?php get_header(); ?>

<div class="wr-s single-page">
	<div id="cs-content" class="cs-content">
		<div id="x-section-1" class="x-section cs-ta-center" style="margin: 0px;padding: 370px 0px 310px; background-color: transparent;">
		</div>
	</div>
</div>



	<main role="main" class="main-single">
	<!-- section -->
	<section>
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="main-single">
						<div class="container">
							<div class="single-top-content">
										<div class="post-details">
											<?php $categories = get_the_category();
												foreach( $categories as $category ) {
												    echo '<span class="cat-name">' . $category->name .'</span>';
												} ?>
											<h1><?php the_title(); ?></h1>
											<span class="date"><?php the_time('M j, Y'); ?></span>
										</div>
									<div class="post-thumb">
										<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
												<?php the_post_thumbnail(); // Fullsize image for the single post ?>
										<?php endif; ?>
									</div>
							</div>

						<?php the_content(); // Dynamic Content ?>
						<?php //edit_post_link(); // Always handy to have Edit Post Links available ?>
					<?php //comments_template(); ?>
					</div>
				</div>
			</article>
			

	<?php endwhile; ?>

	<?php else: ?>

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
