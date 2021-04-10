<?php

function emptyInput($name, $username, $pwd, $pwd_conf) {
    $result;
    if(empty($name) || empty($username) || empty($pwd) || empty($pwd_conf)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwd_conf) {
    $result;
    if($pwd !== $pwd_conf) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username) {
    $sql = "SELECT * FROM users WHERE usersUsername = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmt_failed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $username, $pwd) {
    $sql = "INSERT INTO users (usersUsername, usersPasswword) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmt_failed");
        exit();
    }
    
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../register.php?error=none");
    exit();
}
function emptyInputLogin($username, $pwd) {
    $result;
    if(empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function  loginUser($conn, $username, $pwd) {
    $usernameExists($conn, $username);

    if ($usernameExists === false){
        header("location: ../login.php?error=wrongLogin");
        exit();
    }

    $pwdHashed = $usernameExists["usersPwd"];
    $chcekPwd = password_verify($pwd, $pwdHashed);

    if($chcekPwd === false){
    header("location: ../login.php?error=wrongLogin");
    exit();
    }

    else if ($chcekPwd === true ){
    session_start();
    $SESSION["userid"] = $usernameExists["userId"];
    $SESSION["useruid"] = $usernameExists["userUid"];
    header("location:../index.php");
    exit();
    }
}