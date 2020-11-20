<?php

/*
Template Name: Projet01 Layout
*/



if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
function get($resource){
    $apiUrl = 'http://local.local/wp-json';
    $json = file_get_contents($apiUrl.$resource);
    $result = json_decode($json);
    return $result;
}
$pages = get('/MyPlugin/v1/pages/6/contentElementor', array(

));
echo $pages->contentElementor;
*/

$args = array(
    'post_type' => 'post',
    'category_name' => 'projet',
    'posts_per_page' => 1,
);

// 2. On exécute la WP Query
$my_query = new WP_Query( $args );

// 3. On lance la boucle
if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();



    $url = esc_url( get_post_meta( get_the_ID(), '_video', 1 ) );
    echo wp_oembed_get( $url );
      echo '<br><br><br><br>';
    $text = get_post_meta( get_the_ID(), '_text', 1 );
    echo do_shortcode($text);

    the_title();
    the_content();
    the_post_thumbnail();

endwhile;
endif;

// 4. On réinitialise à la requête principale (important)
wp_reset_postdata(); ?>
