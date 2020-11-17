<?php


namespace Inc\Base;


class RegisterShortcode
{
    public function __construct ()
    {
        add_shortcode( 'inscription', [$this, 'register_action_form' ]);
    }


    public function register_action_form() {

        $this->is_user_active();
        if(is_user_logged_in()){
            return;
        }else{
            $key = get_option("loki_gestion_gravity");
            if ($key['id_inscription']) {
                echo do_shortcode('[gravityform id="'.$key['id_inscription'].'" title="false" description="false"]');
            }
        }


    }

    private function is_user_active(){

        if (is_user_logged_in()){
        echo 'Vous etes déjà connecté </br>';
        echo '<a href="#" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span><button class="pure-button pure-button-primary">Déconnexion</button> </a>';

        }

    }



}