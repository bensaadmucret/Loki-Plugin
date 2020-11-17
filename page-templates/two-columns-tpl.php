<?php

/* 
Template Name: Two Columns Layout
*/

get_header();

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

while ( have_posts() ) : the_post();
    ?>


    <main <?php post_class( 'site-main' ); ?> role="main">
        <?php if ( apply_filters( 'loki_elementor_page_title', true ) ) : ?>
            <header class="page-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>
        <?php endif; ?>
        <div class="page-content">
            <div class="post-tags">
                <?php the_content(); ?>
                <?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'loki-elementor' ), null, '</span>' ); ?>
            </div>
            <?php wp_link_pages(); ?>
        </div>

        <?php comments_template(); ?>
    </main>
    <?php


endwhile;
 get_footer();

