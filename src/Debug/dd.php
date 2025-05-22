<?php

// No class, no namespace, just plain function
if (!function_exists('dd')) {
    function dd(...$args)
    {
        echo "<pre>";
        foreach ($args as $arg) {
            var_dump($arg);
        }
        echo "</pre>";
        die;
    }
}