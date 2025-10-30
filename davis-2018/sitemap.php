<?php /*Template Name: Sitemap*/ ?>
<?php get_header(); ?>


			<div class="title animate has_background" style="background-image:url(/wp-content/uploads/2018/10/header-about.jpg); height:px;">
				<div class="container_inner clearfix">
					<h1>Davis Injury Lawyers, PLLC</h1>
						<span class="pageTitle"><p>Sitemap</p></span>
						<span class="dialdavis"><span class="gold">Get Help Now.</span> Dial Davis.</span>
				</div>			
			</div>


<div class="full_width">
	<?php if (have_posts()) : 
			while (have_posts()) : the_post(); ?>
			<div class="column_inner">
				
					<!-- SITEMAP -->
					<div class="textpanel">
					<div class="container_inner" >
	                   <div class="two_columns_50_50 clearfix">
						<div class="column1">
							<div class="column_inner">
	                            <h2>Pages</h2> 
								<ul><?php 
									$templates = array(
										'page-ppc-landing.php', //replace these with the correct template names
										'page-ppc-landing-pmax.php'
									);

									$ppc_ids = array();
									foreach ( $templates as $template ) {
										$args = [
											'post_type'  => 'page',
											'fields'     => 'ids',
											'nopaging'   => true,
											'meta_key'   => '_wp_page_template',
											'meta_value' => $template
										];

										$ppc_pages = get_posts( $args );
										$ppc_ids = array_merge($ppc_ids, $ppc_pages);
									}
									$ppc_list = implode(', ', $ppc_ids);
									$page_args = array(
										'exclude' => $ppc_list,
										'title_li' => null
									);
									wp_list_pages($page_args); 
								?></ul> 
	                        </div>
	                    </div>
						<div class="column2">
							<div class="column_inner">        
		                        <h2>Blog Posts</h2> 
		                            <ul>
		                            	<?php wp_get_archives('type=postbypost'); ?>
		                            </ul>
	                        </div>
	                    </div>
	                </div>
				</div>
				</div>
			</div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php get_footer(); ?>			