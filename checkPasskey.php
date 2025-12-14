<?php
// checkPasskey.php
session_start();

$correctPasskey = "OPEN";
$userPasskey = $_POST["passkey"] ?? "";

// If lockout is active
if (isset($_SESSION['lockout_until']) && time() < $_SESSION['lockout_until']) {
    echo "timeout";
    exit;
}

if ($userPasskey === $correctPasskey) {
    $_SESSION['authenticated'] = true;
    unset($_SESSION['failed_attempts']);
    unset($_SESSION['lockout_until']);
    echo "success";
} else {
    // Track failed attempts
    if (!isset($_SESSION['failed_attempts'])) {
        $_SESSION['failed_attempts'] = 0;
    }
    $_SESSION['failed_attempts']++;

    if ($_SESSION['failed_attempts'] >= 3) {
        // Lock out for 3 minutes
        $_SESSION['lockout_until'] = time() + 180;
        echo "timeout";
    } else {
        echo "fail";
    }
}
?>
