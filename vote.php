<?php session_start() ?>
<?php
require_once 'classOfficers.php';

function ballotGuts($OFFICE, $p){
	$GRADE = $_SESSION['GRADE'];
	global $classOfficers;
	$p++;
	$office = strtolower($OFFICE);
	echo "<h3>Choose your ".$GRADE."th grade $office.</h3>
	<form name='president-select' action='vote?p=$p' method='post' data-transition='slide'>";
		echo
        '<fieldset data-role="controlgroup">';
        	$i = 1;
        	foreach ($classOfficers[$GRADE][$OFFICE] as $presidentOption){
        		echo "<input type='radio' name='$OFFICE' id='radio-$OFFICE-$i' value='$presidentOption'>";
	        	echo "<label for='radio-$OFFICE-$i'>$presidentOption</label>";
	        	$i++;
        	};
        	echo 
        	'
	    </fieldset>
	    <input type="submit" value="Next" data-icon="arrow-r" data-iconpos="right" data-theme="b">
	</form>
	';
};

function htmlCreate($a){
	$header = '
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
		<div data-role="content">';
	$footer = '
		</div>
		</div>
		</body>
		</html>';
		
	echo $header;
		
	if ($a == 1){
		echo '	
		<h3>Select your class (next year).</h3>
		<h4>Know that you only have one chance to vote. Once your ballot is placed, you will not have an option to vote again.</h4>
		<form name="grade-select" action="vote?p=2" method="post" data-transition="slide">
	        <fieldset data-role="controlgroup">
		        <input type="radio" name="GRADE" id="radio-grade-10" value="10">
		        <label for="radio-grade-10">Sophomore (10th)</label>
		        <input type="radio" name="GRADE" id="radio-grade-11" value="11">
		        <label for="radio-grade-11">Junior (11th)</label>
		        <input type="radio" name="GRADE" id="radio-grade-12" value="12">
		        <label for="radio-grade-12">Senior (12th)</label>
		    </fieldset>
		    <input type="submit" value="Next" data-icon="arrow-r" data-iconpos="right" data-theme="b">
		</form>';
	};
	
	if ($a == 2){
		$_SESSION['GRADE'] = $_POST['GRADE'];
		ballotGuts("PRESIDENT", $a);
	};
	
	if ($a == 3){
		$_SESSION['PRESIDENT'] = $_POST['PRESIDENT'];
		ballotGuts("VICE-PRESIDENT", $a);
	};
	
	if ($a == 4){
		$_SESSION['VICE-PRESIDENT'] = $_POST['VICE-PRESIDENT'];
		ballotGuts("SECRETARY", $a);
	};
	
	if ($a == 5){
		$_SESSION['SECRETARY'] = $_POST['SECRETARY'];
		ballotGuts("TREASURER", $a);
	};
	
	if ($a == 6){
		$_SESSION['TREASURER'] = $_POST['TREASURER'];
		echo "<h1>Thanks for voting!</h1>";
		echo "<h4>Please review your ballot, and when you're ready, click submit!</h4>";
		echo "<strong>Year: </strong>".$_SESSION['GRADE']."<br>";
		echo "<strong>President: </strong>".$_SESSION['PRESIDENT']."<br>";
		echo "<strong>Vice President: </strong>".$_SESSION['VICE-PRESIDENT']."<br>";
		echo "<strong>Secretary: </strong>".$_SESSION['SECRETARY']."<br>";
		echo "<strong>Treasurer: </strong>".$_SESSION['TREASURER']."<br>";
		echo "<a href='submit' data-role='button' data-theme='b' data-transition='flip'>Submit Ballot</a>";
	};
	
	echo $footer;
};

function main(){
	if (!isset($_SESSION['ID']) or !isset($_SESSION['PIN'])){
		header('Location: loginf');
		exit;
	};
	$p = $_GET['p'];
	if (!isset($p)){
		header("Location: vote?p=1");
		exit;
	};
	return htmlCreate($p);
};
echo main();
?>