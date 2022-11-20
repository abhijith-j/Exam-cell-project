<?php

//Use xampp localhost server program

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
//test1 is the name of the DATABASE
$dbName = "test1";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
