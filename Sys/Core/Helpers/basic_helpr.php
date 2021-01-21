<?php

/* 
 * some basic function for the system
 */

if(!function_exists('redirectTo'))
{
    function redirectTo(string $urlPart='')
    {
        if(!empty($urlPart))
        {
            header('Location: '.BASEURL.'/'.$urlPart);
            die();
        }
        else
        {
            header('Location: '.BASEURL);
            die();
        }
    }
}