<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set( 'display_errors' , 1 );

include (  "account.php"     ) ;

$db = mysqli_connect($hostname, $username, $password ,$project);
if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
  }
mysqli_select_db( $db, $project );

$user= $_SESSION["user"];

global $db;
$s = "select * from A2 where user = '$user'";
($t = mysqli_query($db, $s) ) or  die ( mysqli_error( $db ) );

echo "<tr><th><label for=\"account\">Account</label> <br></th>";

echo "<th><select name =\"account\">";
	echo "<option value=\"1\">Choose Account</option>";

while  (   $r  =   mysqli_fetch_array ( $t, MYSQLI_ASSOC )  )
{
    $account			= $r [ "account"];
    $current			= $r [ "current"];
	
    echo "<option  value =\"$account\" >";
    echo "$account	$current"; 
    echo "</option>";
}

echo "</select></th></tr>";

?>