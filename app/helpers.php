<?php


if (!function_exists('is_even')) {
    function is_even($number)
    {
        return $number % 2 == 0;
    }
}
