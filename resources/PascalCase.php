<?php
function PascalCase($string) {
    $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    $str[0] = strtoupper($str[0]);
    return $str;
}