<?php

function assistant()
{
    return ['a', 'e', 'i', 'o', 'u', 'com', 'da', 'de', 'di', 'do', 'du', 'das', 'des', 'dis', 'dos', 'dus'];
}

function checkAssistant($string)
{
    return in_array(mb_strtolower($string), assistant());
}

function trimAll($string)
{
    $clear = trim($string);

    if($clear){
        $split  = explode(' ', $clear);
        $trim   = array_map(function($item) {return trim($item);}, $split);
        $filter = array_filter($trim);

        return implode(' ', $filter);
    } else {
        return $clear;
    }
}

function upperFirst($string)
{
    $trimUnit    = trim($string);
    $lowerCase   = mb_strtolower($trimUnit);
    $letterFirst = mb_strtoupper(substr($lowerCase, 0, 1));
    $letterRest  = substr($lowerCase, 1);

    return $letterFirst.$letterRest;
}

function upperAll($string)
{
    return mb_strtoupper($string);
}

function lowerAll($string)
{
    return mb_strtolower($string);
}

function upperStart($string)
{
    $str = trimAll($string);

    return mb_convert_case($str, MB_CASE_TITLE, 'UTF-8');
}

function shortName($string)
{
    $trim  = trimAll($string);

    if($trim) {
        $split = explode(' ', $trim);

        if(count($split) > 1) {
            if(count($split) == 2) {
                return $trim;
            } else {
                if(checkAssistant($split[1]))
                {
                    return $split[0].' '.$split[1].' '.$split[2];
                } else {
                    return $split[0].' '.$split[1];
                }
            }
        } else {
            return $trim;
        }
    } else {
        return null;
    }
}

function firstName($string)
{
    $stringClean = trim($string);

    if(!empty($stringClean)) {
        $strinSplit = explode(' ', $stringClean);

        return reset($strinSplit);
    } else {
        return null;
    }
}