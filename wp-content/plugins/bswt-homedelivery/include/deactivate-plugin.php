<?php
/**
 * @package homedelivery
 */

class DeactivatePlugin{

    public static function deactivate(){
        flush_rewrite_rules();
    }
}