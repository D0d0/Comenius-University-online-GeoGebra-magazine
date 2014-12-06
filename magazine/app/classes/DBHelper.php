<?php

/**
 * Description of DBHelper
 *
 * @author Jozef
 */
class DBHelper {

    public static function prepared_like($string, $escape_char = '\\') {
        return DB::connection()
                        ->getPdo()
                        ->quote('%' . strtolower(str_replace(
                                                array($escape_char, '_', '%'), array($escape_char . $escape_char, $escape_char . '_', $escape_char . '%'), $string
                                )) . '%');
    }

}
