<?php

/*
 * example9.php
 * Demonstration of a function call
 * 
 */

// As BR is a constant, this is available to our function directly

define("BR", '<br />');

// $pi is not available to our function, we will need to access it by 
// other methods

$pi = 22 / 7;

echo "Circumference with a diameter 5: " . print_circ1(5);
echo "Circumference with a diameter 10: " . print_circ2(10,$pi);

function print_circ1($diameter) {

    // print_circ1() will display $pi * $diameter
    // Define $pi as a global variable

    global $pi;

    // As BR is a global constant we can access it directly
    // Return our result to the main body of the program

    return $pi * $diameter . BR;
}

function print_circ2($diameter, $pi) {

    // print_circ2() will display $pi * $diameter
    // As BR is a global constant and $pi has been passed to our
    // function we can access them directly.

    // Return our result to the main body of the program

    return $pi * $diameter . BR;
}