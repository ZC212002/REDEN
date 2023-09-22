<?php

if(isset($_POST["submit"])){

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $role = $_POST["role"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    

    if(emptyInputLogin($username, $pwd) !== false){
        header("location: sign_in.php?error=emptyinput");
        exit();
    
    }
    if($role == "User"){
        loginUser($conn, $username, $pwd);
    }else if($role == "Admin"){
        loginAdmin($conn, $username, $pwd);
        
    }
   
    

}

else{
    header("location: sign_in.php");
    exit();
}