<?php
session_start();
include "db_connect.php";

$email = $_POST['email'];
$pass  = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($result) == 1) {

    $user = mysqli_fetch_assoc($result);

    if (password_verify($pass, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        header("Location: dashboard.php");
    } else {
        echo "Wrong password";
    }

} else {
    echo "User not found";
}
?>
