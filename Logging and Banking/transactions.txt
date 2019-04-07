<?php
session_set_cookie_params (0, "/~et75/");
session_start();	

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set( 'display_errors' , 1 );
	

include (  "functions.php");
include (  "account.php"  );
gatekeeper();

$db = mysqli_connect($hostname, $username, $password ,$project);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
  }

print "<br>Successfully connected to MySQL.<br>";
mysqli_select_db( $db, $project );

$user		= $_SESSION	["user"];
$pass		= $_SESSION	["pass"];
$account	= getdata 	("account");
$num		= getdata 	("num");
$amnt    	= getdata 	("amnt");
$service 	= getdata 	("service");

if ($service == "1") {
    echo "Choose a Service";
} 
elseif ($service == "2") {
    show ($user, $output, $num, $account);
} 
elseif ($service == "3") {
    deposit ($user, $amnt, $output, $account);
    echo $output;
} 
else {
    withdraw ($user, $amnt, $output, $account);
    echo $output;
}
if(isset($_GET["mail_check"])){
    mailer($user, $output);
}
else{
    echo "no receipt";
}

print "<br><br>Bye" ;

?>

<!DOCTYPE html>
<meta charset="utf-8"/>
<form action="logout.php">
<input type=submit value="Logout">
</form>

