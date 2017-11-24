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
		<div id="x-section-1" class="x-section cs-ta-center" style="margin: 0px;padding: 370px 0px 310px; background-color: transparent;">
			<div class="x-container max width" style="margin: 0px auto;padding: 0px;">
				<div class="x-column x-sm x-1-1" style="padding: 0px;">
					<h1 class="h-custom-headline cs-ta-center" style="color: hsl(0, 0%, 100%);font-size:50px;margin-top:20px;margin-bottom:0px;">
						<span>The Crowd Can Innovate Better!</span>
					</h1>
					<a class="x-btn signup-join x-btn-global" style="width: 270px;" href="#" data-options="thumbnail: ''">JOIN SWIP WORLD</a>
				</div>
			</div>
		</div>
	</div>
</div>
<main role="main">
	<section class="section-project">
		<div class="container">
			<ul class="slider">
				<?php
         $the_query = new WP_Query(array('category'=>'challenges', 'posts_per_page'=>-1));
         while ( $the_query->have_posts() ) : $the_query->the_post();
				 if ( has_post_thumbnail() ) {?>
         <li class="col33">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
           <a href="<?php the_permalink(); ?>">
             <div class="slide-content">
               <?php the_post_thumbnail('362x262');?>
							<p class="slide-prod-excerpt"><?php the_excerpt(); ?></p>
							<span class='award'>$ 1500</span>
							<p>
								<span class='euro' >(&euro; 6500)</span><span class='days'><i class="sprite icon-watch"></i>4 days</span>
							</p>
             </div>
           </a>
				 </article>
         </li>
       <?php } endwhile; wp_reset_query(); ?>
			</ul>
		</div>
		<div class="clearfix"></div>
	</section>
	<?php the_content(); ?>
	<section>
		<div class="section-winners">
				<div class="container">
					<h2>Recent Winners</h2>
						<ul class="winners-block">
							<?php
			         $the_query = new WP_Query(array('post_type' => 'winners', 'posts_per_page'=>4));
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
						<button type="button" name="button">I WANT TO WIN TOO</button>
					</div>
			</div>
		</div>
			<div class="section-stories">
				<div class="container">
					<h2>Success Stories</h2>
					<p class="sub-title">
						We have nurtured a number of successful, innovative ideas over the </br> years. Have a look.
					</p>
					<ul>
						<?php
		         $the_query = new WP_Query(array('category'=>'challenges', 'posts_per_page'=>3));
		         while ( $the_query->have_posts() ) : $the_query->the_post();
						 if ( has_post_thumbnail() ) {?>
							<li class="col33">
								<div class="full-bg">
									<div class="story-slide-content">
										<h5><?php the_title(); ?></h5>
										<p><?php the_excerpt(); ?></p>
									</div>
								</div>
							</li>
						 <?php } endwhile; wp_reset_query(); ?>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
				<div class="explore-button">
					<button type="button" name="button">EXPLORE MORE</button>
				</div>
			</div>


				<!-- <div class="section-challenge-solution">
					<div class="challenge-solved">
						<div class="text-content">
							<h2>Get your Challenge Solved</h2>
						</div>
						<p>
							It has been proven that crowdsourcing can solve almost any problem and gets jobs done faster and cheaper
						</p>
					</div>
					<div class="mone-reputation">
						<div class="text-content">
							<h2>Earn Money & Reputation</h2>
						</div>
						<p>
							Show off your skills by submitting your contributions to challenges and earn awards or find freelance jobs.
						</p>
					</div>
					<div class="">
						<div class="solution-left-block">
							<ul>
								<li class="describe">
									<h3>Describe your Challenge</h3>
									<p>
										Let the community know about your project, what solution you need and what you expect to be delivered
									</p>
								</li>
								<li class="award">
									<h3>Set an Award</h3>
									<p>
										The more the solution is worth to you the more solutions you will receive to choose the best from
									</p>
								</li>
								<li class="promote">
									<h3>Promote your Challenge</h3>
									<p>
										Use our access to almost a billion profiles from which you may choose who to invite to your challenge
									</p>
								</li>
								<div class="submit-button">
									<button type="button" name="button">GET YOUR SOLUTION</button>
								</div>
							</ul>
						</div>
						<div class="signup-right-block">
							<ul>
								<li class="signupfree">
									<h3>Sign Up for Free!</h3>
									<p>
										nter your profile, connect with people, find challenges and interesting projects or be found by opportunities that match
									</p>
								</li>
								<li class="solve-ch">
									<h3>Solve Challenges</h3>
									<p>
										Submit your ideas, concepts and solutions. Prove your skills and creativity. Collaborate with others and
									</p>
								</li>
								<li class="win-awards">
									<h3>Win Awards or Jobs</h3>
									<p>
										Win attractive cash prizes and recognition for your solution contributions or freelance jobs
									</p>
								</li>
								<div class="submit-button">
									<button type="button" name="button">SIGN UP FOR FREE</button>
								</div>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
				</div> -->
				<!-- <div class="section-innovation">
						<div class="container">
							<h2>Why Open Innovation?</h2>
							<p class="sub-title">
								Studies prove that Open Innovation with inclusion of customers has </br> very positive effects:
							</p>
								<div class="padding-block">
									<div class="rate col33">
										<i class="icon icon-success"></i>
										<h3>Success Rate</h3>
										<p>
											is higher for new product development
										</p>
									</div>
									<div class="market col33">
										<i class="icon icon-hourglass"></i>
										<h3>Time to Market</h3>
										<p>
											is faster and at lower cost
										</p>
									</div>
									<div class="involve col33">
										<i class="icon icon-group"></i>
										<h3>Involve Customers</h3>
										<p>
											to deliver ideas and understand their needs
										</p>
									</div>
									<div class="mistakes col33">
										<i class="icon icon-inside-circle"></i>
										<h3>Less Mistakes</h3>
										<p>
											in the initial phase
										</p>
									</div>
									<div class="quality col33">
										<i class="icon icon-like1"></i>
										<h3>Higher Quality</h3>
										<p>
											of products and services
										</p>
									</div>
									<div class="retention col33">
										<i class="icon icon-in-love"></i>
										<h3>Customer Retention</h3>
										<p>
											is stronger
										</p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="madia-profiles">
									<h4>With our access to 500+ Million social media profiles, we can target very specifically the right people for your challenge in any field of expertise or any customer segment.</h4>
									<div class="col50 innovatin-left-block">
										<p>
											As a company you’d traditionally assume or at least hope that the best people in the field work for you and you try hard to keep them. When you go for an open innovation apporoach to R&D, you realize that not really all the smart people work for you. So you would like to identify, connect, and leverage the knowledge of the many more smart people outside your organization.
										</p>
									</div>
									<div class="col50 innovatin-right-block">
										<p>
											If done right you can get valuable customer feedback at the same time. More and more companies have come to appreciate the positive effects when they let their customers know that they are developing the next product or service for them together with them.
										</p>
									</div>
									<div class="clearfix"></div>
									<div class="solution-button">
										<button type="button" name="button">GET YOUR SOLUTION NOW</button>
									</div>
								</div>
						</div>
					<div class="clearfix"></div>
				</div> -->
				<!-- <div class="section-winners">
						<div class="container">
							<h2>Recent Winners</h2>
							<ul class="winners-block">
								<li class="win1 col25">
									<img src="<?php bloginfo('template_directory') ?>/img/stav.png" alt="stav.png" />
									<h3>Sav Zilbershtein</h3>
									<p class="about-winner">
										His concet was awarded with
									</p>
									<p class="win-price">USD <span>3,070</span></p>
								</li>
								<li class="win2 col25">
									<img src="<?php bloginfo('template_directory') ?>/img/darko.png" alt="darko.png" />
									<h3>Steven Bannon</h3>
									<p class="about-winner">
										His concet was awarded with
									</p>
									<p class="win-price">USD <span>3,070</span></p>
								</li>
								<li class="win3 col25">
									<img src="<?php bloginfo('template_directory') ?>/img/steve.png" alt="steve.png" />
									<h3>Darko Perhoc</h3>
									<p class="about-winner">
										His concet was awarded with
									</p>
									<p class="win-price">USD <span>3,070</span></p>
								</li>
								<li class="win4 col25">
									<img src="<?php bloginfo('template_directory') ?>/img/marcus.png" alt="marcus.png" />
									<h3>Marcus Roth</h3>
									<p class="about-winner">
										His concet was awarded with
									</p>
									<p class="win-price">USD <span>1,024</span></p>
								</li>
								<div class="clearfix"></div>
							</ul>
						<div class="clearfix"></div>
						<div class="solution-button">
							<button type="button" name="button">I WANT TO WIN TOO</button>
						</div>
					</div>
				</div> -->
				<!-- <div class="section-stories">
					<div class="container">
						<h2>Success Stories</h2>
						<p class="sub-title">
							We have nurtured a number of successful, innovative ideas over the </br> years. Have a look.
						</p>
						<ul>
							<li class="col33">
								<div class="full-bg">
									<div class="story-slide-content">
										<h5>Adjustable Intermediate Floor</h5>
										<p>
											The client considered the problem to be not solvable due to his experience. The open innovation challenge in turn resulted in:
										</p>
										<p class="story-price">USD <span>6,100</span></p>
									</div>
								</div>
							</li>
							<li class="col33">
								<div class="full-bg">
									<div class="story-slide-content">
										<h5>Having Fun & Redeeming Points</h5>
										<p>
											Viseca Card Services SA received great concepts, which were awarded with a total of:
										</p>
										<p class="story-price">USD <span>6,100</span></p>
									</div>
								</div>
							</li>
							<li class="col33">
								<div class="full-bg">
									<div class="story-slide-content">
										<h5>Adjustable Intermediate Floor</h5>
										<p>
											The client considered the problem to be not solvable due to his experience. The open innovation challenge in turn resulted in:
										</p>
										<p class="story-price">USD <span>6,100</span></p>
									</div>
								</div>
							</li>
							<div class="clearfix"></div>
						</ul>
					</div>
					<div class="clearfix"></div>
					<div class="explore-button">
						<button type="button" name="button">EXPLORE MORE</button>
					</div>
				</div> -->
				<br class="clear">
			</article>
			<!-- /article -->

	</section>
		<!-- /section -->
</main>
<script type="text/javascript">
	jQuery(document).ready(function(){
		// jQuery('ul.slider').slick({
		// 	// prevArrow: jQuery('a.sl-prv-arrow'),
		// 	// nextArrow: jQuery('a.sl-next-arrow'),
		// 	// dots: false
		// });
	});
</script>

<?php get_footer(); ?>
