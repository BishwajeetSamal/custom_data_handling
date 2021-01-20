<?php 
include("connection.php");

$id=$_GET['id'];
$name=$_GET['name'];
$classes=$_GET['classes'];
$roll_no=$_GET['roll_no'];
$email=$_GET['email'];
$mobile=$_GET['mobile'];
$percent=$_GET['percent'];



$stmt = $conn->prepare("UPDATE students SET name=?,class=?,roll_no=?,email=?,mob=?,percentage=? WHERE id=?");
$stmt->bind_param("ssisisi", $name,$classes,$roll_no,$email,$mobile,$percent,$id);
$stmt->execute();

?>

