<?php


/*-------------------------------------------------------------------------------
	Theme Support
-------------------------------------------------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}


if (function_exists('add_theme_support'))
{
    // Menus
    add_theme_support('menus');
    
    // Post Thumbnails
    add_theme_support('post-thumbnails');
    
    // Custom Backgrounds 
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/images/background.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/images/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/
    
    // Custom Header
    /*$defaults = array(
        'default-image'          => '',
        'random-default'         => false,
        'width'                  => 0,
        'height'                 => 0,
        'flex-height'            => false,
        'flex-width'             => false,
        'default-text-color'     => '',
        'header-text'            => true,
        'uploads'                => true,
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
    );
    add_theme_support( 'custom-header', $defaults ); */
    
    // Post Formats
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
    
    // Title Tag
    /*add_theme_support( 'title-tag' );*/
}

/*-------------------------------------------------------------------------------
	Widget Areas
-------------------------------------------------------------------------------*/

function custom_sidebar()  {

	$args = array(
		'id'            => 'sidebar',
		'name'          => __( 'Sidebar Name', 'text_domain' ),
		'description'   => __( 'Sidebar Description', 'text_domain' ),
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
	);
	register_sidebar( $args );

}

add_action( 'widgets_init', 'custom_sidebar' );

/*-------------------------------------------------------------------------------
	Load Scripts
-------------------------------------------------------------------------------*/

function load_scripts()
{
    if (!is_admin()) {

    wp_deregister_script('jquery');
    wp_register_script('jquery', '//code.jquery.com/jquery-1.11.2.min.js', array(), '1.11.2', true); 
    wp_enqueue_script('jquery'); 

    wp_register_script('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/js/bootstrap.min.js', array('jquery'), '4.0.0',true); 
    wp_enqueue_script('bootstrap');
    
    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0',true); 
    wp_enqueue_script('scripts'); 
    
    }
}

add_action('init', 'load_scripts'); // Add Custom Scripts to wp_head

/*-------------------------------------------------------------------------------
	Conditional Scripts
-------------------------------------------------------------------------------*/

function conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); 
    }
}
add_action('wp_print_scripts', 'conditional_scripts');

/*-------------------------------------------------------------------------------
	Load Styles
-------------------------------------------------------------------------------*/

function theme_styles()
{
    wp_register_style('theme', get_template_directory_uri() . '/style.css', array('bootstrap','fontawesome'), '1.0', 'all');
    wp_enqueue_style('theme');
	wp_register_style('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css', array(), '4.0.0', 'all');
    wp_enqueue_style('bootstrap'); 
	wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array('bootstrap'), '4.3.0', 'all');
    wp_enqueue_style('fontawesome');
}
add_action('wp_enqueue_scripts', 'theme_styles');


/*-------------------------------------------------------------------------------
	Remove DIV from Custom Menus
-------------------------------------------------------------------------------*/

function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation

/*-------------------------------------------------------------------------------
	Post Pagination
-------------------------------------------------------------------------------*/

function post_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}
add_action('init', 'post_pagination');

/*-------------------------------------------------------------------------------
	Add page slug to body class, love this - Credit: Starkers Wordpress Theme
-------------------------------------------------------------------------------*/

function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');

/*-------------------------------------------------------------------------------
	Remove 'text/css' from our enqueued stylesheet
-------------------------------------------------------------------------------*/

function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
add_filter('style_loader_tag', 'html5_style_remove'); 

/*-------------------------------------------------------------------------------
	Add Link Manager
-------------------------------------------------------------------------------*/

add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/*-------------------------------------------------------------------------------
	Remove actions
-------------------------------------------------------------------------------*/

remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/*-------------------------------------------------------------------------------
	Custom Post Type Menu Icons
-------------------------------------------------------------------------------*/

function add_menu_icons_styles(){
?>
 
<style>
#adminmenu .menu-icon-CUSTOM_POST div.wp-menu-image:before {content: "\f231";}
</style>
 
<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );

/*-------------------------------------------------------------------------------
	Custom Post Types
-------------------------------------------------------------------------------*/

/* function custom_post_type() {

	$labels = array(
		'name'                => 'CUSTOM_POST',
		'singular_name'       => 'CUSTOM_POST',
		'menu_name'           => 'CUSTOM_POST',
		'parent_item_colon'   => 'Parent CUSTOM_POST:',
		'all_items'           => 'All CUSTOM_POST',
		'view_item'           => 'View CUSTOM_POST',
		'add_new_item'        => 'Add New CUSTOM_POST',
		'add_new'             => 'Add New CUSTOM_POST',
		'edit_item'           => 'Edit CUSTOM_POST',
		'update_item'         => 'Update CUSTOM_POST',
		'search_items'        => 'Search CUSTOM_POST',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => 'CUSTOM_POST',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'CUSTOM_POST',
		'description'         => 'Post Type Description',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'CUSTOM_POST', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 ); */

?>
