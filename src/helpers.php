<?php

if (!function_exists('ping')) {
    function ping($message)
    {
        \Ping2Me\Php\Ping::make()->send($message);
    }
}