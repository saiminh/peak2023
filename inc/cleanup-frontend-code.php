<?php

//Remove SVG filters from the body
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

//Remove jQuery
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
function remove_jquery_migrate($scripts){
    if(!is_admin()){
        $scripts->remove( 'jquery');
    }
}

// This removes all empty paragraphs from the content
function remove_empty_p($content){
  $content = force_balance_tags($content);
  return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}
add_filter('the_content', 'remove_empty_p', 20, 1);