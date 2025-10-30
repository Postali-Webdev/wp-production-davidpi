<?php get_header(); 
/*
Template Name: Case Results Page Archive
*/ 
?>
	<div class="title animate has_background">		
		<div class="container_inner clearfix">
			<h1>Case Results</h1>
			<span class="pageTitle"><p>Our Results</p></span>
			<span class="dialdavis"><span class="gold">Get Help Now.</span> Dial Davis.</span>
			<a href="tel:313-364-8974" class="ibp" title="Call Davis Personal Injury Lawyers Today" style="color:#000 !important;"><span class="hero-cta">Call (888) Dial Davis</span></a>
		</div>		
	</div>
	<div class="container blog-posts-container">
		<div class="container_inner clearfix">
			<div class="container_inner2 clearfix">
				<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
					<div class="column1">
						<div class="column_inner">
								<div class="blog_holder">
									<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
										<article>
											<div class="post_text_holder">
												<div class="post_text_inner">
													<h2><?php the_title(); ?></h2>
													<span class="create">
														<span class="date">Posted On <?php the_time('F jS, Y'); ?></span>
														<!-- <?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span> -->
													</span>
													<?php the_content(); ?>
													<p><em>The outcome of an individual case depends on a variety of factors unique to that case. Case results do not guarantee or predict a similar result in any similar or future case.</em></p>
												</div>
											</div>	
										</article>
									<?php endwhile; ?>
									<?php else: //If no posts are present ?>
										<div class="entry">                        
												<p><?php _e('No posts were found.', 'qode'); ?></p>    
										</div>
									<?php endif; ?>
									<?php if($qode_options_passage['pagination'] != "0") : ?>
										<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
									<?php endif; ?>
								</div>	
						</div>
					</div>
					<div class="column2">
						<?php get_sidebar(); ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>