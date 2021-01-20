<?php 
include("connection.php");

$id=$_GET['id'];

$stmt = $conn->prepare("DELETE FROM students  WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

?>

