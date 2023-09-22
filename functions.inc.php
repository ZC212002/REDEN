<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result;
    if(empty($name)||empty($email)||empty($username)||empty($pwd)||empty($pwdRepeat)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function invalidUid($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]{3,20}$/", $username)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function invalidPwd($pwd){
    $result;
    if (strlen($pwd) <= '8'|| strlen($pwd) >= '20') {
        $result = true;
    }
    elseif(!preg_match("#[0-9]+#",$pwd)) {
        $result = true;
    }
    elseif(!preg_match("#[A-Z]+#",$pwd)) {
        $result = true;
    }
    elseif(!preg_match("#[a-z]+#",$pwd)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd, $pwdRepeat){
    $result;
    if($pwd != $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function uidExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: sign_up.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}
function adminUidExists($conn, $username, $email){
    $sql = "SELECT * FROM admins WHERE adminsUid = ? OR adminsEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: sign_up.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function createUser($conn, $name, $email, $username, $pwd){
    $sql = "INSERT INTO users(usersName, usersEmail, usersUid, usersPwd) VALUES(?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: sign_up.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: sign_up.php?error=none");
    exit();

}

function emptyInputLogin($username, $pwd){
    $result;
    if(empty($username)||empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $uidExists =  uidExists($conn, $username, $username);

    if($uidExists === false){

        header("location: sign_in.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("location: sign_in.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        echo '<script type="text/JavaScript">alert("You have sucessfully login! You will now be redirected back to the home page"); window.location.href="index.php"</script>';
       exit();
    }
}
function loginAdmin($conn, $username, $pwd){
    $uidExists =  adminUidExists($conn, $username, $username);

    if($uidExists === false){

        header("location: sign_in.php?error=wronglogin");
        exit();
    }

    $adminpwd= $uidExists["adminsPwd"];
    $checkPwd = password_verify($pwd, $adminpwd);

    if($checkPwd === false){
        header("location: sign_in.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true){
        session_start();
        $_SESSION["adminsid"] = $uidExists["adminsId"];
        $_SESSION["adminsuid"] = $uidExists["adminsUid"];
        echo '<script type="text/JavaScript">alert("You have sucessfully login as admin! You will now be redirected to the admin page"); window.location.href="admin_page.php"</script>';
       exit();
    }
}