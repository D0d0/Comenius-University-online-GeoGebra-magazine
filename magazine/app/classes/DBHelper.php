<?php

/**
 * Description of DBHelper
 *
 * @author Jozef
 */
class DBHelper {

    public static function strip_like($string, $escape_char = '\\') {
        return str_replace(
                array($escape_char, '_', '%'), array($escape_char . $escape_char, $escape_char . '_', $escape_char . '%'), $string
        );
    }

}
