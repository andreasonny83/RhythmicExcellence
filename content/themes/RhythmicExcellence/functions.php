<?php
function register_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'social-menu' => __( 'Social Menu' )
    )
  );
}

// Disable image link URL
function wpb_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );

  if ( $image_set !== 'none' ) {
    update_option( 'image_default_link_type', 'none' );
  }
}

// Disable providing useful information on the log in screen
function no_wordpress_errors() {
  return 'Username or password invalid';
}

/**
 * The following lines of code will protect the website
 * removing all unwanted information like the WordPress version
 **/
//Remove RSS Feeds
remove_action( 'wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link'); // index link
remove_action( 'wp_head', 'parent_post_rel_link'); // prev link
remove_action( 'wp_head', 'start_post_rel_link'); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link'); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version

// you may just want to kill all your RSS Feeds, wordpress does provide
remove_action('do_feed',      'disable_all_feeds', 1);
remove_action('do_feed_rdf',  'disable_all_feeds', 1);
remove_action('do_feed_rss',  'disable_all_feeds', 1);
remove_action('do_feed_rss2', 'disable_all_feeds', 1);
remove_action('do_feed_atom', 'disable_all_feeds', 1);

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

add_theme_support( 'post-thumbnails' );

add_action( 'init', 'register_menus' );
add_action( 'admin_init', 'wpb_imagelink_setup', 10 );

add_filter( 'login_errors', 'no_wordpress_errors' );
