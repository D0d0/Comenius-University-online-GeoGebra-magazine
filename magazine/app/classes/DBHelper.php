<?php

/**
 * Description of DBHelper
 *
 * @author Jozef
 */
class DBHelper {

    public static function prepare_like($string, $escape_char = '\\') {
        return '\'%' . strtolower(str_replace(
                                array($escape_char, '_', '%'), array($escape_char . $escape_char, $escape_char . '_', $escape_char . '%'), $string
                )) . '%\'';
    }

}
