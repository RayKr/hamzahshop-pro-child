<?php

function get_post_excerpt($post, $excerpt_length=240){
  if(!$post) $post = get_post();

  $post_excerpt = $post->post_excerpt;
  if($post_excerpt == ''){
      $post_content = $post->post_content;
      $post_content = do_shortcode($post_content);
      $post_content = wp_strip_all_tags( $post_content );

      $post_excerpt = mb_strimwidth($post_content,0,$excerpt_length,'…','utf-8');
  }

  $post_excerpt = wp_strip_all_tags( $post_excerpt );
  $post_excerpt = trim( preg_replace( "/[\n\r\t ]+/", ' ', $post_excerpt ), ' ' );

  return $post_excerpt;
}

?>