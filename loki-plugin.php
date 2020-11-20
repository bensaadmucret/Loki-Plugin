<?php
/**
 * @package  LokiPlugin
 */
/*
Plugin Name: Loki Plugin
Plugin URI: https://fr.linkedin.com/in/mohammed-bensaad-developpeur
Description: plugin stater.
Version: 1.0.0
Author: Mohammed "Ben" Bensaad
Author URI: https://fr.linkedin.com/in/mohammed-bensaad-developpeur
License: GPLv2 or later
Text Domain: loki-plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Require once Cmb2 métabox
if ( file_exists( dirname( __FILE__ ) . '/vendor/cmb2/cmb2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/cmb2/cmb2/init.php';
}

// Require Extention
if ( file_exists( dirname( __FILE__ ) . '/extention/cmb2-admin-extension.php' ) ) {
    require_once dirname( __FILE__ ) . '/extention/cmb2-admin-extension.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_loki_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_loki_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_loki_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_loki_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::registerServices();
}


/**
 * @return bool
 */
function remove_admin_bar()
{
    if (current_user_can('administrator')) {
        return true;
    }
    return false;
}

add_filter('show_admin_bar', 'remove_admin_bar', PHP_INT_MAX);




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




/*
*
* Version: 20191102
* Author: Aurélien Denis
* Author URI: https://wpchannel.com/
*/


/* Check if Gravity Forms is available */
//include_once(ABSPATH . 'wp-admin/includes/plugin.php');
//if (is_plugin_active('gravityforms/gravityforms.php')) {

    /* JS in Footer */
    add_filter('gform_init_scripts_footer', '__return_true');

    function wpc_gform_cdata_open($content = '') {
        $content = 'document.addEventListener("DOMContentLoaded", function() { ';
        return $content;
    }
    add_filter('gform_cdata_open', 'wpc_gform_cdata_open');

    function wpc_gform_cdata_close($content = '') {
        $content = ' }, false);';
        return $content;
    }
    add_filter('gform_cdata_close', 'wpc_gform_cdata_close');


    /* Change Submit Button */
    function wpc_gf_input_to_button($button, $form) {
        $dom = new DOMDocument();
        $dom->loadHTML($button);
        $input = $dom->getElementsByTagName('input')->item(0);
        $new_button = $dom->createElement('button');
        $new_button->appendChild($dom->createTextNode($input->getAttribute('value')));
        $input->removeAttribute('value');
        foreach($input->attributes as $attribute) {
            $new_button->setAttribute($attribute->name, $attribute->value);
        }
        $input->parentNode->replaceChild($new_button, $input);
        return $dom->saveHtml($new_button);
    }
    add_filter('gform_next_button', 'wpc_gf_input_to_button', 10, 2);
    add_filter('gform_previous_button', 'wpc_gf_input_to_button', 10, 2);
    add_filter('gform_submit_button', 'wpc_gf_input_to_button', 10, 2);


    /* Add Bootstrap 4 Classes on Submit Button */
    function wpc_gf_custom_css_classes($button, $form) {
        $dom = new DOMDocument();
        $dom->loadHTML($button);
        $input = $dom->getElementsByTagName('button')->item(0);
        $classes = $input->getAttribute('class');
        $classes .= " btn btn-primary text-uppercase";
        $input->setAttribute('class', $classes);
        return $dom->saveHtml($input);
    }
    add_filter('gform_submit_button', 'wpc_gf_custom_css_classes', 10, 2);


    /* Add Bootstrap 4 Classes on Fields */
    function wpc_gf_bs4($content, $field, $value, $lead_id, $form_id) {
        if ($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'checkbox' && $field["type"] != 'html' && $field["type"] != 'address') {
            $content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
            $content = str_replace('class=\'large', 'class=\'form-control large', $content);
        }
        if ($field["type"] == 'name' || $field["type"] == 'address') {
            $content = str_replace('<input ', '<input class=\'form-control\' ', $content);
        }
        if ($field["type"] == 'textarea') {
            $content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
        }
        if ($field["type"] == 'consent') {
            $content = str_replace('<input ', '<input class=\'custom-control-input\' ', $content);
            $content = str_replace('gfield_consent_label', 'gfield_consent_label custom-control-label', $content);
        }
        return $content;
    }
    add_filter('gform_field_content', 'wpc_gf_bs4', 10, 5);


    /* Add Bootstrap 4 Validation Message */
    function wpc_gf_validation($message, $form) {
        return "<div class='validation_error alert alert-danger'>" . esc_html__('There was a problem with your submission.', 'gravityforms') . ' ' . esc_html__('Errors have been highlighted below.', 'gravityforms') . '</div>';
    }
    add_filter('gform_validation_message', 'wpc_gf_validation', 10, 2);
//}


add_action( 'current_screen', 'redirect_non_authorized_user' );
function redirect_non_authorized_user() {
    // Si t'es pas admin, tu vires
    if ( is_user_logged_in() && ! current_user_can( 'manage_options' ) ) {
        wp_redirect( home_url( '/' ) );
        exit();
    }
}

add_filter( 'login_form_bottom', 'lien_mot_de_passe_perdu' );
function lien_mot_de_passe_perdu( $formbottom ) {
    $formbottom .= '<a href="' . wp_lostpassword_url() . '">Mot de passe perdu ?</a>';
    return $formbottom;
}


add_action("rest_api_init", function () {

    register_rest_route(
        "MyPlugin/v1"
        , "/pages/(?P<id>\d+)/contentElementor"
        , [
            "methods" => "GET",
            "callback" => function (\WP_REST_Request $req) {

                $contentElementor = "";

                if (class_exists("\\Elementor\\Plugin")) {
                    $post_ID = $req->get_param("id");

                    $pluginElementor = \Elementor\Plugin::instance();
                    $contentElementor = $pluginElementor->frontend->get_builder_content($post_ID);
                }


                return $contentElementor;

            },
        ]
    );


});

class Personalize_Login_Plugin {

    /**
     * Initializes the plugin.
     *
     * To keep the initialization fast, only add filter and action
     * hooks in the constructor.
     */
    public function __construct() {

        // Redirects
        add_action( 'login_form_login', array( $this, 'redirect_to_custom_login' ) );
        add_filter( 'authenticate', array( $this, 'maybe_redirect_at_authenticate' ), 101, 3 );
        add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );
        add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );

        add_action( 'login_form_register', array( $this, 'redirect_to_custom_register' ) );
        add_action( 'login_form_lostpassword', array( $this, 'redirect_to_custom_lostpassword' ) );
        add_action( 'login_form_rp', array( $this, 'redirect_to_custom_password_reset' ) );
        add_action( 'login_form_resetpass', array( $this, 'redirect_to_custom_password_reset' ) );

        // Handlers for form posting actions
        add_action( 'login_form_register', array( $this, 'do_register_user' ) );
        add_action( 'login_form_lostpassword', array( $this, 'do_password_lost' ) );
        add_action( 'login_form_rp', array( $this, 'do_password_reset' ) );
        add_action( 'login_form_resetpass', array( $this, 'do_password_reset' ) );

        // Other customizations
        add_filter( 'retrieve_password_message', array( $this, 'replace_retrieve_password_message' ), 10, 4 );

        // Setup
        add_action( 'wp_print_footer_scripts', array( $this, 'add_captcha_js_to_footer' ) );
        add_filter( 'admin_init' , array( $this, 'register_settings_fields' ) );

        // Shortcodes
        add_shortcode( 'custom-login-form', array( $this, 'render_login_form' ) );
        add_shortcode( 'custom-register-form', array( $this, 'render_register_form' ) );
        add_shortcode( 'custom-password-lost-form', array( $this, 'render_password_lost_form' ) );
        add_shortcode( 'custom-password-reset-form', array( $this, 'render_password_reset_form' ) );
        add_shortcode( 'account-info', array( $this, 'render_account_info_form' ) );
    }


    public function render_account_info_form(){

        return do_shortcode(' [gravityform id="2" title="false" description="false" ajax="true" tabindex="49" field_values="check=First Choice,Second Choice"] ');

    }

    /**
     * Plugin activation hook.
     *
     * Creates all WordPress pages needed by the plugin.
     */
    public static function plugin_activated() {
        // Information needed for creating the plugin's pages
        $page_definitions = array(
            'member-login' => array(
                'title' => __( 'Se connecter', 'personalize-login' ),
                'content' => '[custom-login-form]'
            ),
            'member-account' => array(
                'title' => __( 'Votre compte', 'personalize-login' ),
                'content' => '[account-info]'
            ),
            'member-register' => array(
                'title' => __( 'Register', 'personalize-login' ),
                'content' => '[custom-register-form]'
            ),
            'member-password-lost' => array(
                'title' => __( 'Mot de passe oublié?', 'personalize-login' ),
                'content' => '[custom-password-lost-form]'
            ),
            'member-password-reset' => array(
                'title' => __( 'Choisissez un nouveau mot de passe', 'personalize-login' ),
                'content' => '[custom-password-reset-form]'
            )
        );

        foreach ( $page_definitions as $slug => $page ) {
            // Check that the page doesn't exist already
            $query = new WP_Query( 'pagename=' . $slug );
            if ( ! $query->have_posts() ) {
                // Add the page using the data from the array above
                wp_insert_post(
                    array(
                        'post_content'   => $page['content'],
                        'post_name'      => $slug,
                        'post_title'     => $page['title'],
                        'post_status'    => 'publish',
                        'post_type'      => 'page',
                        'ping_status'    => 'closed',
                        'comment_status' => 'closed',
                    )
                );
            }
        }
    }

    //
    // REDIRECT FUNCTIONS
    //

    /**
     * Redirect the user to the custom login page instead of wp-login.php.
     */
    public function redirect_to_custom_login() {
        if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user();
                exit;
            }

            // The rest are redirected to the login page
            $login_url = home_url( 'member-login' );
            if ( ! empty( $_REQUEST['redirect_to'] ) ) {
                $login_url = add_query_arg( 'redirect_to', $_REQUEST['redirect_to'], $login_url );
            }

            if ( ! empty( $_REQUEST['checkemail'] ) ) {
                $login_url = add_query_arg( 'checkemail', $_REQUEST['checkemail'], $login_url );
            }

            wp_redirect( $login_url );
            exit;
        }
    }

    /**
     * Redirect the user after authentication if there were any errors.
     *
     * @param Wp_User|Wp_Error  $user       The signed in user, or the errors that have occurred during login.
     * @param string            $username   The user name used to log in.
     * @param string            $password   The password used to log in.
     *
     * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
     */
    public function maybe_redirect_at_authenticate( $user, $username, $password ) {
        // Check if the earlier authenticate filter (most likely,
        // the default WordPress authentication) functions have found errors
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            if ( is_wp_error( $user ) ) {
                $error_codes = join( ',', $user->get_error_codes() );

                $login_url = home_url( 'member-login' );
                $login_url = add_query_arg( 'login', $error_codes, $login_url );

                wp_redirect( $login_url );
                exit;
            }
        }

        return $user;
    }

    /**
     * Returns the URL to which the user should be redirected after the (successful) login.
     *
     * @param string           $redirect_to           The redirect destination URL.
     * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
     * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
     *
     * @return string Redirect URL
     */
    public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
        $redirect_url = home_url();

        if ( ! isset( $user->ID ) ) {
            return $redirect_url;
        }

        if ( user_can( $user, 'manage_options' ) ) {
            // Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
            if ( $requested_redirect_to == '' ) {
                $redirect_url = admin_url();
            } else {
                $redirect_url = $redirect_to;
            }
        } else {
            // Non-admin users always go to their account page after login
            $redirect_url = home_url( 'member-account' );
        }

        return wp_validate_redirect( $redirect_url, home_url() );
    }

    /**
     * Redirect to custom login page after the user has been logged out.
     */
    public function redirect_after_logout() {
        $redirect_url = home_url( 'member-login?logged_out=true' );
        wp_redirect( $redirect_url );
        exit;
    }

    /**
     * Redirects the user to the custom registration page instead
     * of wp-login.php?action=register.
     */
    public function redirect_to_custom_register() {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user();
            } else {
                wp_redirect( home_url( 'member-register' ) );
            }
            exit;
        }
    }

    /**
     * Redirects the user to the custom "Forgot your password?" page instead of
     * wp-login.php?action=lostpassword.
     */
    public function redirect_to_custom_lostpassword() {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user();
                exit;
            }

            wp_redirect( home_url( 'member-password-lost' ) );
            exit;
        }
    }

    /**
     * Redirects to the custom password reset page, or the login page
     * if there are errors.
     */
    public function redirect_to_custom_password_reset() {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            // Verify key / login combo
            $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
            if ( ! $user || is_wp_error( $user ) ) {
                if ( $user && $user->get_error_code() === 'expired_key' ) {
                    wp_redirect( home_url( 'member-login?login=expiredkey' ) );
                } else {
                    wp_redirect( home_url( 'member-login?login=invalidkey' ) );
                }
                exit;
            }

            $redirect_url = home_url( 'member-password-reset' );
            $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
            $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );

            wp_redirect( $redirect_url );
            exit;
        }
    }


    //
    // FORM RENDERING SHORTCODES
    //

    /**
     * A shortcode for rendering the login form.
     *
     * @param  array   $attributes  Shortcode attributes.
     * @param  string  $content     The text content for shortcode. Not used.
     *
     * @return string  The shortcode output
     */
    public function render_login_form( $attributes, $content = null ) {
        // Parse shortcode attributes
        $default_attributes = array( 'show_title' => false );
        $attributes = shortcode_atts( $default_attributes, $attributes );

        if ( is_user_logged_in() ) {
            return __( 'You are already signed in.', 'personalize-login' );
        }

        // Pass the redirect parameter to the WordPress login functionality: by default,
        // don't specify a redirect, but if a valid redirect URL has been passed as
        // request parameter, use it.
        $attributes['redirect'] = '';
        if ( isset( $_REQUEST['redirect_to'] ) ) {
            $attributes['redirect'] = wp_validate_redirect( $_REQUEST['redirect_to'], $attributes['redirect'] );
        }

        // Error messages
        $errors = array();
        if ( isset( $_REQUEST['login'] ) ) {
            $error_codes = explode( ',', $_REQUEST['login'] );

            foreach ( $error_codes as $code ) {
                $errors []= $this->get_error_message( $code );
            }
        }
        $attributes['errors'] = $errors;

        // Check if user just logged out
        $attributes['logged_out'] = isset( $_REQUEST['logged_out'] ) && $_REQUEST['logged_out'] == true;

        // Check if the user just registered
        $attributes['registered'] = isset( $_REQUEST['registered'] );

        // Check if the user just requested a new password
        $attributes['lost_password_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';

        // Check if user just updated password
        $attributes['password_updated'] = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';

        // Render the login form using an external template
        return $this->get_template_html( 'login_form', $attributes );
    }

    /**
     * A shortcode for rendering the new user registration form.
     *
     * @param  array   $attributes  Shortcode attributes.
     * @param  string  $content     The text content for shortcode. Not used.
     *
     * @return string  The shortcode output
     */
    public function render_register_form( $attributes, $content = null ) {
        // Parse shortcode attributes
        $default_attributes = array( 'show_title' => false );
        $attributes = shortcode_atts( $default_attributes, $attributes );

        if ( is_user_logged_in() ) {
            return __( 'You are already signed in.', 'personalize-login' );
        } elseif ( ! get_option( 'users_can_register' ) ) {
            return __( 'Registering new users is currently not allowed.', 'personalize-login' );
        } else {
            // Retrieve possible errors from request parameters
            $attributes['errors'] = array();
            if ( isset( $_REQUEST['register-errors'] ) ) {
                $error_codes = explode( ',', $_REQUEST['register-errors'] );

                foreach ( $error_codes as $error_code ) {
                    $attributes['errors'] []= $this->get_error_message( $error_code );
                }
            }

            // Retrieve recaptcha key
            $attributes['recaptcha_site_key'] = get_option( 'personalize-login-recaptcha-site-key', null );

            return $this->get_template_html( 'register_form', $attributes );
        }
    }

    /**
     * A shortcode for rendering the form used to initiate the password reset.
     *
     * @param  array   $attributes  Shortcode attributes.
     * @param  string  $content     The text content for shortcode. Not used.
     *
     * @return string  The shortcode output
     */
    public function render_password_lost_form( $attributes, $content = null ) {
        // Parse shortcode attributes
        $default_attributes = array( 'show_title' => false );
        $attributes = shortcode_atts( $default_attributes, $attributes );

        if ( is_user_logged_in() ) {
            return __( 'You are already signed in.', 'personalize-login' );
        } else {
            // Retrieve possible errors from request parameters
            $attributes['errors'] = array();
            if ( isset( $_REQUEST['errors'] ) ) {
                $error_codes = explode( ',', $_REQUEST['errors'] );

                foreach ( $error_codes as $error_code ) {
                    $attributes['errors'] []= $this->get_error_message( $error_code );
                }
            }

            return $this->get_template_html( 'password_lost_form', $attributes );
        }
    }

    /**
     * A shortcode for rendering the form used to reset a user's password.
     *
     * @param  array   $attributes  Shortcode attributes.
     * @param  string  $content     The text content for shortcode. Not used.
     *
     * @return string  The shortcode output
     */
    public function render_password_reset_form( $attributes, $content = null ) {
        // Parse shortcode attributes
        $default_attributes = array( 'show_title' => false );
        $attributes = shortcode_atts( $default_attributes, $attributes );

        if ( is_user_logged_in() ) {
            return __( 'You are already signed in.', 'personalize-login' );
        } else {
            if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
                $attributes['login'] = $_REQUEST['login'];
                $attributes['key'] = $_REQUEST['key'];

                // Error messages
                $errors = array();
                if ( isset( $_REQUEST['error'] ) ) {
                    $error_codes = explode( ',', $_REQUEST['error'] );

                    foreach ( $error_codes as $code ) {
                        $errors []= $this->get_error_message( $code );
                    }
                }
                $attributes['errors'] = $errors;

                return $this->get_template_html( 'password_reset_form', $attributes );
            } else {
                return __( 'Invalid password reset link.', 'personalize-login' );
            }
        }
    }

    /**
     * An action function used to include the reCAPTCHA JavaScript file
     * at the end of the page.
     */
    public function add_captcha_js_to_footer() {
        echo "<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>";
    }

    /**
     * Renders the contents of the given template to a string and returns it.
     *
     * @param string $template_name The name of the template to render (without .php)
     * @param array  $attributes    The PHP variables for the template
     *
     * @return string               The contents of the template.
     */
    private function get_template_html( $template_name, $attributes = null ) {
        if ( ! $attributes ) {
            $attributes = array();
        }

        ob_start();

        do_action( 'personalize_login_before_' . $template_name );

        require( 'templates/' . $template_name . '.php');

        do_action( 'personalize_login_after_' . $template_name );

        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }


    //
    // ACTION HANDLERS FOR FORMS IN FLOW
    //

    /**
     * Handles the registration of a new user.
     *
     * Used through the action hook "login_form_register" activated on wp-login.php
     * when accessed through the registration action.
     */
    public function do_register_user() {
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $redirect_url = home_url( 'member-register' );

            if ( ! get_option( 'users_can_register' ) ) {
                // Registration closed, display error
                $redirect_url = add_query_arg( 'register-errors', 'closed', $redirect_url );
            } elseif ( ! $this->verify_recaptcha() ) {
                // Recaptcha check failed, display error
                $redirect_url = add_query_arg( 'register-errors', 'captcha', $redirect_url );
            } else {
                $email = $_POST['email'];
                $first_name = sanitize_text_field( $_POST['first_name'] );
                $last_name = sanitize_text_field( $_POST['last_name'] );

                $result = $this->register_user( $email, $first_name, $last_name );

                if ( is_wp_error( $result ) ) {
                    // Parse errors into a string and append as parameter to redirect
                    $errors = join( ',', $result->get_error_codes() );
                    $redirect_url = add_query_arg( 'register-errors', $errors, $redirect_url );
                } else {
                    // Success, redirect to login page.
                    $redirect_url = home_url( 'member-login' );
                    $redirect_url = add_query_arg( 'registered', $email, $redirect_url );
                }
            }

            wp_redirect( $redirect_url );
            exit;
        }
    }

    /**
     * Initiates password reset.
     */
    public function do_password_lost() {
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $errors = retrieve_password();
            if ( is_wp_error( $errors ) ) {
                // Errors found
                $redirect_url = home_url( 'member-password-lost' );
                $redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
            } else {
                // Email sent
                $redirect_url = home_url( 'member-login' );
                $redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
                if ( ! empty( $_REQUEST['redirect_to'] ) ) {
                    $redirect_url = $_REQUEST['redirect_to'];
                }
            }

            wp_safe_redirect( $redirect_url );
            exit;
        }
    }

    /**
     * Resets the user's password if the password reset form was submitted.
     */
    public function do_password_reset() {
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $rp_key = $_REQUEST['rp_key'];
            $rp_login = $_REQUEST['rp_login'];

            $user = check_password_reset_key( $rp_key, $rp_login );

            if ( ! $user || is_wp_error( $user ) ) {
                if ( $user && $user->get_error_code() === 'expired_key' ) {
                    wp_redirect( home_url( 'member-login?login=expiredkey' ) );
                } else {
                    wp_redirect( home_url( 'member-login?login=invalidkey' ) );
                }
                exit;
            }

            if ( isset( $_POST['pass1'] ) ) {
                if ( $_POST['pass1'] != $_POST['pass2'] ) {
                    // Passwords don't match
                    $redirect_url = home_url( 'member-password-reset' );

                    $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                    $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                    $redirect_url = add_query_arg( 'error', 'password_reset_mismatch', $redirect_url );

                    wp_redirect( $redirect_url );
                    exit;
                }

                if ( empty( $_POST['pass1'] ) ) {
                    // Password is empty
                    $redirect_url = home_url( 'member-password-reset' );

                    $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                    $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                    $redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );

                    wp_redirect( $redirect_url );
                    exit;

                }

                // Parameter checks OK, reset password
                reset_password( $user, $_POST['pass1'] );
                wp_redirect( home_url( 'member-login?password=changed' ) );
            } else {
                echo "Invalid request.";
            }

            exit;
        }
    }


    //
    // OTHER CUSTOMIZATIONS
    //

    /**
     * Returns the message body for the password reset mail.
     * Called through the retrieve_password_message filter.
     *
     * @param string  $message    Default mail message.
     * @param string  $key        The activation key.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     *
     * @return string   The mail message to send.
     */
    public function replace_retrieve_password_message( $message, $key, $user_login, $user_data ) {
        // Create new message
        $msg  = __( 'Bonjour!', 'personalize-login' ) . "\r\n\r\n";
        $msg .= sprintf( __( 'Vous nous avez demandé de réinitialiser votre mot de passe pour votre compte à l\'aide de l\'adresse e-mail %s.', 'personalize-login' ), $user_login ) . "\r\n\r\n";
        $msg .= __( "S'il s'agit d'une erreur ou si vous n'avez pas demandé la réinitialisation du mot de passe, ignorez simplement cet e-mail et rien ne se passera.", 'personalize-login' ) . "\r\n\r\n";
        $msg .= __( 'Pour réinitialiser votre mot de passe, visitez l\'adresse suivante:', 'personalize-login' ) . "\r\n\r\n";
        $msg .= site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n\r\n";
        $msg .= __( 'Merci!!', 'personalize-login' ) . "\r\n";

        return $msg;
    }


    //
    // HELPER FUNCTIONS
    //

    /**
     * Validates and then completes the new user signup process if all went well.
     *
     * @param string $email         The new user's email address
     * @param string $first_name    The new user's first name
     * @param string $last_name     The new user's last name
     *
     * @return int|WP_Error         The id of the user that was created, or error if failed.
     */
    private function register_user( $email, $first_name, $last_name ) {
        $errors = new WP_Error();

        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        if ( ! is_email( $email ) ) {
            $errors->add( 'email', $this->get_error_message( 'email' ) );
            return $errors;
        }

        if ( username_exists( $email ) || email_exists( $email ) ) {
            $errors->add( 'email_exists', $this->get_error_message( 'email_exists') );
            return $errors;
        }

        // Generate the password so that the subscriber will have to check email...
        $password = wp_generate_password( 12, false );

        $user_data = array(
            'user_login'    => $email,
            'user_email'    => $email,
            'user_pass'     => $password,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'nickname'      => $first_name,
        );

        $user_id = wp_insert_user( $user_data );
        wp_new_user_notification( $user_id, $password );

        return $user_id;
    }

    /**
     * Checks that the reCAPTCHA parameter sent with the registration
     * request is valid.
     *
     * @return bool True if the CAPTCHA is OK, otherwise false.
     */
    private function verify_recaptcha() {
        // This field is set by the recaptcha widget if check is successful
        if ( isset ( $_POST['g-recaptcha-response'] ) ) {
            $captcha_response = $_POST['g-recaptcha-response'];
        } else {
            return false;
        }

        // Verify the captcha response from Google
        $response = wp_remote_post(
            'https://www.google.com/recaptcha/api/siteverify',
            array(
                'body' => array(
                    'secret' => get_option( 'personalize-login-recaptcha-secret-key' ),
                    'response' => $captcha_response
                )
            )
        );

        $success = false;
        if ( $response && is_array( $response ) ) {
            $decoded_response = json_decode( $response['body'] );
            $success = $decoded_response->success;
        }

        return $success;
    }

    /**
     * Redirects the user to the correct page depending on whether he / she
     * is an admin or not.
     *
     * @param string $redirect_to   An optional redirect_to URL for admin users
     */
    private function redirect_logged_in_user( $redirect_to = null ) {
        $user = wp_get_current_user();
        if ( user_can( $user, 'manage_options' ) ) {
            if ( $redirect_to ) {
                wp_safe_redirect( $redirect_to );
            } else {
                wp_redirect( admin_url() );
            }
        } else {
            wp_redirect( home_url( 'member-account' ) );
        }
    }

    /**
     * Finds and returns a matching error message for the given error code.
     *
     * @param string $error_code    The error code to look up.
     *
     * @return string               An error message.
     */
    private function get_error_message( $error_code ) {
        switch ( $error_code ) {
            // Login errors

            case 'empty_username':
                return __( 'You do have an email address, right?', 'personalize-login' );

            case 'empty_password':
                return __( 'You need to enter a password to login.', 'personalize-login' );

            case 'invalid_username':
                return __(
                    "We don't have any users with that email address. Maybe you used a different one when signing up?",
                    'personalize-login'
                );

            case 'incorrect_password':
                $err = __(
                    "The password you entered wasn't quite right. <a href='%s'>Did you forget your password</a>?",
                    'personalize-login'
                );
                return sprintf( $err, wp_lostpassword_url() );

            // Registration errors

            case 'email':
                return __( 'The email address you entered is not valid.', 'personalize-login' );

            case 'email_exists':
                return __( 'An account exists with this email address.', 'personalize-login' );

            case 'closed':
                return __( 'Registering new users is currently not allowed.', 'personalize-login' );

            case 'captcha':
                return __( 'The Google reCAPTCHA check failed. Are you a robot?', 'personalize-login' );

            // Lost password

            case 'empty_username':
                return __( 'You need to enter your email address to continue.', 'personalize-login' );

            case 'invalid_email':
            case 'invalidcombo':
                return __( 'There are no users registered with this email address.', 'personalize-login' );

            // Reset password

            case 'expiredkey':
            case 'invalidkey':
                return __( 'Le lien de réinitialisation du mot de passe que vous avez utilisé n\'est plus valide.', 'personalize-login' );

            case 'password_reset_mismatch':
                return __( "Les deux mots de passe que vous avez saisis ne correspondent pas.", 'personalize-login' );

            case 'password_reset_empty':
                return __( "Désolé, nous n'acceptons pas les mots de passe vides.", 'personalize-login' );

            default:
                break;
        }

        return __( 'Une erreur inconnue s\'est produite. Veuillez réessayer plus tard.', 'personalize-login' );
    }


    //
    // PLUGIN SETUP
    //

    /**
     * Registers the settings fields needed by the plugin.
     */
    public function register_settings_fields() {
        // Create settings fields for the two keys used by reCAPTCHA
        register_setting( 'general', 'personalize-login-recaptcha-site-key' );
        register_setting( 'general', 'personalize-login-recaptcha-secret-key' );

        add_settings_field(
            'personalize-login-recaptcha-site-key',
            '<label for="personalize-login-recaptcha-site-key">' . __( 'reCAPTCHA site key' , 'personalize-login' ) . '</label>',
            array( $this, 'render_recaptcha_site_key_field' ),
            'general'
        );

        add_settings_field(
            'personalize-login-recaptcha-secret-key',
            '<label for="personalize-login-recaptcha-secret-key">' . __( 'reCAPTCHA secret key' , 'personalize-login' ) . '</label>',
            array( $this, 'render_recaptcha_secret_key_field' ),
            'general'
        );
    }

    public function render_recaptcha_site_key_field() {
        $value = get_option( 'personalize-login-recaptcha-site-key', '' );
        echo '<input type="text" id="personalize-login-recaptcha-site-key" name="personalize-login-recaptcha-site-key" value="' . esc_attr( $value ) . '" />';
    }

    public function render_recaptcha_secret_key_field() {
        $value = get_option( 'personalize-login-recaptcha-secret-key', '' );
        echo '<input type="text" id="personalize-login-recaptcha-secret-key" name="personalize-login-recaptcha-secret-key" value="' . esc_attr( $value ) . '" />';
    }

}

// Initialize the plugin
$personalize_login_pages_plugin = new Personalize_Login_Plugin();

// Create the custom pages at plugin activation
register_activation_hook( __FILE__, array( 'Personalize_Login_Plugin', 'plugin_activated' ) );