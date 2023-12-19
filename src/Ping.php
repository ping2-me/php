<?php

namespace Ping2Me\Php;

class Ping
{
    public static $endpoint;

    public static $debug = false;

    /**
     * @param string|null $endpoint
     */
    public function __construct($endpoint = null)
    {
        if ($endpoint) {
            static::$endpoint = $endpoint;
        }
    }

    /**
     * @param string|null $endpoint
     * @return static
     */
    public static function make($endpoint = null)
    {
        return new static($endpoint);
    }

    /**
     * @param string $endpoint
     * @return static
     */
    public function to($endpoint)
    {
        static::$endpoint = $endpoint;

        return $this;
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
            if (!static::$endpoint) {
                throw new \InvalidArgumentException('Please set up and endpoint first.');
            }

            if (function_exists('shell_exec') && !empty(shell_exec('which curl'))) {
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
        // post as raw data
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: text/plain']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);

        curl_exec($curl);
        curl_close($curl);
    }

    public static function cli($payload)
    {
        $endpoint = static::$endpoint;

        `curl -X POST -H 'Content-Type: text/plain' -d '$payload' https://ping2.me/$endpoint > /dev/null 2>&1 &`;
    }
}