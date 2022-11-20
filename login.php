<?php

if(isset($_POST['login']))
{
    if((strcmp($_POST['username'],"admin")==0)&&(strcmp($_POST['password'],"admin")==0))
    {
        header("Location: admin.html?");
    }
    elseif((strcmp($_POST['username'],"user")==0)&&(strcmp($_POST['password'],"user")==0))
    {
        header("Location: sort.html");
    }
    else{
        header("Location: login.html");
    }
}