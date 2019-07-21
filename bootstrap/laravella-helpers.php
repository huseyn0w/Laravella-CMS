<?php
/**
 * Laravella CMS
 * File: laravella-helpers.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 22.07.2019
 */

function get_front_templates_array():array
{
    $folders_array = [];

    $dir = public_path().'\front';
    $array= scandir($dir);

    if($array)
    {
        unset($array[0]);
        unset($array[1]);
        $folders_array = $array;
    }

    return $folders_array;
}