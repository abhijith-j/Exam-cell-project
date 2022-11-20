<?php
include_once './backend/databaseconnect.php';

$year = $_POST['year'];
$CSE = $_POST['CSE'];
$ECE = $_POST['ECE'];
$EEE = $_POST['EEE'];
$ME = $_POST['ME'];
$CE = $_POST['CE'];


//CREATE TABLE studentnum(yr int,CSE int,ECE int, CE int, ME int,EEE int);
if($year == 1){
    $sql = "UPDATE studentnum SET CSE='$CSE', CE='$CE', EEE='$EEE', ECE='$ECE', ME='$ME' WHERE yr=1;";
}
if($year == 2){
    $sql = "UPDATE studentnum SET CSE='$CSE', CE='$CE', EEE='$EEE', ECE='$ECE', ME='$ME' WHERE yr=2;";
}
if($year == 3){
    $sql = "UPDATE studentnum SET CSE='$CSE', CE='$CE', EEE='$EEE', ECE='$ECE', ME='$ME' WHERE yr=3;";
}
if($year == 4){
    $sql = "UPDATE studentnum SET CSE='$CSE', CE='$CE', EEE='$EEE', ECE='$ECE', ME='$ME' WHERE yr=4;";
}

mysqli_query($conn, $sql);
header("Location: studentDetIn.html?submit=success");
?>