<?php
//call to database connection code
include_once './backend/databaseconnect.php';

$staffname = $_POST['name'];
$staffid= $_POST['empid'];
$dep = $_POST['dept'];
$desig= $_POST['textbox4'];

/*CREATE TABLE STAFF (NAME varchar(50) NOT NULL,STAFF_ID varchar(20) NOT NULL PRIMARY KEY,DESIGNATION varchar(50) NOT NULL,DEPARTMENT varchar(50));
Code for creating table in 'phpmyadmin'
*/
$sql="INSERT INTO staff (NAME,STAFF_ID,DEPARTMENT,DESIGNATION) VALUES ('$staffname','$staffid','$dep','$desig');";

//$conn in here is from databaseconnect.php
mysqli_query($conn, $sql);
header("Location: inputpage.html?submit=success");

?>
