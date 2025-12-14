<?php
// checkPasskey.php
session_start();

$correctPasskey = "OPEN";
$userPasskey = $_POST["passkey"] ?? "";

if ($userPasskey === $correctPasskey) {
    $_SESSION['authenticated'] = true; // mark user as logged in
    echo "success";
} else {
    echo "fail";
}
?>
