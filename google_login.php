<?php
$client_id = "YOUR_GOOGLE_CLIENT_ID";
$redirect_uri = "http://localhost/website_clone/google_callback.php";

$url = "https://accounts.google.com/o/oauth2/v2/auth?" .
http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code', 
    'scope' => 'email profile'
]);

header("Location: $url");
exit();
