<?php
if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['pwd'];
    $con = mysqli_connect("localhost", "root", "", "register page");
    $sql = "SELECT * from register WHERE uname='$username' AND pwd='$password'";
    $result = mysqli_query($con, $sql);
    $resultcheck = mysqli_num_rows($result);

    if ($resultcheck > 0) {
        echo "Login Successful";
    } else {
        echo "username or password incorrect";
    }
}
