<?php
namespace Core;

class View
{

    public static function show($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = "../App/views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("View ".$file." is not found");
        }
    }
}