<?php 

/*
* Change the behaviour of the more link for founders and teammembers query loop to ignore the read more link
* This is to allow the more link to be used in old theme but we don't need it in new theme 
*/

function custom_excerpt_more( $more ) {
  if ( 'founders' == get_post_type() || 'teammember' == get_post_type() ){ 
    $postid = get_the_ID();
    $content_post = get_post($postid);
    $content = get_extended($content_post->post_content);
    $content = apply_filters('the_content', $content['extended']);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
  };
}
add_filter( 'the_content_more_link', 'custom_excerpt_more' );