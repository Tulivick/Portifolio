<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit;
}
include "../conn/connection.php";
$basename = "Imagens/";
$errors = "";
if (isset($_POST['remove'])) {
    foreach ($_POST['remove'] as $value) {
        if (!unlink("../" . $value)) {
            $errors .= "Unable to remove file" . $value . "<br/>";
        }
        $conn->exec("DELETE FROM images WHERE path='" . $value . "'");
    }
}
if (isset($_FILES['add'])) {
    foreach ($_FILES['add']['name'] as $key => $fileName) {
        $newName = uniqid();
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = $basename.$newName.".".$ext;
        $stmt = $conn->prepare("INSERT INTO `images`(`path`, `galery`) VALUES (:path,:galery);");
        $stmt->bindValue(":path", $newName);
        $stmt->bindValue(":galery", $_POST['galery']);
        if ($stmt->execute()) {
            move_uploaded_file($_FILES['add']['tmp_name'][$key], "../".$newName);
        } else {
            $errors .= "Unable to save file " . $fileName;
        }
    }
}
if (strlen($errors) == 0) {
            echo 'ok';
        } else {
            echo $errors;
        }
?>
