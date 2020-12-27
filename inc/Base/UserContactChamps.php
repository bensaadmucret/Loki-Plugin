<?php
/**
 * @package  LokiPlugin
 */

namespace Inc\Base;


class UserContactChamps
{
    public function __construct() {
        add_filter('user_contactmethods', [$this,'lokin_add_user_contactmethods']);
    }

       /**
     * @param $user_contactmethods
     * @return array string
*/
    public function lokin_add_user_contactmethods($user_contactmethods)
    {


        $array = get_option('loki_gestion_gravity');

        $extra_fields = $array['loki_group'];


        if(is_array($extra_fields)){
            for ($i=0, $iMax = count($extra_fields); $i < $iMax; $i++) {
                foreach ($extra_fields[$i] as $field) {
                    $user_contactmethods [ $field ] = $field;
                }
            }

        }


        return $user_contactmethods;
    }

}