<?php
/**
 * @package homedelivery
 */

class ActivatePlugin{

    public static function activate(){
        flush_rewrite_rules();
    }
}