<?php

if (!function_exists('get_setting')) {
    function get_setting($type)
    {
        $db = \Config\Database::connect();
        $row = $db->table('settings')->where('type', $type)->get()->getRow();
        return $row ? $row->description : '';
    }
}
