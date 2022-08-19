<?php

/**
 * My personal global functions
 */
if (!function_exists('pt')) {
    /**
     * print_r for james
     * @param mixed $val 
     * @return void 
     */
    function pt($val)
    {
        return print_r($val, true) . PHP_EOL;
    }
}
