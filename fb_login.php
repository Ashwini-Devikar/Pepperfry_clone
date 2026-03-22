<?php
$app_id = "YOUR_FB_APP_ID";
$redirect_uri = "http://localhost/website_clone/fb_callback.php";

$url = "https://www.facebook.com/v19.0/dialog/oauth?" .
http_build_query([
    'client_id' => $app_id,
    'redirect_uri' => $redirect_uri,
    'scope' => 'email,public_profile'
]);

header("Location: $url");
exit();
