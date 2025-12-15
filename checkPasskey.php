<?php
// checkPasskey.php
session_start();

$correctPasskey = "OPEN";
$userPasskey = isset($_POST["passkey"]) ? trim($_POST["passkey"]) : "";

if ($userPasskey !== "" && strcasecmp($userPasskey, $correctPasskey) === 0) {
    $_SESSION['authenticated'] = true;
    echo "success";
    exit;
}
echo "fail";
exit;
