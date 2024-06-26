<?php

session_start();
require '../koneksi.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    
        $username = $_POST['username'];
        $password = md5($_POST['password']);

    $sql_check = "SELECT username, password FROM admin WHERE username=? AND password=? LIMIT 1";

    $check_log = $dbconnect->prepare($sql_check);
    $check_log->bind_param('ss', $username, $password);
    
    $check_log->execute();

    $check_log->store_result();

    if ($check_log->num_rows == 1) {

        $check_log->bind_result($username, $password);

        while ($check_log->fetch()) {
            $_SESSION['admin_login'] = $username;
        }

        $check_log->close();

        header('location: index.php?not=1');
        exit();
    } else {
        header('location: login.php?note=1');
        exit();
    }
} else {
    header('location: login.php?note=1');
    exit();
}