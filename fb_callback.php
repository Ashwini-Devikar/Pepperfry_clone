<?php
session_start();
include "db_connect.php";

$app_id = "YOUR_FB_APP_ID";
$app_secret = "YOUR_FB_APP_SECRET";
$redirect_uri = "http://localhost/website_clone/fb_callback.php";

$code = $_GET['code'];

$token = json_decode(file_get_contents(
    "https://graph.facebook.com/v19.0/oauth/access_token?" .
    http_build_query([
        'client_id' => $app_id,
        'redirect_uri' => $redirect_uri,
        'client_secret' => $app_secret,
        'code' => $code
    ])
), true)['access_token'];

$user = json_decode(file_get_contents(
    "https://graph.facebook.com/me?fields=name,email&access_token=$token"
), true);

$email = $user['email'];
$name  = $user['name'];

$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn,
        "INSERT INTO users (name, email, login_type)
         VALUES ('$name','$email','facebook')"
    );
}

$_SESSION['user_email'] = $email;
header("Location: index.php");
exit();
