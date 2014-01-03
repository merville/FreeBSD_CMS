<?php

require_once 'includes/cms.inc';
require INCLUDES . 'content.inc';
require INCLUDES . 'core.inc';
require INCLUDES . 'html.inc';
require INCLUDES . 'mysql.inc';
require INCLUDES . 'login.inc';

// SQL statements

$sql[0] = "SELECT password,auth FROM login 
           WHERE username = '---P0---'
           AND password = '---P1---';";
$sql[1] = "INSERT INTO `login` (`username`, `password`, `auth`, `timestamp`)
		   VALUES ('---P0---', ('---P1---'), '---P2---', now());";



///////////////////////////////////////////////////
///////////////////////////////////////////////////
///////////////////////////////////////////////////

// Delete after first run

if(!isset($_POST["action"])){
	
	//createnewlogin();
	
}

// Page control logic

if(isset($_POST["action"])){
    
    $action = $_POST["action"];
    
    if($action == "validatelogin"){
	
		if(isset($_POST["username"]) && isset($_POST["password"])){
		
			$username = $_POST["username"];
			$password = $_POST["password"];
			
			// We have valid credentials, validate
			
			validatelogin($username, $password,$sql);	
			
		}
		
	}elseif($action == "createnewlogin"){
		
		if(!isset($_COOKIE[KEYNAME])){

			// Create a new login to the system
			
			createnewlogin($username, $password,$sql);

		}else{
		
			// User failed cookie test, request them to login
			
			requestlogindetails();
		}
		
	}elseif($action == "appendnewlogin"){	
		
		$username = $_POST["username"];
		$password = $_POST["password"];		
		$auth = $_POST["auth"];		
		
		appendnewlogin($username,$password,$auth,$sql);
				
	}elseif($action == "logout"){
		
		// Logout the user	
		
		logout();	

	}else{
		
		// Invalid action - request login details
		
		requestlogindetails();
	}

}else{

	// First visit to page

	requestlogindetails();
	
}

///////////////////////////////////////////////////
///////////////////////////////////////////////////
///////////////////////////////////////////////////

function validatelogin($username, $password, $sql){
	
	// Create a session to keep track of our login attempts
	
	session_start();

	// As the password is hashed and hopefully cannot be decrypted,
	// We need to usend the encrypted password
	
	$hashed_password = hash('whirlpool', $password); 
	
	// Fetch credentials from DB, if match create a login cookie
	
	$s = $sql[0];
	$s = str_replace ( '---P0---' , $username , $s );
	$s = str_replace ( '---P1---' , $hashed_password , $s );

	$result = mysql_fetchrows($s);	
	
	if($result){

	  foreach($result as $row){

		$auth = $row[1];
		
	  }
	
    }else{
	
	  $auth = 0;
		
	} 	

	if ($auth == 1) {
		
		// Log our sucessful login
		
		logip('login.php');
		
		// Reset our attempt count in case they login again
		
		unset($_SESSION['loginattempts']);
		
		//$_SESSION['loginattempts'] = 1;
					
		// Create auth cookie
			
		setcookie(KEYNAME, LOGINKEY, time()+3600, "/");
		
		// Display options
		
		$title = 'Welcome ' . $username;
		
		buildheader($title,1);
		echo wraptag("h1",$title);
		
		echo ahref('Add or amend content', '/amendcontent.php'); 
				
		buildfooter();
		
		
	}else{
		
		// Keep a track of the number of attempts we have made at logging in
		
		if(isset($_SESSION['loginattempts'])){

		  $_SESSION['loginattempts'] = $_SESSION['loginattempts']+1;

		}else{

		  $_SESSION['loginattempts'] = 1;

		}
		
		// If they have exceeded our limit, ban 'em
		
		if($_SESSION['loginattempts'] > 3){
		
		  $ip = $_SERVER["REMOTE_ADDR"];
		
		  banip($ip, 'login.php');
			
		}

		// Try again

		requestlogindetails();
		
	}	

}	

function createnewlogin(){
	
	$title = "Create new user";
	$class = "formcontrol";

	buildheader($title);
	echo wraptag("h1",$title);
	
	echo '<form action="login.php" method="post">';
	echo 'Username' . div('<input type="text" name="username">',$class);
	echo 'Password' . div('<input type="password" name="password">',$class);
	echo 'Auth' . div('<input type="text" name="auth">',$class);
	echo '<input type="submit" value="Submit">';
	echo '<input type="hidden" name="action" value="appendnewlogin">';
	echo '</form>';	

	buildfooter();
	
}

function appendnewlogin($username,$password,$auth,$sql){

	// Create a new entry in the login table

	$hashed_password = hash('whirlpool', $password); 
	
	$s = $sql[1];
	$s = str_replace ( '---P0---' , $username , $s );
	$s = str_replace ( '---P1---' , $hashed_password , $s );
	$s = str_replace ( '---P2---' , $auth , $s );
	
	mysql_select($s);

	requestlogindetails();

}

function requestlogindetails(){
	
	$title = "Please login";
	$class = "forminput";

	buildheader($title);
	
	echo wraptag("h1",$title);
		
	echo '<form action="login.php" method="post">';
	echo 'Username' . div('<input type="text" name="username">',$class);
	echo 'Password' . div('<input type="password" name="password">',$class);
	echo '' . div('<input type="text" name="email">','loginemail');
	echo '<input type="submit" value="Submit">';
	echo '<input type="hidden" name="action" value="validatelogin">';
	echo '</form>';

	buildfooter();	
	
	
}

function buildheader($title, $forcelogout = 0){

	// As cookies need to be set before any output is sent to the browser
	// use a function call to build the page header
		
	// Check we are not on the ban list and that we are not a spam robot
	
	loginsecurity();
	
	// Build the page up to the body tag

	outfile(TEMPLATES . 'header.inc');

	echo wraptag('title', $title);
	echo HEAD;
	echo BODY;
	logoutform($forcelogout);	
  
	echo '<div id="content">';
	echo '<div id="php">';
	
}

function buildfooter(){
	

echo '</div>';
echo '</div>';
echo '<div id="licence">';
echo '<a href="licence.txt" title="Copyright and licence details">Copyright &copy; 2013 Rob Somerville me@merville.co.uk</a>';
echo '</div>';	
	
}
             
function logout(){

  setcookie(KEYNAME, LOGINKEY, time()-3600, "/");
  echo "You have been logged out";	
	
}
