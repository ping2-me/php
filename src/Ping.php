<?php

namespace Ping2Me\Php;

class Ping
{
    public static $endpoint;

    public static $debug = false;

    public function __construct($endpoint)
    {
        static::$endpoint = $endpoint;
    }

    /**
     * @param string|array $message
     * @return void
     * @throws \Exception
     */
    public function send($message)
    {
        $payload = is_array($message) ? json_encode($message) : $message;

        try {
            if (function_exists('shell_exec')) {
                static::cli($payload);
            } else {
                static::http($payload);
            }
        } catch (\Exception $e) {
            if (static::$debug) {
                throw $e;
            }
        }
    }

    public static function http($payload)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://ping2.me/' . static::$endpoint);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);

        curl_exec($curl);
        curl_close($curl);
    }

    public static function cli($payload)
    {
        `curl -X POST -d '$payload' https://ping2me.test/@daudau/telegram > /dev/null 2>&1 &`;
    }
}