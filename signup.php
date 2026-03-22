<?php
session_start();
include "db_connect.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check existing email
$check = mysqli_query($conn,
"SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('User already exists'); window.location.href='index.php';</script>";
    exit();
}

// Insert user
mysqli_query($conn,
"INSERT INTO users (name,email,password)
 VALUES ('$name','$email','$password')");

// Session
$_SESSION['user_id'] = mysqli_insert_id($conn);
$_SESSION['user_name'] = $name;

header("Location: index.php");
exit();
