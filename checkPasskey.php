<?php
// checkPasskey.php
session_start();

// Define the correct passkey
$correctPasskey = "OPEN";

// Get and sanitize the passkey from POST
$userPasskey = isset($_POST["passkey"]) ? trim($_POST["passkey"]) : "";

// Case-insensitive comparison
if (strcasecmp($userPasskey, $correctPasskey) === 0) {
    $_SESSION['authenticated'] = true;
    echo "success";
    exit;
} else {
    echo "fail";
    exit;
}
?>
