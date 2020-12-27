<?php 
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

use Inc\Base\BaseController;

/**
* 
*/
class AuthController extends BaseController
{
	public function register()
	{
		if ( ! $this->activated( 'login_manager' ) ) return;

		//add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		//add_action( 'wp_head', array( $this, 'add_auth_template' ) );
        //add_shortcode('update_registration',array( $this, 'update_registration') );
	}

	public function enqueue()
	{
		//wp_enqueue_style( 'authstyle', $this->plugin_url . 'assets/auth.css' );
		//wp_enqueue_script( 'authscript', $this->plugin_url . 'assets/auth.js' );

	}

	public function add_auth_template()
	{
		if ( is_user_logged_in() ) return;

		$file = $this->plugin_path . 'templates/auth.php';

		if ( file_exists( $file ) ) {
			load_template( $file, true );
		}
	}

    /**
     * @return void || formulaire update
     */
    public function update_registration()
    {
        if (is_user_logged_in()) {?>

            <div class="float-left">
                <a href="<?php echo wp_logout_url( home_url() ); ?>">
                    <button>SE DECONNECTER</button></a>
            </div>
            <?php $key = get_option("loki_gestion_gravity");
            if ($key['id_update']) {
                echo do_shortcode('[gravityform id="'.$key['id_update'].'" title="false" description="false"]');
            }
        } else {
            echo do_shortcode(' [gravityform action="login"  description="false" logged_in_message="Vous êtes déjà connecté!" registration_link_text="Register for my super awesome site" forgot_password_text="mot de passe oublié pas de panique cliqué ici 👍" /]');
        }
    }
}