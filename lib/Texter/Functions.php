<?php

use Texter\Suite;
use Texter\Error;

function describe($name, callable $callback, $provider = null)
{
    if (is_null($provider)) {
        try {
            Suite::$parameters = [];
            Suite::$describeCount++;
            call_user_func($callback);
        } catch (\PHPUnit_Framework_Exception $e) {
            Suite::appendError(new Error($name, $e));
        }
    } else {
        foreach ($provider as $providerItem) {
            try {
                Suite::$parameters = $providerItem;
                Suite::$describeCount++;
                call_user_func_array($callback, $providerItem);
            } catch (\PHPUnit_Framework_Exception $e) {
                Suite::appendError(new Error($name, $e));
            }
        }
    }
}