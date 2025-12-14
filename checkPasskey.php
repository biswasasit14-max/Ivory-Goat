<?php
// checkPasskey.php
session_start();

$correctPasskey = "OPEN";
$userPasskey = $_POST["passkey"] ?? "";
$clientIp = $_SERVER['REMOTE_ADDR'];

// Path to JSON file
$blockFile = __DIR__ . "/blocked_ips.json";
if (!file_exists($blockFile)) {
    file_put_contents($blockFile, json_encode([]));
}
$blockedIps = json_decode(file_get_contents($blockFile), true);

// If IP is already blocked
if (isset($blockedIps[$clientIp]) && time() < $blockedIps[$clientIp]) {
    echo "timeout";
    exit;
}

// Correct passkey
if ($userPasskey === $correctPasskey) {
    $_SESSION['authenticated'] = true;
    unset($_SESSION['failed_attempts']);
    echo "success";
} else {
    // Track failed attempts in session
    if (!isset($_SESSION['failed_attempts'])) {
        $_SESSION['failed_attempts'] = 0;
    }
    $_SESSION['failed_attempts']++;

    if ($_SESSION['failed_attempts'] > 10) {
        // Block IP for 2 weeks (14 days)
        $blockedIps[$clientIp] = time() + (14 * 24 * 60 * 60);
        file_put_contents($blockFile, json_encode($blockedIps));
        echo "timeout";
    } else {
        echo "fail";
    }
}
?>
