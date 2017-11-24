<?php get_header(); ?>

<div class="wr-blog blog-page">
	<div id="cs-content" class="cs-content">
		<div id="x-section-1" class="x-section cs-ta-center" style="margin: 0px;padding: 150px 0px 380px; background-color: transparent;">
			<div class="x-container max width" style="margin: 0px auto;padding: 0px;">
				<div class="x-column x-sm x-1-1" style="padding: 0px;">
					<h1 class="h-custom-headline cs-ta-center" style="color: hsl(0, 0%, 100%);font-size:50px;margin-top:20px;margin-bottom:0px;">
						<span><?php pll_e('Blog'); ?></span>
					</h1>
					<p>
						<?php pll_e('Find pointers on how to make your project the next big thing'); ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>


	<main role="main">
		<!-- section -->
		<section>
			<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="main-blog">
						<div class="container">
							<div class="col70 blog-content">
							<?php query_posts( array( 'posts_per_page' => 3, 'paged' => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
							    ) );
									if ( have_posts() ) :
											while (have_posts()) : the_post();
												setup_postdata( $post ); ?>
												<div class="relative-block">
														<?php the_post_thumbnail('890x420'); // Fullsize image for the single post ?>
													<div class="post-details">
														<?php $categories = get_the_category();
															foreach( $categories as $category ) {
															    echo '<span class="cat-name">' . $category->name .'</span>';
															} ?>
														<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
														<div class="blog-excerpt"><?php the_excerpt(); ?></div>
														<div class="clearfix"></div>
														<span class="date"><?php the_time('M j, Y'); ?></span>
													</div>
											</div>
										<?php
									endwhile;endif;
										wp_reset_postdata(); ?>
                    <div class="navigation">
                      <?php echo paginate_links( array(
                                'prev_text' => '',
                                'next_text' => '')); ?>
                    </div>
								</div>
								<div class="col30">
									<div class="sidebar-block">
										<h2><?php pll_e('Categories'); ?></h2>
										<?php $catlist = get_terms( 'category', array('hide_empty' => 0, 'orderby' => 'ASC') );?>
									      <ul class="sidebar-categories">
										      <?php foreach($catlist as $categories_item){
					                echo '<li class=""><a href="' . esc_url( get_term_link( $categories_item, $categories_item->taxonomy ) ) . '"><span class="category-name">'.$categories_item->name.'</span></a></li>';
						              } ?>
												</ul>
											<div class="popular-block">
												<h2><?php pll_e('Popular'); ?></h2>
												<?php $original_query = $wp_query;
													$brand_name = 'popular';
													$wp_query = null;
													$args=array('posts_per_page'=>5, 'tag' => $brand_name);
													$wp_query = new WP_Query( $args );
													if ( have_posts() ) :
													    while (have_posts()) : the_post();
													        echo '<li class="sidebar-rel-block">';?>
																			<?php the_post_thumbnail('360x255'); // Fullsize image for the single post ?>
																		<div class="post-details">
																			<?php $categories = get_the_category();
																				foreach( $categories as $category ) {
																				    echo '<span class="cat-name">' . $category->name .'</span>';
																				} ?>
																			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
																			<div class="clearfix"></div>
																			<span class="date"><?php the_time('M j, Y'); ?></span>
																		</div>
													    <?php  echo '</li>';?>
													  <?php  endwhile;
													endif;
													$wp_query = null;
													$wp_query = $original_query;
													wp_reset_postdata(); ?>
											</div>
									</div>
								</div>
								<div class="clearfix"></div>
							<?php //the_content(); // Dynamic Content ?>
					</div>
				</div>
			</article>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>