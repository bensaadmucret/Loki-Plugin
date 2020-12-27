<?php


namespace Inc\Base;


class RegisterShortcode
{
    public function __construct ()
    {
        add_shortcode( 'inscription', [$this, 'register_action_form' ]);
        add_shortcode( 'signin', [$this, 'login_action_form' ]);


    }


    public function register_action_form() {


        if ( is_user_logged_in() ) {
            return;
        }else{
            ob_start();
            $key = get_option("loki_gestion_gravity");
            if ($key['id_inscription']) {
                echo do_shortcode('[gravityform id="'.$key['id_inscription'].'" title="false" description="false"]');
            }
            ob_get_flush();
        }


    }

    public function login_action_form(){
        ob_start();
        echo $this->is_user_active();
        echo do_shortcode(' [gravityform action="login"  description="false" logged_in_message="Vous êtes déjà connecté!" registration_link_text="Inscription" forgot_password_text="mot de passe oublié pas de panique cliqué ici 👍" /]');
        ob_get_flush();

    }


    private function is_user_active(){
        if (is_user_logged_in()){
            ob_start();
            echo '<div class="container" style="margin: 10px;">';
            echo '<div class="row">';
            echo '<div class="col">';
           // echo '<h3>Vous etes déjà connecté</h3> </br>';
            echo '<a href="'. wp_logout_url( home_url()).'><i class="fas fa-sign-out-alt"></i><button class="btn btn-info btn-lg"> Déconnexion</button> </a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            ob_get_flush();
        }

    }









}