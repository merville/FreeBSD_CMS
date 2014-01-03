<?php

/*
 * example7.php
 * Arrays
 * All of these examples are functionally equivalent 
 *
 */

define("BR", '<br />');

// Define the array then print it out using the function print_r()
// Use BR to seperate each line

$array_1 = array(
    "0" => "FreeBSD",
    "1" => "OpenBSD",
    "2" => "NetBSD",
);

print_r($array_1);
echo BR;

$array_2 = [
    "0" => "FreeBSD",
    "1" => "OpenBSD",
    "2" => "NetBSD",
];

print_r($array_2);
echo BR;

// Arrays can use mixed key values - they do not have to start at 0

$array_3[5] = "FreeBSD";
$array_3["This is key 6"] = "OpenBSD";
$array_3[7] = "NetBSD";

print_r($array_3);
echo BR;

// Let PHP assign the key values

$array_4[] = "FreeBSD";
$array_4[] = "OpenBSD";
$array_4[] = "NetBSD";

print_r($array_4);
echo BR;