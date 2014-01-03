<?php

/*
 * example8.php
 * Demonstration of operator precedence
 * 
 */

define("BR", '<br />');

$a = 1 + 5 * 3;
$b = (1 + 5) * 3;

echo '$a will evaluate to 16: ' . $a . BR;
echo '$b will evaluate to 18: ' . $b . BR;