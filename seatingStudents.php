<?php
include_once './backend/databaseconnect.php';

$del="DELETE FROM seatingarrng;";
mysqli_query($conn,$del);

$num= $_POST['num'];

$sql= "UPDATE eachclassnum SET num='$num';";
mysqli_query($conn,$sql);

$y1= $_POST['y1'];
$y2= $_POST['y2'];
$b1= $_POST['b1'];
$b2= $_POST['b2'];


function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if($y2=='N/A' && $b2=='N/A'){
    if($y1 == 'All' && $b1 == 'All'){

    }
    elseif($y1 == 'All' && $b1 != 'All'){
        $k= 1;
        $classnum= 0;
        $roltrack= array(1,1,1,1,1);

        while($k < 5){
            $sql= "SELECT * FROM studentnum WHERE yr=$k;";
            $res= mysqli_query($conn,$sql);
            $row= mysqli_fetch_assoc($res);
            $stnum[$k-1]= $row[$b1];
            $k++;
        }
        $k= 0;
        while($k < 4){
            if($stnum[$k] >= $num){
                $classnum= $classnum+1;
                $leftend= $roltrack[$k]-1+$num;
                $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$roltrack[$k] to $leftend',$classnum,$k+1);";
                $roltrack[$k]= $roltrack[$k]+$num;
                $stnum[$k]= $stnum[$k]-$num;
                mysqli_query($conn,$sql);
            }
            else{
                $k++;
            }
        }

        // 

        $flag= 1;
        $classnum++;
        $sum= 0;
        $k= 0;
        while($flag == 1 && $k < 4){
            if($stnum[$k] == 0){
                $k++;
                continue;
            }
            if($sum == 0){

                $sum= $sum+$stnum[$k];
                $leftend= $roltrack[$k]-1+$stnum[$k];
                $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$roltrack[$k] to $leftend',$classnum,$k+1);";
                $roltrack[$k]= $roltrack[$k]+$stnum[$k];
                $stnum[$k]= 0;
                mysqli_query($conn,$sql);
                $k++;
            }
            elseif($sum > 0){
                $rem= $num-$sum;
                if($stnum[$k] > $rem){
                    $sum= $sum+$rem;
                    $leftend= $roltrack[$k]-1+$rem;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$roltrack[$k] to $leftend',$classnum,$k+1);";
                    $roltrack[$k]= $roltrack[$k]+$rem;
                    $stnum[$k]= $stnum[$k]-$rem;
                    mysqli_query($conn,$sql);
                }
                elseif($stnum[$k] <= $rem){
                    $sum= $sum+$stnum[$k];
                    $leftend= $roltrack[$k]-1+$rem;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$roltrack[$k] to $leftend',$classnum,$k+1);";
                    $roltrack[$k]= $roltrack[$k]+$rem;
                    $stnum[$k]= 0;
                    mysqli_query($conn,$sql);
                    $k++;

                }
            }
            if($sum == $num){
                $classnum++;
                $sum= 0;
            }
            $flag= 0;
            for($x= 0;$x< 4;$x++){
                if($stnum[$x] != 0){
                    $flag= 1;
                }
            }
        }

        // 
        
    }
    elseif($y1 != 'All' && $b1 == 'All'){
        $sql= "SELECT * FROM studentnum WHERE yr=$y1;";
        $res= mysqli_query($conn,$sql);
        $row= mysqli_fetch_assoc($res);

        $stnum[0]= $row['CSE'];$branch[0]= 'CSE';
        $stnum[1]= $row['ECE'];$branch[1]= 'ECE';
        $stnum[2]= $row['EEE'];$branch[2]= 'EEE';
        $stnum[3]= $row['ME'];$branch[3]= 'ME';
        $stnum[4]= $row['CE'];$branch[4]= 'CE';

        $roltrack= array(1,1,1,1,1);

        $k= 0;
        $classnum= 0;
        while($k < 5){
            if($stnum[$k] >= $num){
                $classnum= $classnum+1;
                $leftend= $roltrack[$k]-1+$num;
                $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$branch[$k]','$roltrack[$k] to $leftend',$classnum,$y1);";
                $roltrack[$k]= $roltrack[$k]+$num;
                $stnum[$k]= $stnum[$k]-$num;
                mysqli_query($conn,$sql);
            }
            else{
                $k++;
            }
        }
        $flag= 1;
        $classnum++;
        $sum= 0;
        $k= 0;
        while($flag == 1){
            if($stnum[$k] == 0){
                $k++;
                continue;
            }
            if($sum == 0){

                $sum= $sum+$stnum[$k];
                $leftend= $roltrack[$k]-1+$stnum[$k];
                $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$branch[$k]','$roltrack[$k] to $leftend',$classnum,$y1);";
                $roltrack[$k]= $roltrack[$k]+$stnum[$k];
                $stnum[$k]= 0;
                mysqli_query($conn,$sql);
                $k++;
            }
            elseif($sum > 0){
                $rem= $num-$sum;
                if($stnum[$k] > $rem){
                    $sum= $sum+$rem;
                    $leftend= $roltrack[$k]-1+$rem;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$branch[$k]','$roltrack[$k] to $leftend',$classnum,$y1);";
                    $roltrack[$k]= $roltrack[$k]+$rem;
                    $stnum[$k]= $stnum[$k]-$rem;
                    mysqli_query($conn,$sql);
                }
                elseif($stnum[$k] <= $rem){
                    $sum= $sum+$stnum[$k];
                    $leftend= $roltrack[$k]-1+$rem;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$branch[$k]','$roltrack[$k] to $leftend',$classnum,$y1);";
                    $roltrack[$k]= $roltrack[$k]+$rem;
                    $stnum[$k]= 0;
                    mysqli_query($conn,$sql);
                    $k++;

                }
            }
            if($sum == $num){
                $classnum++;
                $sum= 0;
            }
            $flag= 0;
            for($x= 0;$x< 5;$x++){
                if($stnum[$x] != 0){
                    $flag= 1;
                }
            }
        }
        
    }
}
elseif($b1=='ALL' && $b2=='ALL' && $y1=='ALL' && $y2=='ALL'){
    $k= 1;$j=1;
    $n= $num/2;
    $sql= "SELECT * FROM studentnum WHERE yr=1;";
    $res= mysqli_query($conn,$sql);
    $row= mysqli_fetch_assoc($res);

    $year1[1][0]= $row['CSE'];$year1[1][1]= "CSE";
    $year1[2][0]= $row['ECE'];$year1[2][1]= "ECE";
    $year1[3][0]= $row['CE'];$year1[3][1]= "CE";
    $year1[4][0]= $row['EEE'];$year1[4][1]= "EEE";
    $year1[5][0]= $row['ME'];$year1[5][1]= "ME";

    $sql= "SELECT * FROM studentnum WHERE yr=3;";
    $res= mysqli_query($conn,$sql);
    $row= mysqli_fetch_assoc($res);

    $year3[1][0]= $row['CSE'];$year3[1][1]= "CSE";
    $year3[2][0]= $row['ECE'];$year3[2][1]= "ECE";
    $year3[3][0]= $row['CE'];$year3[3][1]= "CE";
    $year3[4][0]= $row['EEE'];$year3[4][1]= "EEE";
    $year3[5][0]= $row['ME'];$year3[5][1]= "ME";


    while($k<=5 && $j<=5){
        if($year1[$k][0]<$n){
            $k++;
        }
        if($year3[$j][0]<$n){
            $j++;
        }
        $sql= "";
    }
}
else{
    $sql="SELECT * FROM studentnum WHERE yr=$y1;";
    $res= mysqli_query($conn,$sql);
    $row= mysqli_fetch_assoc($res);
    $num1= $row[$b1];

    $sql="SELECT * FROM studentnum WHERE yr=$y2;";
    $res= mysqli_query($conn,$sql);
    $row= mysqli_fetch_assoc($res);
    $num2= $row[$b2]; 
    
    echo "<script> alert('$num2') </script>";

    $rolltrack1= 1;
    $rolltrack2= 1;
    $classnum= 0;
    $leftend;

    while($num1 > $num/2 || $num2 > $num/2){
        $classnum= $classnum+1;
        if($num1 < $num/2 && $num2 >= $num/2){
            if($num1 == 0){
                if($num2 > $num){
                    $leftend= $rolltrack2-1+$num;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b2','$rolltrack2 to $leftend',$classnum,$y2);";
                    $rolltrack2= $rolltrack2+$num;
                    $num2= $num2-$num;
                    mysqli_query($conn,$sql);
                }
                else{
                    $leftend= $rolltrack2-1+$num2;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b2','$rolltrack2 to $leftend',$classnum,$y2);";
                    $rolltrack2= $rolltrack2+$num2;
                    $num2= 0;
                    mysqli_query($conn,$sql);
                }
                
            }
            else{
                if($num1+$num2 >= $num){
                    $leftend= $rolltrack1-1+$num1;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$rolltrack1 to $leftend',$classnum,$y1);";
                    $rolltrack1= $rolltrack1+$num1;
                    $num1= 0;
                    mysqli_query($conn,$sql);

                    $leftend= $rolltrack2-1+$num-$num1;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b2','$rolltrack2 to $leftend',$classnum,$y1);";
                    $rolltrack2= $rolltrack2+$num-$num1;
                    $num2= $num2-$num-$num1;
                    mysqli_query($conn,$sql);
                }
                else{
                    $leftend= $rolltrack1-1+$num1;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$rolltrack1 to $leftend',$classnum,$y1);";
                    $rolltrack1= $rolltrack1+$num1;
                    $num1= 0;
                    mysqli_query($conn,$sql);

                    $leftend= $rolltrack2-1+$num2;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b2','$rolltrack2 to $leftend',$classnum,$y2);";
                    $rolltrack2= $rolltrack2+$num2;
                    $num2= 0;
                    mysqli_query($conn,$sql);
                }
                
            }
        }
        elseif($num2 <$num/2 && $num1 >=$num/2){
            if($num2 == 0){
                if($num1 > $num){
                    $leftend= $rolltrack1-1+$num;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$rolltrack1 to $leftend',$classnum,$y1);";
                    $rolltrack1= $rolltrack1+$num;
                    $num1= $num1-$num;
                    mysqli_query($conn,$sql);
                }
                else{
                    $leftend= $rolltrack1-1+$num1;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$rolltrack1 to $leftend',$classnum,$y1);";
                    $rolltrack1= $rolltrack1+$num1;
                    $num1= 0;
                    mysqli_query($conn,$sql);
                }
                
            }
            else{
                if($num1+$num2 >= $num){
                    $leftend= $rolltrack2-1+$num2;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b2','$rolltrack2 to $leftend',$classnum,$y2);";
                    $rolltrack2= $rolltrack2+$num2;
                    $num2= 0;
                    mysqli_query($conn,$sql);

                    $leftend= $rolltrack1-1+$num-$num2;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$rolltrack1 to $leftend',$classnum,$y2);";
                    $rolltrack1= $rolltrack1+$num-$num2;
                    $num1= $num1-$num-$num2;
                    mysqli_query($conn,$sql);
                }
                else{
                    $leftend= $rolltrack1-1+$num1;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$rolltrack1 to $leftend',$classnum,$y1);";
                    $rolltrack1= $rolltrack1+$num1;
                    $num1= 0;
                    mysqli_query($conn,$sql);

                    $leftend= $rolltrack2-1+$num2;
                    $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b2','$rolltrack2 to $leftend',$classnum,$y2);";
                    $rolltrack2= $rolltrack2+$num2;
                    $num2= 0;
                    mysqli_query($conn,$sql);
                }
                
            }
        }
        elseif($num1 >= $num/2 && $num2 >= $num/2){
            $leftend= $rolltrack1-1+$num/2;
            $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1','$rolltrack1 to $leftend',$classnum,$y1);";
            $rolltrack1= $rolltrack1+$num/2;
            $num1= $num1-$num/2;
            mysqli_query($conn,$sql);
            

            $leftend= $rolltrack2-1+$num/2;
            $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b2','$rolltrack2 to $leftend',$classnum,$y2);";
            $rolltrack2= $rolltrack2+$num/2;
            $num2= $num2-$num/2;
            mysqli_query($conn,$sql);
            
        }  
    }
    $classnum= $classnum+1;
    if($num1 != 0){
        $leftend= $rolltrack1-1+$num1;
        $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b1' ,'$rolltrack1 to $leftend',$classnum,$y1);";
        mysqli_query($conn,$sql);
    }
    if($num2 != 0){
        $leftend= $rolltrack2-1+$num2;
        $sql= "INSERT INTO seatingarrng(Branch,Rollno,class,year) VALUES('$b2','$rolltrack2 to $leftend',$classnum,$y2);";
        mysqli_query($conn,$sql);
    }
}

header("Location: seatingStudents.html?submit=success");
?>