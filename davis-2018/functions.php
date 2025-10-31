<?php
// Remove Wordpress Emoji Javascript call
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Queue parent style followed by child/customized style
add_action( 'wp_enqueue_scripts', 'davis_enqueue_styles', PHP_INT_MAX);

function davis_enqueue_styles() {
    wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/css/generated/styles.css', null, null, 'all', array( 'davis-style' ) );
    // Enqueue javascript
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.min.js', array( 'jquery' ), null, true );
    // wp_register_script('slider_nav', get_stylesheet_directory_uri() . '/js/slider-nav.js',array('jquery'), null, true); 
    // wp_enqueue_script('slider_nav', get_stylesheet_directory_uri() . '/js/slider-nav.js',array('jquery'), null, true);  

    // Enqueue these files only on the front-page
    if( is_front_page() ) {
    // Slick functions, enqueue only on pages where needed
    //wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/css/generated/slick.css', null, null, 'all' );
    //wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/js/slick.min.js', array( 'jquery' ), null, true );
    //wp_enqueue_script( 'slick-custom', get_stylesheet_directory_uri() . '/js/slick-custom.js', array( 'jquery' ), null, true );
    }
}

// "Magic Code" - Marah
// Enqueue Qode parent theme files that cause console errors
function qode_styles_child() {
    wp_deregister_style('style_dynamic');
    wp_register_style('style_dynamic', get_stylesheet_directory_uri() . '/css/generated/style_dynamic.css');
    wp_enqueue_style('style_dynamic');
    wp_deregister_style('style_dynamic_responsive');
    wp_register_style('style_dynamic_responsive', get_stylesheet_directory_uri() . '/css/generated/style_dynamic_responsive.css');
    wp_enqueue_style('style_dynamic_responsive');
    wp_deregister_style('custom_css');
    wp_register_style('custom_css', get_stylesheet_directory_uri() . '/css/generated/custom_css.css');
    wp_enqueue_style('custom_css');
}
function qode_scripts_child() {
    wp_deregister_script('default_dynamic');
    wp_register_script('default_dynamic', get_stylesheet_directory_uri() . '/js/default_dynamic.js');
    wp_enqueue_style('default_dynamic', array(),false,true);
    wp_deregister_script('custom_js');
    wp_register_script('custom_js', get_stylesheet_directory_uri() . '/js/custom_js.js');
    wp_enqueue_style('custom_js', array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'qode_styles_child', 11);
add_action( 'wp_enqueue_scripts', 'qode_scripts_child', 11);


// Custom Navigation using wp_menus
function davis_register_nav_menus() {
  register_nav_menus(
    array(
        'primary-nav' => __( 'Primary Navigation', 'davis' ),
        'mobile-nav' => __( 'Mobile Navigation', 'davis' ),
        'footer-nav' => __( 'Footer Navigation', 'davis' ),
        'slider-nav' => __( 'Slider Navigation', 'davis' )
    )
  );
}
add_action( 'init', 'davis_register_nav_menus' );

// ACF Options Pages
if( function_exists('acf_add_options_page') ) {

    // Instructions & Customizations options pages functions live here

    // If the site is running the Postali theme,
    // you only need to add this function
    acf_add_options_page(array(
        'page_title'    => 'Global Schema',
        'menu_title'    => 'Global Schema',
        'menu_slug'     => 'global_schema',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-media-code',
        'redirect'      => false
    ));

}

// Widget Logic Conditionals (ancestor) 
function is_child($parent) {
    global $post;
    return $post->post_parent == $parent;
}

// Widget Logic Conditionals (ancestor) 
function is_tree( $pid ) {
    global $post;   
        if ( is_page($pid) )   
        return true;
    $anc = get_post_ancestors( $post->ID ); 
        foreach ( $anc as $ancestor ) {  
        if( is_page() && $ancestor == $pid ) {
            return true;
        }
    }
    return false;
}

// User role edits
add_filter( 'user_has_cap',
function( $caps ) {
    if ( ! empty( $caps['edit_pages'] ) )
        $caps['manage_options'] = true;
    return $caps;
} );

function be_body_classes( $classes ) {
  $classes[] = 'no-touch';
  return $classes;
}
add_filter( 'body_class', 'be_body_classes' );

// Add ability to add SVG to Wordpress Media Library
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Shortcode for adding default sidebar to page content
function sidebar_sc( $atts ) {
    ob_start();
    dynamic_sidebar('SidebarPage');
    $html = ob_get_contents();
    ob_end_clean();
    return '
    <aside class="custom_sidebar">'.$html.'</aside>';
}

add_shortcode('sidebar', 'sidebar_sc');

// Shortcode for Yoast breadcrumbs 
function surbma_yoast_breadcrumb_shortcode_init() {
    load_plugin_textdomain( 'surbma-yoast-breadcrumb-shortcode', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'surbma_yoast_breadcrumb_shortcode_init' );

function surbma_yoast_breadcrumb_shortcode_shortcode( $atts ) {
    extract( shortcode_atts( array(
        "before" => '<p id="breadcrumbs">',
        "after" => '</p>'
    ), $atts ) );

    $wpseo_internallinks = get_option( 'wpseo_internallinks' );

    if ( class_exists( 'WPSEO_Breadcrumbs' ) && $wpseo_internallinks['breadcrumbs-enable'] == 1 ) {
        return yoast_breadcrumb( $before, $after, false );
    }
    elseif ( class_exists( 'WPSEO_Breadcrumbs' ) && $wpseo_internallinks['breadcrumbs-enable'] != 1 ) {
        return __( '<p>Please enable the breadcrumb option to use this shortcode!</p>', 'surbma-yoast-breadcrumb-shortcode' );
    }
    else {
        return __( '<p>Please install <a href="https://wordpress.org/plugins/wordpress-seo/" target="_blank">WordPress SEO by Yoast</a> plugin and enable the breadcrumb option to use this shortcode!</p>', 'surbma-yoast-breadcrumb-shortcode' );
    }
}
add_shortcode( 'yoast-breadcrumb', 'surbma_yoast_breadcrumb_shortcode_shortcode' );

// Shortcode for dynamically updated years
function year_shortcode() {
    $year = date('Y');
    return $year;
  }
add_shortcode('year', 'year_shortcode');

// add excerpts to pages
add_post_type_support( 'page', 'excerpt' );

// Filter except length to 35 words.
// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {
    return 35;
    }
    add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );


// Add numberic post navs
function postali_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";

}

/* Create Results post type */

if (!function_exists('create_post_type')) {
    function create_post_type() {
        register_post_type( 'results_page',
            array(
                'labels' => array(
                    'name' => __( 'Case Results','qode' ),
                    'singular_name' => __( 'Case Result','qode' ),
                    'add_item' => __('New Case result','qode'),
                    'add_new_item' => __('Add New Case Result','qode'),
                    'edit_item' => __('Edit Case Result','qode')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'results'),
                'menu_position' => 4,
                'show_ui' => true,
                'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'post-formats', 'page-attributes')
            )
        );
          flush_rewrite_rules();
    }
    }
    add_action( 'init', 'create_post_type' );

    function klf_acf_input_admin_footer() { ?>
        <script type="text/javascript">
        (function($) {
            acf.add_filter('color_picker_args', function( args, $field ) {
                // add the hexadecimal codes here for the colors you want to appear as swatches
                args.palettes = ['#ffffff', '#f5f6f6', '#000000', '#282828', '#333', '#d9bd4b']
                // return colors
                return args;
            });
        })(jQuery);
        </script>
        <?php }
    add_action('acf/input/admin_footer', 'klf_acf_input_admin_footer');
    
    /* Create Case Result Categories */
    
    // add_action( 'init', 'create_result_taxonomies', 0 );
    // if (!function_exists('create_result_taxonomies')) {
    // function create_portfolio_taxonomies() 
    // {
    //    $labels = array(
    //     'name' => __( 'Result Categories', 'taxonomy general name' ),
    //     'singular_name' => __( 'Result Category', 'taxonomy singular name' ),
    //     'search_items' =>  __( 'Search Result Categories','qode' ),
    //     'all_items' => __( 'All Result Categories','qode' ),
    //     'parent_item' => __( 'Parent Result Category','qode' ),
    //     'parent_item_colon' => __( 'Parent Result Category:','qode' ),
    //     'edit_item' => __( 'Edit Result Category','qode' ), 
    //     'update_item' => __( 'Update Result Category','qode' ),
    //     'add_new_item' => __( 'Add New Result Category','qode' ),
    //     'new_item_name' => __( 'New Result Category Name','qode' ),
    //     'menu_name' => __( 'Result Categories','qode' ),
    //   );     
    
    //   register_taxonomy('results_category',array('results_page'), array(
    //     'hierarchical' => true,
    //     'labels' => $labels,
    //     'show_ui' => true,
    //     'query_var' => true,
    //     'rewrite' => array( 'slug' => 'results-category' ),
    //   ));
    
    // }
    // }

    // Exclude pages on PPC templates from Yoast XML sitemap
function exclude_posts_from_xml_sitemaps() {
	$templates = array(
		'page-ppc-landing.php',
		'page-ppc-landing-pmax.php'
	);

	$ppc_ids = array();
	foreach ( $templates as $template ) {
		//get_page_id_by_template($template);
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
	return ($ppc_ids);
}

add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', 'exclude_posts_from_xml_sitemaps' );

function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');

/**
 * Disable Theme/Plugin File Editors in WP Admin
 * - Hides the submenu items
 * - Blocks direct access to editor screens
 */
function postali_disable_file_editors_menu() {
    // Remove Theme File Editor from Appearance menu
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    // Optional: also remove Plugin File Editor from Plugins menu
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_menu', 'postali_disable_file_editors_menu', 999 );

// Block direct access to the editors even if someone knows the URL
function postali_block_file_editors_direct_access() {
    wp_die( __( 'File editing through the WordPress admin is disabled.' ), 403 );
}
add_action( 'load-theme-editor.php', 'postali_block_file_editors_direct_access' );
add_action( 'load-plugin-editor.php', 'postali_block_file_editors_direct_access' );

/**
 * Disable the Additional CSS panel in the Customizer.
 * Primary method: remove the custom_css component early in load.
 */
function postali_disable_customizer_additional_css_component( $components ) {
    $key = array_search( 'custom_css', $components, true );
    if ( false !== $key ) {
        unset( $components[ $key ] );
    }
    return $components;
}
add_filter( 'customize_loaded_components', 'postali_disable_customizer_additional_css_component' );

/**
 * Fallback: remove the Additional CSS section if it's present.
 */
function postali_remove_customizer_additional_css_section( $wp_customize ) {
    if ( method_exists( $wp_customize, 'remove_section' ) ) {
        $wp_customize->remove_section( 'custom_css' );
    }
}
add_action( 'customize_register', 'postali_remove_customizer_additional_css_section', 20 );