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

// --- Cleanup expired IPs ---
foreach ($blockedIps as $ip => $info) {
    if (time() >= $info['expiry']) {
        unset($blockedIps[$ip]);
    }
}
file_put_contents($blockFile, json_encode($blockedIps));

// --- Check if current IP is blocked ---
if (isset($blockedIps[$clientIp]) && time() < $blockedIps[$clientIp]['expiry']) {
    echo "timeout";
    exit;
}

// --- Passkey check ---
if ($userPasskey === $correctPasskey) {
    $_SESSION['authenticated'] = true;
    unset($_SESSION['failed_attempts']);
    echo "success";
} else {
    if (!isset($_SESSION['failed_attempts'])) {
        $_SESSION['failed_attempts'] = 0;
    }
    $_SESSION['failed_attempts']++;

    if ($_SESSION['failed_attempts'] > 10) {
        // Block IP for 2 weeks (14 days)
        $expiry = time() + (14 * 24 * 60 * 60);

        // Get location info (basic example using ipinfo.io)
        $location = @file_get_contents("http://ipinfo.io/{$clientIp}/json");
        $locationData = $location ? json_decode($location, true) : [];
        $country = $locationData['country'] ?? "Unknown";
        $region  = $locationData['region'] ?? "Unknown";

        // Save metadata
        $blockedIps[$clientIp] = [
            'expiry' => $expiry,
            'blocked_at' => date("Y-m-d H:i:s"),
            'attempts' => $_SESSION['failed_attempts'],
            'country' => $country,
            'state' => $region
        ];

        file_put_contents($blockFile, json_encode($blockedIps, JSON_PRETTY_PRINT));
        echo "timeout";
    } else {
        echo "fail";
    }
}
?>
