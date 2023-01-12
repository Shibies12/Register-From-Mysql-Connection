<?php
$uname = $_POST['uname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$cpwd = $_POST['cpwd'];

if (!empty($uname) || !empty($email) || !empty($pwd) || !empty($cpwd)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "register page";

    // create connection

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error (' . mysqli_connect_errno() . ')'
            . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register (uname , email, pwd, cpwd)values(?,?,?,?)";

        // prepare statment 
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        // checking username
        if ($rnum == 0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssss", $uname, $email, $pwd, $cpwd);
            $stmt->execute();
            echo "New record inserted sucessfully";
        } else {
            echo "Someone already register using this email";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All field are required";
    die();
}
