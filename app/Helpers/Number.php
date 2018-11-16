<?php

function removeMask($string)
{
    if(is_numeric($string))
    {
        return $string;
    }
    else
    {
        if(mb_substr_count($string, ','))
        {
            $clean = preg_replace('/[^\d|,]/', '', $string);

            return preg_replace('/,/', '.', $clean);
        }
        else
        {
            return preg_replace('/[^\d]/', '', $string);
        }
    }
}