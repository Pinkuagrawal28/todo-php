<?php

// No class, no namespace, just plain function
if (!function_exists('dd')) {
  /***
   * This is function is used to debug the code at any point
   * @params array arguements
   */
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