<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $secretKey = "6Ld9AiYsAAAAANwUyJyKehlcVXhoQXXEQ095QD_Z"; // from Google reCAPTCHA admin
    $responseKey = $_POST["g-recaptcha-response"];
    $userIP = $_SERVER["REMOTE_ADDR"];

    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verifyUrl."?secret=".$secretKey."&response=".$responseKey."&remoteip=".$userIP);
    $responseData = json_decode($response);

    if ($responseData->success) {
        echo "success";
    } else {
        echo "failure";
    }
}
?>
