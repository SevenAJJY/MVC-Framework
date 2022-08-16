<?php

namespace SEVENAJJY\Library;

trait Redirection
{
    /**
     * @param mixed $path
     * @return never
     */
    public function redirect($path)
    {
        session_write_close();
        header('location: '. $path);
        exit;
    }

    /**
     * It is used to return the user to the same page he was on when a certain error
     * 
     * @param mixed $path
     * @return never
     */
    public function redirectBack($path)
    {
        session_write_close();
        if (array_key_exists("HTTP_REFERER",$_SERVER)) {
            $path = $_SERVER["HTTP_REFERER"] ;
        }
        header("location: ".$path);
        exit();
    }
}