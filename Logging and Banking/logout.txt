<?php
mysqli_close($db);
$_SESSION = array ();		
session_destroy();				
setcookie("PHPSESSID" , "", time()-3600, '/~et75/', "", 0,0);
echo "Your session is terminated";
?>