<?php
/**
 * Created by PhpStorm.
 * User: mzb
 * Date: 16/11/2020
 * Time: 12:49
 */

namespace Inc\Base;


class loginRedirectUrl
{
    public function __construct() {

        add_filter('gform_user_registration_login_redirect_url',[$this,'url_function_redirection' ] , 10, 2);


    }

    function url_function_redirection($login_redirect, $sign_on)
    {

        return $this->get_login_redirect_url();

    }

    /**
     * @return string url
     */
    private function get_login_redirect_url(){
        $url_redirect = get_option("loki_gestion_gravity");
        if (is_array($url_redirect) || is_object($url_redirect)):
            $login_redirect = esc_url($url_redirect[ "url_redirect"]);
        endif;
        return $login_redirect;
    }








}
