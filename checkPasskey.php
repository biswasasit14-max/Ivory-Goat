<?php
// checkPasskey.php
session_start();

$correctPasskey = "OPEN";
$userPasskey = $_POST["passkey"] ?? "";

if ($userPasskey === $correctPasskey) {
    echo "success";
} else {
    echo "fail";
}
?>
