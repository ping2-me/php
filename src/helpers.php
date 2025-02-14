<?php

use Ping2Me\Php\Ping;

if (!function_exists('ping')) {
    function ping($payload, $to = null) {
        if ($to === null) {
            Ping::make()->send($payload);
            return;
        }

       Ping::make()->to($to)->send($payload);
    }
}