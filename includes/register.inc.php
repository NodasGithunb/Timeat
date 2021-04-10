<?php

if (isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $pwd_conf = $_POST["password-conf"];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if (emptyInput($name, $username, $pwd, $pwd_conf) !== false) {
        header("location: ../register.php?error=empty_input");
        exit();
    }

    if (invalidUsername($username) !== false) {
        header("location: ../register.php?error=invalid_username");
        exit();
    }

    if (pwdMatch($pwd, $pwd_conf) !== false) {
        header("location: ../register.php?error=password_dont_match");
        exit();
    }

    if (usernameExists($conn, $username) !== false) {
        header("location: ../register.php?error=username_already_exists");
        exit();
    }

    createUser($conn, $name, $username, $pwd);

}
else {
    header("location: ../register.php");
    exit();
}
