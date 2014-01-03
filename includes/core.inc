<?php

/*
 * 
 * core.inc
 * Contains core functions for our CMS
 * 
 */

function buildpage($request) {

    // Content definitions
    require INCLUDES . 'content.inc';

    // Routes our incoming request to the right content type and pulls
    // the content from out DB. 

    $content_type = $request[0];
    $id = $request[1];
    $template_file = TEMPLATES . $content_type . '_template.inc';

    // Build the SQL and get the result

    $sql = "SELECT * FROM $content_type WHERE id='$id' AND status > 0 LIMIT 1";
    $result = mysql_select($sql);

    // Check we have some content to display

    if ($result[0] == 0) {

        echo 'No data';
        return;
    }

    // Check we have a template file

    if (!file_exists($template_file)) {

        echo 'No template';
        return;
    }

    // Don't write any output to browser yet as we want to post process
    // our content using a theme. If enabled use our optimization 
    // callback to remove white space etc.

    ob_start("optimize_callback");

    // Output our page header

    outfile(TEMPLATES . 'header.inc');

    // Create our body 

    echo wraptag('title', $result['title']);
    echo HEAD;
    echo BODY;
    
    echo "<script>preinit();</script>";
    echo "<script>globalmenu();</script>";
    
    // Generate a unique ID based on content type
    // Map the requested content type from our real table name

    $ct = array_search($content_type, $content_tables);

    echo '<div id="' . $ct . '">';

    // If we are in debug mode, show an alert

    if (DEBUG) {

        $theme['debug'] = div('&para;', '', 'debug');
    }

    // Dump the title & id out to our theme template

    $theme['id'] = $result['id'];
    $theme['title'] = $result['title'];

    // As we don't know how many fields we will have in our content 
    // type after our id, iterate through each in turn and wrap with 
    // the field with a div

    $offset = $result[1]-1;
    $pos = 0;

    foreach ($result as $key => $value) {

        if ($pos >= $offset) {

            $theme[$key] = div($result[$key], $key . '-' . $id, $key);
        }

        $pos++;
    }

    // Add our standard copyright notice

    $theme['licence'] = div(ahref(COPYRIGHT, LICENCE, 'Copyright and licence details'), '', 'licence');

    // Include our template file

    require_once($template_file);

    // Close our content type tag

    echo '</div>';

    // Include our footer template

    require_once(TEMPLATES . FOOTERTEMPLATE);

    // Output our HTML page footer
    
    outfile(TEMPLATES . 'footer.inc');

    // Flush it all out and display
    
    echo "<script>postinit();</script>";

    ob_end_flush();
}

function outfile($file) {

    // Outputs template file to browser e.g header, footer, licence etc.

    $fh = fopen($file, 'r');

    while (!feof($fh)) {
        echo fgets($fh);
    }

    fclose($fh);
}

function parse_request($URI) {

    // Content definitions
    require_once INCLUDES . 'content.inc';

    // Returns the type of content and the ID
    // of the content requested.
    // parse_request(/page/1) 
    // $array['page'][1]
    // parse_request(/rubbish/123456)
    // NULL
    // Content definitions
    require_once INCLUDES . 'content.inc';

    $ct = NULL;
    $id = NULL;
    $valid = 0;

    // Fetch the parameters from the URL

    $array = explode('/', $URI);

    // We don't need the the first '/' - delete the first empty 
    // array item

    $a = array_shift($array);

    // Check we have 2 parameters passed

    $paramcount = count($array);

    if ($paramcount == 2) {

        // First test passed - We have 2 parameters

        $valid++;

        $ct = $array[0];
        $id = $array[1];
    }


    if (in_array($ct, $content_types)) {

        // If content type matches our list second test passed

        $valid++;

        // Map the requested content type to our real table name

        $array[0] = $content_tables[$ct];
    }

    if (is_numeric($id)) {

        // If ID is a number, third test passed

        $valid++;
    }

    if ($valid == 3) {

        // Valid parameters passed, return content type and page ID 

        return $array;
    } else {

        // Test failed - return NULL

        return NULL;
    }
}

function optimize_callback($buffer) {

    // replace all spaces between tags

    if (OPTIMIZE) {

        $b = preg_replace('~>\s+<~', '><', $buffer);
        $b = preg_replace('/\r\n|\r|\n/', '', $b);
        $b = preg_replace('!\s+!', ' ', $b);

        return $b;
        
    } else {
        
        return $buffer;
    }
}

function arraytolinks($mysqlfetchrows){
    
    require INCLUDES . 'content.inc';
    
    // Convert a MySQL result set into a set of links
    // Requires ID (page id) title and contenttype
    
    $links = '<div class="menulinks">';
    $links .= '<ul>';
    
    if($mysqlfetchrows){
    
    foreach ($mysqlfetchrows as $key => $value) {
        
        // Convert the content type to the relevant table name.
        // See content.inc
        
        $path = array_search($value[2], $content_tables); 
        
        $links .= '<li><a href="/'.$path.'/'.$value[0].'" title="'.$value[1].'">'.$value[1].'</a></li>';  
        
    }
    
    $links .= '</ul>';
    $links .= '</div>';
    
    }else{
        
        $links .= "<li>Sorry - no content available</li></ul></div>";
        
    }
    
    return $links;
}

function logoutform($forcelogout = 0){

  // Check if user is logged in, if so display the logout button.

  require_once 'includes/login.inc';

  if(isset($_COOKIE[KEYNAME]) || $forcelogout == 1){

    echo '<div id="logout">';
    echo '<form action="login.php" method="post">';
    echo '<input type="submit" value="logout">';
    echo '<input type="hidden" name="action" value="logout">';
    echo '</form>';	
    echo '</div>';

  }	
	
}

function ifnotloggedin(){

  // Check if user is logged in, if not, redirect to login form

  require_once 'includes/login.inc';

  if(!isset($_COOKIE[KEYNAME])){
	
	header( 'Location: http://'.CMSDOMAIN.'/login.php' ) ;	
	  
  }	
	
}

function loginsecurity(){

  require INCLUDES . 'sqlstatements.inc';

  // Get client IP address
	
  $ip =  $_SERVER["REMOTE_ADDR"];

  if(isset($_POST["email"])){
	  
	// email will always be set, check if it is populated  
	  
	if($_POST["email"] !== ''){  
	
		// Ban 'em
		
		banip($ip, 'login.php');
	
	}	
	
  }else{

    // Check that they have not been flagged as suspicious
	
	$s = $sql[1];
	$s = str_replace ( '---P0---' , $ip , $s );

	$result = mysql_fetchrows($s);	
	
	if($result){
	
	  foreach($result as $row){

		$status = $row[0];
		
	  }
	
	}else{
	
		$status = 0;
		
	}
	
	// Redirect to our honeypost if status is set
	
	if($status !== 0){
		
		header( 'Location: http://' . HONEYPOT ) ;
		
	}	
	
  }	
	
}

function banip($ip, $page){

  require INCLUDES . 'sqlstatements.inc';

	  // Add to our banlist
	
	  $s = $sql[0];
	  $s = str_replace ( '---P0---' , $ip , $s );
	  $s = str_replace ( '---P1---' , $page , $s );
	  $s = str_replace ( '---P2---' , 1 , $s );
	
	  mysql_select($s);
	
	  // Redirect to our honeypot
	
	  header( 'Location: http://' . HONEYPOT ) ;
	
	
}

function logip($page){
	
	  require INCLUDES . 'sqlstatements.inc';

	  // Just log a visit
	  
	  $ip =  $_SERVER["REMOTE_ADDR"];
	
	  $s = $sql[0];
	  $s = str_replace ( '---P0---' , $ip , $s );
	  $s = str_replace ( '---P1---' , $page , $s );
	  $s = str_replace ( '---P2---' , 0 , $s );
	
	  mysql_select($s);
	
}
