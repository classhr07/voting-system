<!DOCTYPE html> 
		<html> 
			<head> 
			<title>My Page</title> 
			<meta name="viewport" content="width=device-width, initial-scale=1"> 
			<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
			<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
			<link rel="stylesheet" href="styles.css" />
			<script>
				function getResults()
				{
					var gradeChoice = $("#selectgrade").val();
					$.ajax({
					  type: "POST",
					  url: "getAdmin",
					  data: { selectgrade: gradeChoice }
					}).done(function( msg ) {
					  $('#results').html(msg);
					});
				}
			</script>
		</head> 
		<body> 
		<div class="page" data-role="page">
		<div data-role="content">
			<form name="admin-select" action="admin" method="post">
				<select name="selectgrade" id="selectgrade" onchange="getResults()">
					<option value="null">Select a class...</option>
				    <option value="grade10">Sophomore (10th)</option>
				    <option value="grade11">Junior (11th)</option>
				    <option value="grade12">Senior (12th)</option>
				</select>
			</form>
			<h4 id="results"></h4>
		</div>
		</div>
		</body>
		</html>