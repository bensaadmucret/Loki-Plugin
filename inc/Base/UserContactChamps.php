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
     * @return array string  retourne un tableau avec l'ensembe des titres et des labels.
     */
    protected function get_list_champs()    {
        $list_champs = get_option('loki_gestion_gravity');
        if (is_array($list_champs)):
            foreach ($list_champs as  $extra_fields):
                return  $extra_fields;
            endforeach;
        endif;
    }

    /**
     * @param $user_contactmethods
     * @return array string
*/
    public function lokin_add_user_contactmethods($user_contactmethods)
    {


        $extra_fields = $this->get_list_champs();

        for ($i=0, $iMax = count($extra_fields); $i < $iMax; $i++) {
            foreach ($extra_fields[$i] as $field) {
                $user_contactmethods [ $field ] = $field;
            }
        }
        return $user_contactmethods;
    }

}