<?php
if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail252x238
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    add_image_size( '362x262', 362, 262, array( 'center', 'center' ) );
    add_image_size( '640x440', 640, 440, array( 'center', 'center' ) );
    add_image_size( '248x238', 248, 238, array( 'center', 'center' ) );
    add_image_size( '890x420', 890, 420, array( 'center', 'center' ) );
    add_image_size( '360x255', 360, 255, array( 'center', 'center' ) );

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	// wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
      // wp_enqueue_script('conditionizr'); // Enqueue it!
      //
      // wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
      // wp_enqueue_script('modernizr'); // Enqueue it!
      //
      // wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
      // wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    // if (is_page('pagenamehere')) {
        wp_register_script('plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '1.0.0'); // Conditional script(s)
        // wp_register_script('swipscripts', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0');
        wp_enqueue_script('plugins'); // Enqueue it!
        // wp_enqueue_script('swipscripts');
    // }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array(
        'top-menu' => __('Top Menu', 'html5blank'), // Main Navigation
        'top-right-menu' => __('Top Menu Right', 'html5blank'), // Sidebar Navigation
        // 'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
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



// Our custom post type function
function create_posttype() {

register_post_type( 'winners',
// CPT Options
  array(
    'labels' => array(
      'name' => __( 'Winners' ),
      'singular_name' => __( 'Winner' )
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'winners'),
  )
);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );



function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Winners', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Winner', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Movies', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Winner', 'twentythirteen' ),
		'all_items'           => __( 'All Winners', 'twentythirteen' ),
		'view_item'           => __( 'View Winner', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Winner', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Winner', 'twentythirteen' ),
		'update_item'         => __( 'Update Winner', 'twentythirteen' ),
		'search_items'        => __( 'Search Winner', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'winners', 'twentythirteen' ),
		'description'         => __( 'Winner news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'winners', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );



// Our custom post type function
function create_posttype_member() {

register_post_type( 'members',
// CPT Options
  array(
    'labels' => array(
      'name' => __( 'Swip Members' ),
      'singular_name' => __( 'Member' )
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'members'),
  )
);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_member' );



function custom_post_type_member() {

// Set UI labels for Custom Post Type
  $labels = array(
    'name'                => _x( 'Swip Members', 'Post Type General Name', 'twentythirteen' ),
    'singular_name'       => _x( 'Member', 'Post Type Singular Name', 'twentythirteen' ),
    'menu_name'           => __( 'Swip Members', 'twentythirteen' ),
    'parent_item_colon'   => __( 'Parent Member', 'twentythirteen' ),
    'all_items'           => __( 'All Swip Members', 'twentythirteen' ),
    'view_item'           => __( 'View Swip Member', 'twentythirteen' ),
    'add_new_item'        => __( 'Add New Swip Member', 'twentythirteen' ),
    'add_new'             => __( 'Add New', 'twentythirteen' ),
    'edit_item'           => __( 'Edit Swip Member', 'twentythirteen' ),
    'update_item'         => __( 'Update Swip Member', 'twentythirteen' ),
    'search_items'        => __( 'Search Swip Member', 'twentythirteen' ),
    'not_found'           => __( 'Not Found', 'twentythirteen' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
  );

// Set other options for Custom Post Type

  $args = array(
    'label'               => __( 'members', 'twentythirteen' ),
    'description'         => __( 'Swip Member news and reviews', 'twentythirteen' ),
    'labels'              => $labels,
    // Features this CPT supports in Post Editor
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
    // You can associate this CPT with a taxonomy or custom taxonomy.
    'taxonomies'          => array( 'genres' ),
    /* A hierarchical CPT is like Pages and can have
    * Parent and child items. A non-hierarchical CPT
    * is like Posts.
    */
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );

  // Registering your Custom Post Type
  register_post_type( 'members', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type_member', 0 );




// Our custom post type function
function create_posttype_partners() {

register_post_type( 'partners',
// CPT Options
  array(
    'labels' => array(
      'name' => __( 'Our Partners' ),
      'singular_name' => __( 'Partner' )
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'partners'),
  )
);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_partners' );



function custom_post_type_partners() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Our Partners', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Partner', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Partners', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Partner', 'twentythirteen' ),
		'all_items'           => __( 'All Partners', 'twentythirteen' ),
		'view_item'           => __( 'View Partner', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Partner', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Partner', 'twentythirteen' ),
		'update_item'         => __( 'Update Partner', 'twentythirteen' ),
		'search_items'        => __( 'Search Partner', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'partners', 'twentythirteen' ),
		'description'         => __( 'Partner news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'partners', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type_partners', 0 );





// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
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


$args = array(
   'base'               => '%_%',
   'format'             => '?paged=%#%',
   'total'              => 1,
   'current'            => 0,
   'show_all'           => false,
   'end_size'           => 1,
   'mid_size'           => 2,
   'add_args'           => false,
   'add_fragment'       => '',
   'before_page_number' => '',
   'after_page_number'  => ''); 

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }



/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/



/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}


pll_register_string('swip', 'I WANT TO WIN TOO' );
pll_register_string('swip', 'Recent Winners' );
pll_register_string('swip', 'We have nurtured a number' );
pll_register_string('swip', 'Success Stories' );
pll_register_string('swip', 'EXPLORE MORE' );
pll_register_string('swip', 'Who is Swip?' );
pll_register_string('swip', 'swip.world belongs to the privately' );
pll_register_string('swip', 'Our Values' );
pll_register_string('swip', 'Lets`s all buils on a fundament of shared values.' );
pll_register_string('swip', 'MORE ABOUT SWIP' );
pll_register_string('swip', 'The Crowd Can Innovate Better!' );
pll_register_string('swip', 'JOIN SWIP and WORLD' );
pll_register_string('swip', 'OUR PARTNERS' );
pll_register_string('swip', 'Are you curious?' );
pll_register_string('blog', 'Blog' );
pll_register_string('blog', 'Find pointers on how to make your project the next big thing' );
pll_register_string('blog', 'Categories' );
pll_register_string('blog', 'Popular' );
pll_register_string('swip', 'BROWSE ALL PROJECTS' );


// function wpbeginner_numeric_posts_nav() {
// 
//     if( is_singular() )
//         return;
// 
//     global $wp_query;
// 
//     /** Stop execution if there's only 1 page */
//     if( $wp_query->max_num_pages <= 1 )
//         return;
// 
//     $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
//     $max   = intval( $wp_query->max_num_pages );
// 
//     /** Add current page to the array */
//     if ( $paged >= 1 )
//         $links[] = $paged;
// 
//     /** Add the pages around the current page to the array */
//     if ( $paged >= 3 ) {
//         $links[] = $paged - 1;
//         $links[] = $paged - 2;
//     }
// 
//     if ( ( $paged + 2 ) <= $max ) {
//         $links[] = $paged + 2;
//         $links[] = $paged + 1;
//     }
// 
//     echo '<div class="navigation"><ul>' . "\n";
// 
//     /** Previous Post Link */
//     if ( get_previous_posts_link() )
//         printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
// 
//     /** Link to first page, plus ellipses if necessary */
//     if ( ! in_array( 1, $links ) ) {
//         $class = 1 == $paged ? ' class="active"' : '';
// 
//         printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
// 
//         if ( ! in_array( 2, $links ) )
//             echo '<li>…</li>';
//     }
// 
//     /** Link to current page, plus 2 pages in either direction if necessary */
//     sort( $links );
//     foreach ( (array) $links as $link ) {
//         $class = $paged == $link ? ' class="active"' : '';
//         printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
//     }
// 
//     /** Link to last page, plus ellipses if necessary */
//     if ( ! in_array( $max, $links ) ) {
//         if ( ! in_array( $max - 1, $links ) )
//             echo '<li>…</li>' . "\n";
// 
//         $class = $paged == $max ? ' class="active"' : '';
//         printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
//     }
// 
//     /** Next Post Link */
//     if ( get_next_posts_link() )
//         printf( '<li>%s</li>' . "\n", get_next_posts_link() );
// 
//     echo '</ul></div>' . "\n";
// 
// }
?>
