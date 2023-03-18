<?php
/**
 * Peak 2023: Customise the admin
 */

// Add custom body class to admin 
function add_template_body_class_to_admin( $classes ) {
  $template = get_page_template_slug(); // get template file name
  if ($template) {
      $class = explode('.', $template)[0]; // discard .php extension
      $classes .= ' page-template-' . $class;
  }
  return $classes;
}
add_filter( 'admin_body_class', 'add_template_body_class_to_admin' );

//Add certain styles to admin that require accessing the body class
add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/style-admin.css', true, wp_get_theme()->get( 'Version' ) );
}

 // Remove comments
function remove_comments(){
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'remove_comments' );

// Remove comments from menu
function prefix_remove_comments_tl() {
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'prefix_remove_comments_tl' );

// Allow SVG files
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];
}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

// function fix_svg() {
//   echo '<style type="text/css">
//         .attachment-266x266, .thumbnail img {
//              width: 100% !important;
//              height: auto !important;
//         }
//         </style>';
// }
// add_action( 'admin_head', 'fix_svg' );


