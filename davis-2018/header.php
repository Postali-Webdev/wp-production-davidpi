<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $qode_options_passage;
global $wp_query;
$disable_qode_seo = "";
$seo_title = "";
if (isset($qode_options_passage['disable_qode_seo'])) $disable_qode_seo = $qode_options_passage['disable_qode_seo'];
if ($disable_qode_seo != "yes") {
	$seo_title = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_title", true);
	$seo_description = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_description", true);
	$seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_keywords", true);
}
?>

<?php if (is_page('5')) { ?>
    <link rel="preload" as="image" href="/wp-content/uploads/2024/02/hp-cityscape-header-img-background.jpg" />
    <link rel="preload" as="image" href="/wp-content/uploads/2024/02/hp-maurice-davis-cutout-header-img.png" />
<?php } ?>

<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TZFXP35');</script>
	<!-- End Google Tag Manager -->

	<?php 
	
	// Global Schema
	$global_schema = get_field('global_schema', 'options');
	if ( !empty($global_schema) ) :
		echo '<script type="application/ld+json">' . $global_schema . '</script>';
	endif;

	// Single Page Schema
	$single_schema = get_field('single_schema');
	if ( !empty($single_schema) ) :
		echo '<script type="application/ld+json">' . $single_schema . '</script>';
	endif;
	
	?>

	<meta name="google-site-verification" content="xwsOaV-4MsEMBvXj9Ajv-kEtHQ4nUi081ai7hNiwH5o" />
	
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php
	$responsiveness = "yes";
	if (isset($qode_options_passage['responsiveness'])) $responsiveness = $qode_options_passage['responsiveness'];
	if($responsiveness != "no"):
	?>
	<meta name=viewport content="width=device-width,initial-scale=1">
	<?php 
	endif;
	?>
	<title><?php if($seo_title) { ?><?php bloginfo('name'); ?> | <?php echo $seo_title; ?><?php } else {?><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?><?php } ?></title>
	<?php if ($disable_qode_seo != "yes") { ?>
	<?php if($seo_description) { ?>
	<meta name="description" content="<?php echo $seo_description; ?>">
	<?php } else if($qode_options_passage['meta_description']){ ?>
	<meta name="description" content="<?php echo $qode_options_passage['meta_description'] ?>">
	<?php } ?>
	<?php if($seo_keywords) { ?>
	<meta name="keywords" content="<?php echo $seo_keywords; ?>">
	<?php } else if($qode_options_passage['meta_keywords']){ ?>
	<meta name="keywords" content="<?php echo $qode_options_passage['meta_keywords'] ?>">
	<?php } ?>
	<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $qode_options_passage['favicon_image']; ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&family=Lato:wght@400;900&family=Playfair+Display:ital,wght@0,400;0,900;1,400&display=swap" rel="stylesheet">
	
    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    ' https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '605029350308522');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src=" https://www.facebook.com/tr?id=605029350308522&ev=PageView&noscript=1 "
    /></noscript>
    <!-- End Meta Pixel Code -->
    <?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZFXP35"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->


<?php
	$header_in_grid = false;
	if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

	$centered_logo = false;
	if (isset($qode_options_passage['center_logo_image'])){ if($qode_options_passage['center_logo_image'] == "yes") { $centered_logo = true; }};
?>
<div class="wrapper">
<header>
	
	<?php if($header_in_grid){ ?>
		<div class="container">
			<div class="container_inner">
	<?php } ?>
				<div class="header_inner clearfix">
		
					<div class="logo">
						<a class="logo-pt" href="<?php echo home_url(); ?>">
							<div class="logo-pt_left">
								<img src="<?php echo $qode_options_passage['logo_image']; ?>" alt="Logo"/>
							</div>
							<div class="logo-pt_text_upper">
								<span class="text_upper">Davis</span>
							</div>
							<div class="logo-pt_text_lower">
								<span class="text_lower">Injury Lawyers, PLLC</span>
							</div>
						</a>
					</div>
					
					<div class="header-cta"><a href="tel:313-462-7979" class="ibp" title="Call Davis Personal Injury Lawyers Today" style="color:#000 !important;">Call (888) Dial Davis<a></div>
					
					<div class="header_inner_right">
						<?php
						$menu_type = $qode_options_passage['top_menu'];
						
						?>
						<nav class="main_menu <?php  if($menu_type == "drop_down") { echo "drop_down"; } elseif($menu_type == "drop_down2") { echo "drop_down2"; } else { echo "drop_down"; } ?>">
						<?php
							
							if($menu_type == "drop_down") :
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type1_walker_nav_menu()
							 ));
							
							elseif($menu_type == "drop_down2"):
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type2_walker_nav_menu()
								 ));
							
							
							else :
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type1_walker_nav_menu()
								 ));
							endif;
						?>
						<span id="magic"></span>
						</nav>
						
						<div id='menu-icon'><span><hr><hr><hr></span></div>
						
						<?php	
						$display_header_widget = $qode_options_passage['header_widget_area'];
						if($display_header_widget == "yes"){ ?> 
							<div class="header_right_widget">
								<?php dynamic_sidebar('header_right'); ?>
							</div>
						<?php } ?>
					</div>

					<nav id="mobile-nav">
					<?php
						// The parent theme menu has way too many complications, lets use a simple wp_menu, mobile-nav, set in the functions.php file
						$args = array(
						'container' => false,
						'theme_location' => 'mobile-nav'
						);
						wp_nav_menu( $args );
					?>
	</nav>
				</div>
	<?php if($header_in_grid){ ?>
			</div>
		</div>
	<?php } ?>
	
</header>
	<div class="content">
		<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$animation = get_post_meta($id, "qode_show-animation", true);

?>
			<?php if($qode_options_passage['page_transitions'] == "1" || $qode_options_passage['page_transitions'] == "2" || $qode_options_passage['page_transitions'] == "3" || $qode_options_passage['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
				<div class="meta">				
					<?php if($seo_title){ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php echo $seo_title; ?></div>
					<?php } else{ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
					<?php } ?>
					<?php if($seo_description){ ?>
						<div class="seo_description"><?php echo $seo_description; ?></div>
					<?php } else if($qode_options_passage['meta_description']){?>
						<div class="seo_description"><?php echo $qode_options_passage['meta_description']; ?></div>
					<?php } ?>
					<?php if($seo_keywords){ ?>
						<div class="seo_keywords"><?php echo $seo_keywords; ?></div>
					<?php }else if($qode_options_passage['meta_keywords']){?>
						<div class="seo_keywords"><?php echo $qode_options_passage['meta_keywords']; ?></div>
					<?php }?>
					<span id="qode_page_id"><?php echo $wp_query->get_queried_object_id(); ?></span>
					<div class="body_classes"><?php echo implode( ',', get_body_class()); ?></div>
				</div>
			<?php } ?>
			<div class="content_inner <?php echo $animation;?> ">

