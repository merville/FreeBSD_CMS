<?php

/*
 * 
 * cmsinclude.inc
 * Contains default settings for our CMS
 * 
 */

// Our domain

define("CMSDOMAIN", '192.168.0.118');

// Honeypot for bad traffic

define("HONEYPOT", 'www.google.com');

// Set our timezone

date_default_timezone_set('Europe/London');

// Copyright details

define("LICENCE", 'licence.txt');
define("COPYRIGHT", 'Copyright &copy; 2013 Rob Somerville me@merville.co.uk');
define("COPYYEAR", date('Y'));
define("COPYAUTH", 'Rob Somervile');
define("COPYEMAIL", 'me@merville.co.uk');

// Version

define("VERSION", 'Version 1.0 not for production use');

// Mode - If DEBUG is set to true, show errors and debug info

define("DEBUG", true);

// Where to find our files

define("TEMPLATES", 'templates/');
define("INCLUDES", 'includes/');
define("SQL", 'sql/');

// HTML tags that are orphaned and not defined in our template files

define("BODY", '<body>');
define("HEAD", '</head>');

// MySQL details

define("DBSERVER", 'localhost');
define("DBUSER", 'bsduser');
define("DBPASSWORD", 'cmsdbpassword');
define("CMSDB", 'freebsdcms');

// Optimize output by removing white space between tags etc.

define("OPTIMIZE", false);

// Definition of our footer template

define("FOOTERTEMPLATE", 'footer_template.inc');





