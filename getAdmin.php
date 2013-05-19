<?php
require_once 'database.class.php';
require_once 'classOfficers.php';

function formatResults($mySQLresult, $gradeSelect){
	$grade = substr($gradeSelect, 5);
	foreach ($classOfficers[$grade] as $office => $candidates){
		foreach ($candidates as $candidate){
			$resultArray[$office][$candidate] = 0;
		};
	};
	foreach ($mySQLresult as $vote){
		$presidentVote = $vote[president];
		$resultArray[president][$presidentVote]++;
		
		$vicepresidentVote = $vote[vicepresident];
		$resultArray[vicepresident][$vicepresidentVote]++;
		
		$secretaryVote = $vote[secretary];
		$resultArray[secretary][$secretaryVote]++;
		
		$treasurerVote = $vote[treasurer];
		$resultArray[treasurer][$treasurerVote]++;
	};
	return $resultArray;
};

if ($gradeSelect = $_POST['selectgrade']){
	$db = new Database();
	$db->connect();
	$db->select($gradeSelect);
	$result = $db->getResult();
	$formattedResults = formatResults($result, $gradeSelect);
	foreach ($formattedResults as $office => $candidates){
		switch ($office){
			case "president":
				$office = "President";
				break;
			case "vicepresident":
				$office = "Vice President";
				break;
			case "secretary":
				$office = "Secretary";
				break;
			case "treasurer":
				$office = "Treasurer";
				break;
		};
		echo "<h3>$office</h3>";
		foreach ($candidates as $candidate => $votes){
			echo "<h4 class='adminResults'>$candidate: $votes</h4>";
		};
	};
}
else {
	echo "null";
};
?>