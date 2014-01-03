<?php 

// Check we are logged in

require_once 'includes/cms.inc';
require INCLUDES . 'content.inc';
require INCLUDES . 'core.inc';

ifnotloggedin();
phpinfo();
logoutform();
