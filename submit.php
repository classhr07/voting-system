<?php session_start();
$values[0] = 0;
$values[1] = $_SESSION['ID'];
$values[2] = $_SESSION['PIN'];
$values[3] = $_SESSION['PRESIDENT'];
$values[4] = $_SESSION['VICE-PRESIDENT'];
$values[5] = $_SESSION['SECRETARY'];
$values[6] = $_SESSION['TREASURER'];
require_once 'database.class.php';
$db = new Database();
$db->connect();
$table = "grade".$_SESSION['GRADE'];
$db->insert($table, $values);
header("Location: login");
exit;
?>
