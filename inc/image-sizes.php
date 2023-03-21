<?php

function peak_add_image_sizes() {
  add_image_size( 'hero', 1920, 1280 );
  add_image_size( 'founder-photo-x-large', 1060, 871, true );
  add_image_size( 'founder-photo-large', 760, 624, true );
  add_image_size( 'founder-photo', 560, 460, true );
  add_image_size( 'founder-photo-s', 460, 378, true );
  add_image_size( 'teammember-photo-small', 320, 480, true );
  add_image_size( 'teammember-photo-medium', 480, 720, true );
  add_image_size( 'teammember-photo-large', 700, 1050, true );
  add_image_size( 'teammember-photo-full', 1280, 1920, true );
}
add_action('after_setup_theme', 'peak_add_image_sizes');

function peak_custom_sizes( $sizes ) {
  return array_merge( $sizes, array(
    'hero' => __( 'Hero image' ),
    'founder-photo' => __( 'Founder Photo' ),
    'teammember-photo-small' => __( 'Team member Small' ),
    'teammember-photo-full' => __( 'Team member Full' ),
    ) );
}

add_filter( 'image_size_names_choose', 'peak_custom_sizes' );

function my_content_image_sizes_attr( $sizes, $size, $image_src, $image_meta, $attachment_id ) {
  $width = $size[0];
  $height = $size[1];
  
  if ( get_post_type() == 'teammember' && is_front_page() ) {
    $sizes = '(min-width: 600) 14vw, 30vw';
  }
  if ( get_post_type() == 'teammember' && !is_front_page() ) {
    $sizes = '(min-width: 600) 24vw, calc(100vw - 30px)';
  }
  if ( get_post_type() == 'founders' && is_front_page() ) {
    $sizes = '(min-width: 600) 40vw, 94vw';
  }
  if ( get_post_type() == 'founders' && !is_front_page() ) { //founder photo on founders page
    $sizes = '(min-width: 600) 32vw, 93vw';
  }
  if ( get_post_type() == 'post' ) {
    $sizes = '(min-width: 600) 46vw, 90vw';
  }
  if ( is_single() ) {
    $sizes = '(min-width: 600) 40rem, 90vw';
  }

  return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'my_content_image_sizes_attr', 10, 5 );