<?php

include './vendor/autoload.php';

/**
 * ------------------------------------------------------------
 * This is the test file for the package.
 * ------------------------------------------------------------
 *
 * To test the package, run this file in your terminal:
 * `php test.php`
 *
 * Why we don't use PHPUnit? Because we want to test the package
 * in a real environment, not in a testing environment. And
 * the package is just so simple, so we don't want to do
 *
 */

\Ping2Me\Php\Ping::$endpoint = '@daudau/debug';

ping('function working!');