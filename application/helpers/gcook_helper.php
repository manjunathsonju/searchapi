<?php

if (!defined('BASEPATH'))
    exit('Direct Access Denied');

if (!function_exists('debug')) {

    /**
     * Checks the value of Object/Array/Variable
     * @param type $_arr
     * @param type $_die
     * @param type $_v 
     */
    function debug($_arr = '', $_die = 0, $_v = 0) {
        echo '<br clear="all" />';
        echo "<pre style='color:red; font-family: verdana; font-size:10px; font-weight:bold'>";
        if ($_arr) {
            if ($_v)
                var_dump($_arr);
            else
                print_r($_arr);
        }
        else
            echo 'No Data Provided.';
        echo '</pre>';

        if ($_die)
            exit();
    }

}

function get_image_thumb($file_name) {
    return get_file_name($file_name) . '_' . 'thumb' . '.' . get_file_extension($file_name);
}

function get_file_name($file_name) {
    return $filename = current(explode(".", $file_name));
}

function get_file_extension($file_name) {
    return substr(strrchr($file_name, '.'), 1);
}

