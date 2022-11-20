<?php
session_start();

include_once 'backend/databaseconnect.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if(isset($_POST['sub']))
{
	$allowed_ext = ['xls', 'csv', 'xlsx'];

	$fileName = $_FILES['file_name']['name'];
	$check = explode(".",$fileName);
	$file_ext= end($check);

	function_alert('here');

	if(in_array($file_ext, $allowed_ext))
	{
		$targetPath = $_FILES['file_name']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
		$data= $spreadsheet->getActiveSheet()->toArray();

		foreach($data as $row)
		{
			$NM =$row['0'];
			$SID =$row['1'];
			$DEP =$row['3'];
			$DESIG =$row['2'];

			$checktbl="SELECT STAFF_ID FROM staff WHERE STAFF_ID='$SID';";
			$checkresult=mysqli_query($conn,$checktbl);

			//IF EXIST UPDATE
			if(mysqli_num_rows($checkresult)>0)
			{
				$updatequery="UPDATE staff SET NAME='$NM',STAFF_ID='$SID', DEPARTMENT='$DEP', DESIGNATION='$DESIG' WHERE STAFF_ID='$SID'; ";
				mysqli_query($conn,$updatequery);
			}
			//IF NEW ADD
			else{
				$insertquery="INSERT INTO staff (NAME,STAFF_ID,DEPARTMENT,DESIGNATION) VALUES ('$NM','$SID','$DEP','$DESIG'); ";
				mysqli_query($conn,$insertquery);
			}
		}
		header("Location: inputpage.html?SUCCESS");

	}
	else
	{
		header("Location: inputpage.html?UNSUCCESFULL");
		exit(0);
	}
}
?>