<?php
/**
 * Created by PhpStorm.
 * User: mzb
 * Date: 16/11/2020
 * Time: 13:52
 */

namespace Inc\Base;


class AddKeysGravity extends UserContactChamps{
    public function __construct()
    {
        add_action('gform_user_registration_add_option_group', [$this, 'add_custom_group'], 10, 3);
        add_filter('gform_user_registration_user_meta_options', [ $this, 'add_keys'], 10, 1);

    }



    /**
     * @param $keys
     * @return array
     */

    public function add_keys($keys)
    {
        $array = get_option('loki_gestion_gravity');

        $extra_fields = $array['loki_group'];

        if(is_array($extra_fields)):
        foreach ($extra_fields as  $value) {
            $keys[]= array(
                'name'=> $value['title'],
                'label'=>$value['label'],
                'required'=> false);
        }
        endif;

        return $keys;
    }

    /**
     * @param $config
     * @param $form
     * @param $is_validation_error
     */
    public function add_multisite_section($config, $form, $is_validation_error)
    {
        ?>

        <div class="margin_vertical_10">
            <label class="left_header"><?php _e("Send Email?", "gravityformsuserregistration"); ?>
                <?php gform_tooltip("user_registration_notification") ?></label>
            <input type="checkbox" id="gf_user_registration_notification" name="gf_user_registration_notification" value="1" <?php echo ($config["meta"]["notification"] == 1 || !isset($config["meta"]["notification"])) ? "checked='checked'" : ""?> />
            <label for="gf_user_registration_notification" class="checkbox-label"><?php _e("Send this password to the new user by email.", "gravityformsuserregistration"); ?></label>
        </div> <!-- / send email? -->

        <?php
    }


}