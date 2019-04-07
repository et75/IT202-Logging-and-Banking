<?php	
session_set_cookie_params (0, "/~et75/");
session_start();	

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set( 'display_errors' , 1 );

include ( "functions.php");
include ( "account.php"  );

$db = mysqli_connect($hostname, $username, $password ,$project);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}
    
print "<br>Successfully connected to MySQL.<br>";
mysqli_select_db( $db, $project );

$user    = getdata ("user");
$pass    = getdata ("pass");
$delay   = getdata ("delay");

if ( !auth ($user, $pass)) {
	redirect ("redirecting to login", $delay, "login.html");
}

$_SESSION ["logged"] = true;
$_SESSION ["user"] = $user;
$_SESSION ["pass"] = $pass;

redirect ("redirecting to login", $delay, "form-transaction.php");
?>