<?php
// checkPasskey.php
session_start();

$correctPasskey = "OPEN";
$userPasskey = $_POST["passkey"] ?? "";
$clientIp = $_SERVER['REMOTE_ADDR'];

// Configurable thresholds
$sessionMaxAttempts = isset($_POST['maxAttempts']) ? (int)$_POST['maxAttempts'] : 3; // short lockout
$ipMaxAttempts = 10; // persistent ban threshold
$sessionLockoutDuration = 180; // 3 minutes
$ipLockoutDuration = 14 * 24 * 60 * 60; // 2 weeks

// Path to JSON file
$blockFile = __DIR__ . "/blocked_ips.json";
if (!file_exists($blockFile)) {
    file_put_contents($blockFile, json_encode([]));
}
$blockedIps = json_decode(file_get_contents($blockFile), true);

// --- Cleanup expired IPs ---
foreach ($blockedIps as $ip => $info) {
    if (time() >= $info['expiry']) {
        unset($blockedIps[$ip]);
    }
}
file_put_contents($blockFile, json_encode($blockedIps, JSON_PRETTY_PRINT));

// --- Check if current IP is blocked ---
if (isset($blockedIps[$clientIp]) && time() < $blockedIps[$clientIp]['expiry']) {
    echo "timeout";
    exit;
}

// --- Passkey check ---
if ($userPasskey === $correctPasskey) {
    $_SESSION['authenticated'] = true;
    $_SESSION['failed_attempts'] = 0; // reset
    echo "success";
} else {
    if (!isset($_SESSION['failed_attempts'])) {
        $_SESSION['failed_attempts'] = 0;
    }
    $_SESSION['failed_attempts']++;

    // Persistent ban after ipMaxAttempts
    if ($_SESSION['failed_attempts'] > $ipMaxAttempts) {
        $expiry = time() + $ipLockoutDuration;

        // Optional: get location info
        $location = @file_get_contents("http://ipinfo.io/{$clientIp}/json");
        $locationData = $location ? json_decode($location, true) : [];
        $country = $locationData['country'] ?? "Unknown";
        $region  = $locationData['region'] ?? "Unknown";

        $blockedIps[$clientIp] = [
            'expiry' => $expiry,
            'blocked_at' => date("Y-m-d H:i:s"),
            'attempts' => $_SESSION['failed_attempts'],
            'country' => $country,
            'state' => $region
        ];

        file_put_contents($blockFile, json_encode($blockedIps, JSON_PRETTY_PRINT));
        echo "timeout";
    }
    // Short session lockout
    elseif ($_SESSION['failed_attempts'] >= $sessionMaxAttempts) {
        $_SESSION['lockout_until'] = time() + $sessionLockoutDuration;
        echo "timeout";
    } else {
        echo "fail";
    }
}
?>
