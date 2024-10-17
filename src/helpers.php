<?php

if (!function_exists('ping')) {
    function ping(...$args)
    {
        $argsCount = count($args);

        if ($argsCount > 2) {
            throw new \InvalidArgumentException('Too many arguments');
        }

        if ($argsCount === 0) {
            throw new \InvalidArgumentException('Missing arguments');
        }

        if ($argsCount === 1) {
            \Ping2Me\Php\Ping::make()->send($args[0]);
            return;
        }

       \Ping2Me\Php\Ping::make()->to($args[0])->send($args[1]);
    }
}