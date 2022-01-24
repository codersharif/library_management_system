<?php

use Illuminate\Support\Facades\DB;

class Helper {

    //function for back same page after update,delete,cancel
    public static function queryPageStr($qpArr) {
        //link for same page after query
        $qpStr = '';
        if (!empty($qpArr)) {
            $qpStr .= '?';
            foreach ($qpArr as $key => $value) {
                if ($value != '') {
                    $qpStr .= $key . '=' . $value . '&';
                }
            }
            $qpStr = trim($qpStr, '&');
            return $qpStr;
        }
    }

    public static function currentPath($path) {
        return Request::path() === $path ? 'active_link' : '';
    }

    public static function menuOpen($path) {
        if (Request::path() === $path) {
            $open = 'menu-open';
        } else {
            $open = '';
        }

        return $open;
    }
    
     public static function formatDateTime($dateTime = '0000-00-00 00:00:00') {
        return date('d F Y h:i A', strtotime($dateTime));
    }

}
