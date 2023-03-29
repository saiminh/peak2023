<?php

if ( ! function_exists( 'peak2023_support' ) ) :
  function peak2023_support()  {

    // Adding support for core block visual styles.
    add_theme_support( 'wp-block-styles' );

    // Enqueue editor styles.
    add_editor_style( 'style.css' );
  }
  add_action( 'after_setup_theme', 'peak2023_support' );
endif;

/**
 * Enqueue scripts and styles.
 */
function peak2023_scripts() {
  wp_enqueue_style( 
    'peak2023-style', 
    get_template_directory_uri() . '/style.css', 
    array(), 
    wp_get_theme()->get( 'Version' ) 
  );
  global $post;
  if( $post && strpos( $post->post_content, 'peak-faq' ) !== false) {
    wp_enqueue_script( 'faqs', get_template_directory_uri().'/assets/js/faqs.min.js', array(), false, true );
  }
  if( is_home() || is_archive() || is_search() ) {
    wp_enqueue_script( 'faqs', get_template_directory_uri().'/assets/js/cat-filter.min.js', array(), false, true );
  }
}
add_action( 'wp_enqueue_scripts', 'peak2023_scripts' );

//Clean up some code from the frontend that is not needed for our theme
require get_template_directory() . '/inc/cleanup-frontend-code.php';

//Add custom post types
require get_template_directory() . '/inc/custom-post-types.php';

//Add certain styles to admin that require accessing the body class
require get_template_directory() . '/inc/customise-admin.php';

//Circumvent the content_more_link for founders and teammembers query loops
require get_template_directory() . '/inc/support-cpt-query-full.php';

// Image sizes
require get_template_directory() . '/inc/image-sizes.php';