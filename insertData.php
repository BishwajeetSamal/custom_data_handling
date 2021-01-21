<?php 
include("connection.php");


$name=$_GET['name'];
$classes=$_GET['classes'];
$roll_no=$_GET['roll_no'];
$email=$_GET['email'];
$mobile=$_GET['mobile'];
$percent=$_GET['percent'];

echo $name;

$stmt = $conn->prepare("INSERT INTO students (name,class,roll_no,email,mob,percentage)  VALUES (?, ?, ?,?, ?, ?)");
$stmt->bind_param("ssissi", $name,$classes,$roll_no,$email,$mobile,$percent);
$stmt->execute();
