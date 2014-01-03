<?php

/*
 * index.php
 * Index page for FreeBSD CMS
 * 
 */

// Get required files

// Our global settings - Note need full path
require_once 'includes/cms.inc';
// Core functions
require_once INCLUDES.'core.inc';
// HTML functions
require_once INCLUDES.'html.inc';
// MySQL functions
require_once INCLUDES.'mysql.inc';
// Menu functions
require_once INCLUDES.'menu.inc';

// Turn full debug functionality on if enabled

if(DEBUG){
    
    // Turn on full PHP error reporting
    error_reporting(E_ALL);
    
}else{
    
    // Hide all error messages
    error_reporting(0);
    
}

// First we need to parse the URL that was passed to us to extract the
// id and the content type.

$URI = $_SERVER['REQUEST_URI'];

if($URI == '/'){
    
    // If this is a request to root (/) redirect to page 1
    
    $request = array('pages',1);
    buildpage($request);
    
}else{
    
    // Parse the request, if it is valid get the content from our DB
    
    $request = parse_request($URI);
    
    if(!is_null($request)){
        
        buildpage($request);
        
    }else{
        
        //echo "Invalid request";   
    }
    
}
