<?php
session_start();
include "db_connect.php";

$client_id = "YOUR_GOOGLE_CLIENT_ID";
$client_secret = "YOUR_GOOGLE_CLIENT_SECRET";
$redirect_uri = "http://localhost/website_clone/google_callback.php";

$code = $_GET['code'];

// Get access token
$response = file_get_contents("https://oauth2.googleapis.com/token", false,
stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query([
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code'
        ])
    ]
]));

$data = json_decode($response, true);
$token = $data['access_token'];

// Get user info
$user = json_decode(file_get_contents(
    "https://www.googleapis.com/oauth2/v2/userinfo?access_token=$token"
), true);

$email = $user['email'];
$name  = $user['name'];

// Save to DB if not exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn,
        "INSERT INTO users (name, email, login_type)
         VALUES ('$name','$email','google')"
    );
}

$_SESSION['user_email'] = $email;
header("Location: index.php");
exit();
