<?php
include "db_connect.php";

$name  = $_POST['name'];
$email = $_POST['email'];
$pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password)
        VALUES ('$name', '$email', '$pass')";

if (mysqli_query($conn, $sql)) {
    header("Location: login.php");
} else {
    echo "Email already exists";
}
?>
