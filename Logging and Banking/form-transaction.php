<?php	
session_set_cookie_params (0, "/~et75/");
session_start();
include (  "functions.php");
gatekeeper();	
?>

<!DOCTYPE html>
<font size="+2">
<div>
<style>
	table.1 {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		text-align: left;
		padding: 8px;
	}

	.solid {
		border-style: solid;
		border-width: 6px;
		border-radius: 10px;
		border-color: silver;
		background: -webkit-linear-gradient(#ADD8E6, #C9DCB9); 
		background: -o-linear-gradient(#ADD8E6, #C9DCB9); 
		background: -moz-linear-gradient( #ADD8E6, #C9DCB9); 
		background: linear-gradient(to top left, rgba(141,75,19,0.5), rgba(249,113,0,1));
	}
</style>

<fieldset class="solid">
	<table class="1">
		<tr>

			<th><label for="myName">Tirmizi Emad</label><br></th>
		</tr>
		<tr>

			<th><label for="Class">WED</label><br></th>
		</tr>
	</table>
</fieldset>
</div>

<div style=" height: 100px;">
	<style>

		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 30%;
		}

		td, th {
			text-align: left;
			padding: 8px;
		}

		.solid {
			border-style: solid;
			border-width: 6px;
			border-radius: 10px;
			border-color: silver;
			display: inline-block;
			background: -webkit-linear-gradient(#ADD8E6, #C9DCB9); 
			background: -o-linear-gradient(#ADD8E6, #C9DCB9); 
			background: -moz-linear-gradient( #ADD8E6, #C9DCB9); 
			background: linear-gradient(to top left, rgba(141,75,19,0.5), rgba(249,113,0,1));
		}

		body{
			Background: black;
		}

	</style>
</div>

<center>
<body>
	<script type="text/javascript">
		window.onload = function(){
			document.getElementById("tramnt").style.display = 'none';
			document.getElementById("trnum").style.display = 'none';
		}

		function Select(){
			var service = document.getElementById("service").value;
  
			if(service =="1"){ 
				document.getElementById("tramnt").style.display = 'none';
				document.getElementById("trnum").style.display = 'none';
			}
			if (service == "2"){
				document.getElementById("tramnt").style.display = 'none';
				document.getElementById("trnum").style.display = '';
			}
			if(service =="3"){ 
				document.getElementById("trnum").style.display = 'none';
				document.getElementById("tramnt").style.display = '';
			}
  
			if(service =="4"){ 
				document.getElementById("trnum").style.display = 'none';
				document.getElementById("tramnt").style.display = '';
			}

		}

	</script>



<form action="transactions.php" method="get">
	<fieldset class="solid">
		<table>
			<tr>
				<th><label for="service">Service</label><br></th>
				<th><select name="service" name= Service id="service" onchange="Select()">
	
					<option value="1"> Choose One</option>
					<option value="2"> Show </option>
					<option value="3"> Deposit </option>
					<option value="4"> Withdraw </option>

				</select><br></th>
			</tr>
	  
			<?php include ("menu.php"); ?>
	  
			<tr id= "tramnt">
				<th><label for="amnt">Amount</label> <br> </th>

				<th><input type="number" step="0.01" name="amnt" id="amnt" placeholder="Enter Amount" min="0.01" autofocus   automcomplete=off  ><br></th>
			</tr>

			<tr id= "trnum">
				<th><label for="num">Number</label> <br> </th>

				<th><input type="number" name="num" id="num" placeholder="Enter Number of Trans" min="1" autofocus   automcomplete=off  ><br></th>
			</tr>

			<tr>
				<th><label for="mail_check">Email Receipt</label><br></th>
				<th><input type=checkbox name="mail_check" ><br></th>
			</tr>

			<tr>
				<th><label for="StopAutoLogout">Stop Auto Logout?</label><br></th>
				<th><input type = checkbox id="StopAutoLogout" name ="Stop Auto Logout" checked="checked"><br></th>
			</tr>
	  
		<table>
	<input type=submit>
</form>
<script type="text/javascript">
	"use strict";
	var ptrbox = document.getElementById("StopAutoLogout");
	document.addEventListener("click", slowdown);	
	document.addEventListener("keypress", slowdown);
	document.addEventListener("mousemove", slowdown);

	var timer1;
	
	function slowdown(){
	
		clearTimeout (timer1);
		timer1 = setTimeout(messenger, 4000);

	}

	function messenger(){
	
		setTimeout(out, 3000);
		document.getElementById("StopAutoLogout").innerHTML = "<h1>Logging out shortly</h1>"
	
	}
	function out(){
		if(ptrbox.checked){
			return;
		}
		window.location.href ='logout.php';
	}
	
</script>
<center>
</fieldset>
</body>
</font>
