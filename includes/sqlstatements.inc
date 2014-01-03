<?php

/*
 * 
 * sqlstatements.inc
 * Contains CMS SQL statements
 * 
 */

$sql[0] = "INSERT INTO `access` (`ipaddress`, `page`, `status`, `timestamp`)
		   VALUES ('---P0---', ('---P1---'), '---P2---', now());";
		   
$sql[1] = "SELECT status FROM access 
           WHERE ipaddress = '---P0---'
           AND status > 0
           LIMIT 1";
	   
