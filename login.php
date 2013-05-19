<?php session_start(); ?>
<?php
function htmlCreate($a, $m){
	echo '
		<!DOCTYPE html> 
		<html> 
			<head> 
			<title>My Page</title> 
			<meta name="viewport" content="width=device-width, initial-scale=1"> 
			<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
			<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
			<link rel="stylesheet" href="styles.css" />
		</head> 
		<body> 
		
		<div class="page" data-role="page">
		
			<div data-role="content">	
				<h3>Login through PASS to vote.</h3>
				';
				if ($a == 1){
					echo '<h4 id="message">Please enter a valid Student ID/PIN combination</h4>';
				};
				if ($a == 2){
					echo '<h4 id="message">You already have a vote cast in our database. Unfortunately, you can only vote once.</h4>';
				};
				if ($a == 3){
					echo "<h4>$m</h4>";
				};
				echo 
				'
				<form name="login" action="login" method="get" data-transition="flip">
				    <input type="text" name="ID" id="textinput-ID" placeholder="Student ID" value="">
				    <input type="password" name="PIN" id="textinput-PIN" placeholder="PIN" value="">
				    <input type="submit" value="Login" data-theme="b">
				</form>
			</div>
		
		</div>
		
		</body>
		</html>
	';
};
function main(){
	if ($ID = $_GET['ID'] and $PIN = $_GET['PIN']){
		$URL = "http://sm.nohum.k12.ca.us/pass/sched/" . base_convert($ID, 10, 16) . $PIN . ".htm";
		$HTTPstatus = get_headers($URL, 1);
		if ($HTTPstatus[0] != "HTTP/1.1 200 OK"){
			return htmlCreate(1);
		}
		else {
			$_SESSION['ID'] = $ID;
			$_SESSION['PIN'] = $PIN;
			header("Location: vote");
			exit;
		};
	}
	else {
		return htmlCreate(0);
	};
};
echo main();
?>