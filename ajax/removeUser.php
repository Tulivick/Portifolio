<?php
session_start();
if(!isset($_SESSION['email'])){
	header('HTTP/1.1 401 Unauthorized');
	exit;
}
include "../conn/connection.php";
$conn->exec("DELETE FROM users WHERE id=".$_GET['id']);
echo "ok"
?>