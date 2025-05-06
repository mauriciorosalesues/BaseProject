<?php

if (!function_exists('numberToWordsFormat')) {
    function numberToWordsFormat($number)
    {
        return number_format($number, 2, '.', ',');
    }
}   