<?php
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\TestimonialCallbacks;

/**
 *
 */
class EtapeController extends BaseController
{
    public $settings;

    public $callbacks;

    public function register()
    {
        if ( ! $this->activated( 'step_manager' ) ) return;

        $this->settings = new SettingsApi();

        $this->callbacks = new TestimonialCallbacks();

        add_action( 'init', array( $this, 'testimonial_cpt' ) );
        add_action( 'cmb2_admin_init', array( $this, 'add_meta_boxes' ) );
        //add_action( 'save_post', array( $this, 'save_meta_box' ) );
        add_action( 'manage_testimonial_posts_columns', array( $this, 'set_custom_columns' ) );
        add_action( 'manage_testimonial_posts_custom_column', array( $this, 'set_custom_columns_data' ), 10, 2 );
        add_filter( 'manage_edit-testimonial_sortable_columns', array( $this, 'set_custom_columns_sortable' ) );

        $this->setShortcodePage();

        add_shortcode( 'loki-video', array( $this, 'loki_video' ) );
        add_shortcode( 'testimonial-slideshow', array( $this, 'testimonial_slideshow' ) );

    }



    public function return_json($status)
    {
        $return = array(
            'status' => $status
        );
        wp_send_json($return);

        wp_die();
    }

    public function loki_video()
    {
        ob_start();
        echo "<link rel=\"stylesheet\" href=\"$this->plugin_url/assets/form.css\" type=\"text/css\" media=\"all\" />";
        require_once( "$this->plugin_path/templates/contact-form.php" );
        echo "<script src=\"$this->plugin_url/assets/form.js\"></script>";
        return ob_get_clean();
    }

    public function testimonial_slideshow()
    {
        ob_start();
        echo "<link rel=\"stylesheet\" href=\"$this->plugin_url/assets/slider.css\" type=\"text/css\" media=\"all\" />";
        require_once( "$this->plugin_path/templates/slider.php" );
        echo "<script src=\"$this->plugin_url/assets/slider.js\"></script>";
        return ob_get_clean();
    }

    public function setShortcodePage()
    {
        $subpage = array(
            array(
                'parent_slug' => 'edit.php?post_type=step',
                'page_title' => 'Shortcodes',
                'menu_title' => 'Shortcodes',
                'capability' => 'manage_options',
                'menu_slug' => 'loki_step_shortcode',
                'callback' => array( $this->callbacks, 'shortcodePage' )
            )
        );

        $this->settings->addSubPages( $subpage )->register();
    }

    public function testimonial_cpt ()
    {
        $labels = array(
            'name' => 'Step',
            'singular_name' => 'Step'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-testimonial',
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'supports' => array( 'title', 'editor' ),
            'show_in_rest' => true
        );

        register_post_type ( 'step', $args );
    }


    public function add_meta_boxes()
    {
        //methode;

    }

    public function set_custom_columns($columns)
    {
        $title = $columns['title'];
        $date = $columns['date'];
        unset( $columns['title'], $columns['date'] );

        $columns['name'] = 'Author Name';
        $columns['title'] = $title;
        $columns['approved'] = 'Approved';
        $columns['featured'] = 'Featured';
        $columns['date'] = $date;

        return $columns;
    }

    public function set_custom_columns_data($column, $post_id)
    {
        $data = get_post_meta( $post_id, '_loki_step_key', true );
        $name = isset($data['name']) ? $data['name'] : '';
        $email = isset($data['email']) ? $data['email'] : '';
        $approved = isset($data['approved']) && $data['approved'] === 1 ? '<strong>YES</strong>' : 'NO';
        $featured = isset($data['featured']) && $data['featured'] === 1 ? '<strong>YES</strong>' : 'NO';

        switch($column) {
            case 'name':
                echo '<strong>' . $name . '</strong><br/><a href="mailto:' . $email . '">' . $email . '</a>';
                break;

            case 'approved':
                echo $approved;
                break;

            case 'featured':
                echo $featured;
                break;
        }
    }

    public function set_custom_columns_sortable($columns)
    {
        $columns['name'] = 'name';
        $columns['approved'] = 'approved';
        $columns['featured'] = 'featured';

        return $columns;
    }
}