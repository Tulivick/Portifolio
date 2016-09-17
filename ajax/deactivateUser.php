<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit;
}
include "../conn/connection.php";
$id = htmlspecialchars($_GET['id']);
$stmt = $conn->prepare("UPDATE `users` SET `active` = !`active` WHERE id = :id");
$stmt->bindValue(":id", $id);
echo $stmt->execute()?"ok":"error";
?>