<?php

/*
 * example3.php
 * Booleans
 * Define DEBUG as a boolean, and print our status. 
 * Change TRUE to FALSE to change the output message.
 *
 */

define("DEBUG", TRUE);
if (DEBUG) {
    echo 'We are in Debug mode';
} else {
    echo 'We are not in Debug mode';
}