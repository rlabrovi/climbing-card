<?php

namespace ClimbingCard\Http;

class Controller
{
    /**
     * Abort HTTP request
     *
     * @param $code
     */
    public static function abort($code)
    {
        echo "Error: " . $code;
        die();
    }
}
