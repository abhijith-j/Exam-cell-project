<?php
	include_once './backend/databaseconnect.php';

if(isset($_POST["submit"])){
	$del="DELETE FROM list;";
	$sql="SELECT * FROM staff;";

	$res=mysqli_query($conn,$sql);
	$nodays= $_POST['days'];
	$nocls= $_POST['class'];
	$asocc= $_POST['asso'];
	$hod= $_POST['hod'];
	$proff= $_POST['prof'];
	$assist= $_POST['assi'];

	$dutyno= array();
	$k=0;$h=0;$as=0;$aso=0;$pro=0;
	while($row= mysqli_fetch_assoc($res)){
		if(strcasecmp($row["DESIGNATION"],"HOD")==0){
			$dutyno[$k]=$hod;$k++;$h++;
		}
		elseif(strcasecmp($row["DESIGNATION"],"ASSOCIATE")==0){
			$dutyno[$k]=$asocc;$k++;$aso++;
		}
		elseif(strcasecmp($row["DESIGNATION"],"PROFESSOR")==0){
			$dutyno[$k]=$proff;$k++;$pro++;
		}
		elseif(strcasecmp($row["DESIGNATION"],"ASSISTANT")==0){
			$dutyno[$k]=$assist;$k++;$as++;
		}
	}

	$tot=mysqli_num_rows($res);
	$random=rand(1,$tot);
	$t=($asocc*$aso)+($hod*$h)+($proff*$pro)+($assist*$as);
	$d=0;
	$c=0;$k=$random-1;

	if($t<($nocls*$nodays)){
		header("Location: sort.html?submit=failed_$t-$aso-$h-$pro-$as-$nocls*$nodays");
	}
	else{
		mysqli_query($conn,$del);
		mysqli_data_seek($res,0);
		//header("Location: test.php");
		$avil=array();
		while($d<$nodays){
			$c=0;

			$z=0;
			while($z!=$tot){
				$avil[$z]=0;
				$z++;
			}
			//echo $z."-";

			while($c<$nocls){
				$min=100000;$t=0;$k=0;$x=0;$y=0;
				$res=mysqli_query($conn,$sql);
				while($row= mysqli_fetch_assoc($res)){
					if(($row['CNT']<$min)&&($avil[$k]==0)){
						$min=$row['CNT'];$x=$row['STAFF_ID'];$y=$k;
						//echo $row['STAFF_ID']."-".$min."-".$y."--";
						//echo $d." ".$c."-";
					}
					echo $k."-";
					$t++;$k++;
					if($t==$tot){
						break;
					}
					if($k==$tot){
						$k=0;
						mysqli_data_seek($res,0);
					}
				}
				//echo "<br>";

				if($avil[$y]==0){
					$avil[$y]=1;
					$minl="SELECT * FROM staff where STAFF_ID='$x';";
					$minimum=mysqli_query($conn,$minl);
					$row=mysqli_fetch_assoc($minimum);
					$stf=$row['STAFF_ID'];
					$nm=$row['NAME'];
					$sqli="INSERT INTO list (empid,name,exdate,exclass) VALUES('$stf','$nm','$d','$c');";
					$min=$min+1;
					$incre="UPDATE staff SET CNT='$min' WHERE STAFF_ID='$stf';";
					mysqli_query($conn,$sqli);
					mysqli_query($conn,$incre);
					//$dutyno[$min]--;
					$c++;
					mysqli_data_seek($res,0);
				}
			}
			echo "<br>";
			$d++;
		}
		header("Location: sort.html?submit=success");
	}
}
