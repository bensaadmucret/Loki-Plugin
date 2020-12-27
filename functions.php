<?php



/**
 * A CMB2 options-page display callback override which adds tab navigation among
 * CMB2 options pages which share this same display callback.
 *
 * @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
 */
function yourprefix_options_display_with_tabs( $cmb_options ) {
    $tabs = yourprefix_options_page_tabs( $cmb_options );
    ?>
    <div class="wrap cmb2-options-page option-<?php echo $cmb_options->option_key; ?>">
        <?php if ( get_admin_page_title() ) : ?>
            <h2><?php echo wp_kses_post( get_admin_page_title() ); ?></h2>
        <?php endif; ?>
        <h2 class="nav-tab-wrapper">
            <?php foreach ( $tabs as $option_key => $tab_title ) : ?>
                <a class="nav-tab<?php if ( isset( $_GET['page'] ) && $option_key === $_GET['page'] ) : ?> nav-tab-active<?php endif; ?>" href="<?php menu_page_url( $option_key ); ?>"><?php echo wp_kses_post( $tab_title ); ?></a>
            <?php endforeach; ?>
        </h2>
        <form class="cmb-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" id="<?php echo $cmb_options->cmb->cmb_id; ?>" enctype="multipart/form-data" encoding="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo esc_attr( $cmb_options->option_key ); ?>">
            <?php $cmb_options->options_page_metabox(); ?>
            <?php submit_button( esc_attr( $cmb_options->cmb->prop( 'save_button' ) ), 'primary', 'submit-cmb' ); ?>
        </form>
    </div>
    <?php
}

/**
 * Gets navigation tabs array for CMB2 options pages which share the given
 * display_cb param.
 *
 * @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
 *
 * @return array Array of tab information.
 */
function yourprefix_options_page_tabs( $cmb_options ) {
    $tab_group = $cmb_options->cmb->prop( 'tab_group' );
    $tabs      = array();

    foreach ( CMB2_Boxes::get_all() as $cmb_id => $cmb ) {
        if ( $tab_group === $cmb->prop( 'tab_group' ) ) {
            $tabs[ $cmb->options_page_keys()[0] ] = $cmb->prop( 'tab_title' )
                ? $cmb->prop( 'tab_title' )
                : $cmb->prop( 'title' );
        }
    }

    return $tabs;
}

add_filter('show_admin_bar','remove_admin_bar', PHP_INT_MAX );
function remove_admin_bar()
{
    if (current_user_can('administrator')) {
        return true;
    }
    return false;

}

add_shortcode('user-register', 'user_registration');
function user_registration()
{
    if (is_user_logged_in()) {
        ob_start();
        echo '<div style="text-align: center;">';
        echo '<a  href=' .  home_url( 'member-account' ).' target="_self">';
        echo '<button class="bg-transparent hover:bg-grey text-grey-dark font-semibold hover:text-grey-dark py-2 px-4 border border-grey hover:border-transparent rounded-full mr-2">VOTRE ESPACE</button></a>';
        echo '</div>';
        echo '<br>';
        echo '<div style="text-align: center;">';
        echo '<a  href=' . wp_logout_url(get_permalink()).' target="_self">';
        echo '<button class="bg-transparent hover:bg-grey text-grey-dark font-semibold hover:text-grey-dark py-2 px-4 border border-grey hover:border-transparent rounded-full mr-2">SE DECONNECTER</button></a>';
        echo '</div>';
        $out = ob_get_clean();
        return $out;
    } else {
        $key = get_option("loki_gestion_gravity");
        if ($key['id_inscription']) {
            echo do_shortcode('[gravityform id="'.$key['id_inscription'].'" title="false" description="false"]');
        }
    }
}





function yourprefix_get_wysiwyg_output( $meta_key, $post_id = 0 ) {
	global $wp_embed;

	$post_id = $post_id ? $post_id : get_the_id();

	$content = get_post_meta( $post_id, $meta_key, 1 );
	$content = $wp_embed->autoembed( $content );
	$content = $wp_embed->run_shortcode( $content );
	$content = wpautop( $content );
	$content = do_shortcode( $content );

	return $content;
}


add_action( 'template_redirect', 'redirect_non_logged_users_to_specific_page' );
function redirect_non_logged_users_to_specific_page() {

    if ( !is_user_logged_in() && is_page('member-account') && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php' ) {

        wp_redirect( home_url('member-login') );
        exit;
    }
}



add_shortcode( 'query_shortcode', 'query_shortcode' );
function query_shortcode() {
    $args = array(
        'post_type' => 'post',
        'category_name' => 'introduction',
        'posts_per_page' => 1,
    );


    $my_query = new WP_Query( $args );
    ob_start();

    if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

        //the_title();
        the_content();
        the_post_thumbnail();

    endwhile;
    endif;
    $buffer = ob_get_contents();
    ob_end_clean();

    wp_reset_postdata();
    return $buffer;
}


add_shortcode( 'bienvenue_shortcode', 'bienvenue_shortcode' );
function bienvenue_shortcode() {
    $args = array(
        'post_type' => 'post',
        'category_name' => 'bienvenue',
        'posts_per_page' => 1,
    );


    $my_query = new WP_Query( $args );
    ob_start();

    if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

        //the_title();
        the_content();
        the_post_thumbnail();

    endwhile;
    endif;
    $buffer = ob_get_contents();
    ob_end_clean();

    wp_reset_postdata();
    return $buffer;
}


function wpr_authorNotification($post_id) {

    if ( isset( $_POST['action'] )
        && wp_verify_nonce(
            sanitize_text_field( wp_unslash( $_POST['validation'] ) ),
            'update-user'
        )
    ) {
        $post = get_post($post_id);
        $author = get_userdata($post->post_author);

        $message = $author->display_name . ",
                 Vient de validé l'étape !";
            $email = "mohammed.bensaad@itga.fr";
        wp_mail( $email, "validation effectuée", $message);
    }
}
add_action('pending_to_publish', 'wpr_authorNotification');



