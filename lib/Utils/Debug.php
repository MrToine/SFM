<?php

namespace SFM\Utils;

class Debug {

    public static function dump($data) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

    public static function dd($data) {
        static::dump($data);
        die();
    }
}