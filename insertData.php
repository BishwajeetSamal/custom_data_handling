<?php 
include("connection.php");


$name=$_GET['name'];
$classes=$_GET['classes'];
$roll_no=$_GET['roll_no'];
$email=$_GET['email'];
$mobile=$_GET['mobile'];
$percent=$_GET['percent'];

$stmt = $conn->prepare("INSERT INTO students (name,class,roll_no,email,mob,percentage)  VALUES (?, ?, ?,?, ?, ?)");
$stmt->bind_param("ssissi", $name,$classes,$roll_no,$email,$mobile,$percent);
$stmt->execute();

$stmt = $conn->prepare("SELECT  id FROM students WHERE email=? AND mob=?");
    $stmt->bind_param("ss", $email, $mobile);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    $stmt->fetch();
    if($stmt->num_rows == 1)  //To check if the row exists
        {
    echo $id;
}
    $stmt->close();
