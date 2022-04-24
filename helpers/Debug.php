<?php

namespace App\Helpers;

class Debug {

    public static function pr($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

}

?>