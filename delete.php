<?php
include_once 'backend/databaseconnect.php';

if(isset($_POST['del']))
{
    $id = $_POST['empid'];
    
    $query = "DELETE FROM staff WHERE STAFF_ID = '$id';";
    $query_run = mysqli_query($conn,$query);
    
    if($query_run)
    {
        header("Location: delete.html?submit=success");
    }
    else
    {
       header("Location: delete.html?submit=failed");
    }
}

?>