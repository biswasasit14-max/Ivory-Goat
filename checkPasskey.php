<?php
// checkPasskey.php
session_start();

// Define the correct passkey
$correctPasskey = "OPEN";

// Get the passkey from POST
$userPasskey = $_POST["passkey"] ?? "";

// Simple check
if ($userPasskey === $correctPasskey) {
    $_SESSION['authenticated'] = true;
    echo "success";
} else {
    echo "fail";
}
?>
