<?php 
/*
Template Name: Practice Parent
*/ 
?>

<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);  

if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_passage['responsive_title_image'];
}

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_passage['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options_passage['title_image'];
}

if(get_post_meta($id, "qode_title-height", true) != ""){
 $title_height = get_post_meta($id, "qode_title-height", true);
}else{
	$title_height = $qode_options_passage['title_height'];
}

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>
	<?php get_header(); ?>
		<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
			<div class="title animate <?php if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
				<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
				<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
					<?php if($title_in_grid){ ?>

						<div class="container_inner clearfix">
					<?php } ?>
					<h1><?php the_title(); ?></h1>
					<span class="pageTitle"><?php the_excerpt(); ?></span>
					<span class="dialdavis"><span class="gold">Injured? Get Help Now.</span> Dial Davis.</span>
					<a href="tel:313-462-7979" class="ibp" title="Call Davis Personal Injury Lawyers Today" style="color:#000 !important;"><span class="hero-cta sub-page-cta">(888) Dial Davis</span></a>
					<?php if($title_in_grid){ ?>
						</div>

					<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>

		
	<div class="full_width">
		<section class="panel_1">
            <div class="container">
                <div class="columns">
                    <div class="column-full centered center"><p class="intro"><?php the_field('p1_intro_copy'); ?></p></div>
                    <div class="column-50"><?php the_field('p1_body_copy'); ?></div>
                    <div class="column-50">
                        <?php echo do_shortcode('[gravityform id="1" title="true" description="true"]'); ?>
                    </div>
                </div>
            </div>
        </section>

        <?php if( have_rows('content_block') ): ?>
        <?php while( have_rows('content_block') ): the_row(); ?>  

        <?php
        if(get_sub_field('add_background')) {
            $bg_image = get_sub_field('image');
            $bg_position = get_sub_field('background_position');
            $bg_repeat = get_sub_field('background_repeat');
            $bg_size = get_sub_field('background_size');
            $section_style= 'style="background-image:url('.$bg_image.'); background-size: '.$bg_size.'; background-position: '.$bg_position.'; background-repeat: '.$bg_repeat.';"';
        } else {
            $section_style= '';
        } ?>

        <?php 
        if(get_sub_field('number_of_columns') == 'one') {
            if(get_sub_field('column_width') == 'full') {
                $column_class = 'column-full';
            } elseif(get_sub_field('column_width') == '66') {
                $column_class = 'column-66';
            } else {
                $column_class = 'column-50';
            }
        } else {
            $column_class = 'column-50';
        } ?>

        <?php if (get_sub_field('split_background')) { ?> 
        <section style="background-image:url(<?php echo $bg_image; ?>);" class="<?php the_sub_field('background_color'); ?> split-background">
        <?php } else { ?>
        <section <?php echo $section_style; ?> class="<?php the_sub_field('background_color'); ?>">
        <?php } ?>
            <div class="container">
                <div class="columns">
                <?php if( have_rows('content_blocks') ): ?>
                <?php while( have_rows('content_blocks') ): the_row(); ?> 

                    <div class="<?php echo esc_attr($column_class); ?>">
                        <?php the_sub_field('copy_block_one'); ?>
                        <?php if(get_sub_field('add_icon_list')) { ?>
                            <?php if( have_rows('icon_list') ): ?>
                            <?php while( have_rows('icon_list') ): the_row(); ?> 
                            <div class="icon-list">
                                <div class="column-25">
                                    <?php echo do_shortcode(get_sub_field('icon')); ?>
                                </div>
                                <div class="column-75">
                                    <h3><?php the_sub_field('title'); ?></h3>
                                    <?php the_sub_field('copy'); ?>
                                </div>
                            </div> 
                            <div class="spacer-60"></div>
                            <?php endwhile; ?>
                            <?php endif; ?> 
                        <?php } ?>
                    </div>

                    <?php if(get_sub_field('copy_block_two')) { ?>

                    <div class="<?php echo esc_attr($column_class); ?>">
                        <?php the_sub_field('copy_block_two'); ?>
                    </div>
                    <?php } ?>
                <?php endwhile; ?>
                <?php endif; ?> 
                </div>
            </div>
        </section>

        <?php endwhile; ?>
        <?php endif; ?> 

        <section id="maurice">
            <div class="container">
                <div class="columns">
                    <div class="column-66">
                        <?php the_field('pre_footer_content'); ?>
                    </div>
                </div>
            </div>
        </section>

	</div>
	<?php get_footer(); ?>			