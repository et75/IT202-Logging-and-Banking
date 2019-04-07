<?php 
function show ( $user  , &$output , $num, $account ) {
	global $db; 
	$output = "";
	$s		= "select * from A2 where user = '$user' and account = '$account'"  ;
	$num	= $_GET[ "num" ];
	$u 		= "select * from T2 where user = '$user' and account = '$account' limit $num "  ;	
	$output	.= "<br>SQL statement is: $s<br>";
	$output	.= "<br>SQL statement is: $u<br>";
 
	($t = mysqli_query($db, $s) ) or  die ( mysqli_error( $db ) );
	($b = mysqli_query($db, $u) ) or  die ( mysqli_error( $db ) );

	$output .= "<br>There was $num row retrieved <br><br>";
 
	while ($r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
		$user 			= $r[ "user" ];
		$pass 			= $r[ "pass" ];
		$plainpass 		= $r[ "plainpass" ];
		$email 			= $r[ "mail" ];
		$current 		= $r[ "current" ];
		$initial 		= $r[ "initial" ];	
		$recent_trans 	= $r[ "recent_trans" ];
		
		
		$output .= "User is $user <br>";
		$output .= "Pass is $pass <br>";
		$output .= "Unhashed pass is $plainpass <br>";
		$output .= "Email is $email <br>";
		$output .= "Balance is  $current <br>";
		$output .= "Initial Balance is  $initial <br>";
		$output .= "Recent Transaction of $recent_trans <br>";
		
    };
	$output	.= "*************************************<br>";
    
	while ($r = mysqli_fetch_array ( $b, MYSQLI_ASSOC) ) {
		$type 			= $r[ "type" ];
		$amount 		= $r[ "amount" ];
		$date 			= $r[ "date" ];
		$mail_receipt 	= $r[ "mail_receipt" ];

		$output .= "Type $type <br>";
		$output .= "Amount $amount <br>";
		$output .= "Date $date <br>";
		$output .= "Mail Receipt $mail_receipt <br>";
    
    };
    echo $output ;
}

function auth ( $user, $pass ) {
	global $db;
	$pass = sha1($pass);  
	$s = "select * from A2 where user = '$user' and pass = '$pass' ";
	echo "<br>SQL statement is: $s<br>";
	($t = mysqli_query( $db, $s )) or die(mysqli_error($db));
	$num = mysqli_num_rows($t);
	if($num == 0) {
		return false;
	}
	return true;
}

function getdata( $arg ) {
	global $db;
	$temp = $_GET[$arg];
	$temp = mysqli_real_escape_string ($db , $temp);
	return $temp;
}

function deposit ( $user, $amnt, &$output, $account){
	global $db;
	echo "********************************************<br>";
	$mail = $_GET["mail_check"];
	if(isset($mail)){
		$letter = 'Y';
	}
	else{ 
		$letter = 'N';
	}
	
	$s = "insert into T2 values( '$user', '$account', 'D', '$amnt', NOW(), '$letter' )";
	($t = mysqli_query($db, $s) ) or  die ( mysqli_error( $db ) );

	$u = "update A2 set current = current +'$amnt', recent_trans = NOW() where user = '$user' and account = '$account'";
	($v = mysqli_query($db, $u) ) or  die ( mysqli_error( $db ) );
  
	$s = "select * from A2 where user = '$user' and account = '$account'"; 
	($t = mysqli_query($db, $s) ) or  die ( mysqli_error( $db ) );
	$num = mysqli_num_rows ( $t ); echo "<br>num of recent transactions $num <br>";
	while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
		$current 		= $r[ "current" ];	
		$recent_trans 	= $r[ "recent_trans" ];

		$output .= "Balance is  $current <br>";
		$output .= "Recent Transaction of $recent_trans <br>";
		}
    $output	.= "*************************************<br>";

	$u = "select * from T2 where user = '$user' and account = '$account'"  ;
    ( $v = mysqli_query($db, $u) ) or  die ( mysqli_error( $db ) );
    
	while ( $r = mysqli_fetch_array ( $v, MYSQLI_ASSOC) ) {
		$type 			= $r[ "type" ];
		$mail_receipt 	= $r[ "mail_receipt" ];
		$amount 		= $r[ "amount" ];
		$date 			= $r[ "date" ];
      
		$output .= "Transaction Type $type <br>";
		$output .= "Transaction Amount of $amount <br>";
		$output .= "Transaction Date $date <br>";
		$output .= "Transaction Receipt $mail_receipt <br>";
		$output .= "****************************<br>";
		};
	}

function withdraw ($user, $amnt, &$output, $account){
	global $db;
	echo "********************************************<br>";
	$mail = $_GET["mail_check"];
	if(isset($mail)){
		$letter = 'Y';
	}
	else{ 
		$letter = 'N';
	}
	
	$s = "insert into T2 values( '$user', '$account', 'W', '$amnt', NOW(), '$letter' )";
	($t = mysqli_query($db, $s) ) or  die ( mysqli_error( $db ) );

	$u = "update A2 set current = current -'$amnt', recent_trans = NOW() where user = '$user' and account = '$account'";
	($v = mysqli_query($db, $u) ) or  die ( mysqli_error( $db ) );

	$s = "select * from A2 where user = '$user' and account = '$account'"; 
    ($t = mysqli_query($db, $s) ) or  die ( mysqli_error( $db ) );
	
	$num = mysqli_num_rows ( $t ); echo "<br>num is $num <br>";
	while ($r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
		$current 		= $r[ "current" ];	
		$recent_trans 	= $r[ "recent_trans" ];
      
		$output .= "Balance is  $current <br>";
		$output .= "Recent Transaction of $recent_trans <br>";
		$output	.= "*************************************<br>";
    };
    
	$u = "select * from T2 where user = '$user' and account = '$account'"  ;
    ($v = mysqli_query($db, $u) ) or  die ( mysqli_error( $db ) );
	
	while ($r = mysqli_fetch_array ( $v, MYSQLI_ASSOC) ) {
		$type 			= $r[ "type" ];
		$mail_receipt 	= $r[ "mail_receipt" ];
		$amount 		= $r[ "amount" ];
		$date 			= $r[ "date" ];
      
		$output .= "Type $type <br>";
		$output .= "Amount $amount <br>";
		$output .= "Date $date <br>";
		$output .= "Receipt $mail_receipt <br>";
		$output .= "****************************<br>";
    };
}

function mailer($user, $output){
	global $db;
	$s = "select * from A2 where user = '$user'";
    ($t = mysqli_query($db, $s) ) or  die ( mysqli_error( $db ) );
	$num = mysqli_num_rows ( $t ); echo "<br>num is $num <br>";
	$r = mysqli_fetch_array ( $t, MYSQLI_ASSOC);
  	$mail 		= $r[ "mail" ];
	$to			= $mail	;
	$subj		= "..."		;
	$message	= "$output";
    $message	= wordwrap($output);
    mail($to, $subj, $message);
}

function redirect ($message, $delay, $url){
	echo 	"<br>	$message	<br>";
	header	( "refresh: $delay url = $url");
	exit();
 }

function gatekeeper(){
	if(!isset( $_SESSION["logged"])){
		redirect("Taking you back to Login", 3, "login.html");
	}
}
?>