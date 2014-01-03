<?php

/*
 * 
 * mysql.inc
 * Contains MySQL functions for our CMS
 * 
 */

function mysql_select($sql) {

    $db = new mysqli(DBSERVER, DBUSER, DBPASSWORD, CMSDB);

    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    if (!$result = $db->query($sql)) {
        if (DEBUG) {
            die('There was an error running the query [' . $db->error . ']');
        } else {
            die('');
        }
    }

// Pass our results to an array to be returned 

    if(isset($result->num_rows)){

    $r = array();

    $r[] = $result->num_rows;    // No of rows returned
    $r[] = $db->field_count;     // No of columns in table
    $r[] = $db->affected_rows;   // No of rows affected e.g. update / delete
    
// Append the results to our result count

    if ($result->num_rows != 0) {

        $r = array_merge($r, $result->fetch_array(MYSQLI_ASSOC));
    }
    
    // Free the result

    $result->free();
    
    
	}else{
	
		$r = NULL;
		
	}

// Close the connection

    $db->close();

    return $r;
}

function mysql_fetchrows($sql) {

    // Returns an array of rows or NULL if no result

    $db = new mysqli(DBSERVER, DBUSER, DBPASSWORD, CMSDB);

    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    if (!$result = $db->query($sql)) {
        if (DEBUG) {
            die('There was an error running the query [' . $db->error . ']');
        } else {
            die('');
        }
    }

    while ($row = $result->fetch_row()) {
        $r[] = $row;
    }

	// Free the result

    $result->free();

	// Close the connection

    $db->close();

    if (isset($r)) {
        return $r;
    } else {
        return NULL;
    }
}

