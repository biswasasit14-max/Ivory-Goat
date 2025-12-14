<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $secretKey = "YOUR_SECRET_KEY"; // from Google reCAPTCHA admin console
    $captchaResponse = $_POST['g-recaptcha-response'];

    // Verify with Google
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $secretKey,
        'response' => $captchaResponse,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $resultJson = json_decode($result);

    if ($resultJson->success) {
        echo "Captcha verified successfully. Passkey entered: " . htmlspecialchars($_POST['passkey']);
    } else {
        echo "Captcha verification failed. Please try again.";
    }
}
?>
