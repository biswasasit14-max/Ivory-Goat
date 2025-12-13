<?php
// checkPasskey.php
session_start();

$correctPasskey = "OPEN";
$userPasskey = $_POST["passkey"] ?? "";

if ($userPasskey === $correctPasskey) {
    echo "success";
} elseif (isset($_SESSION['tempPasskey'], $_SESSION['tempExpiry']) &&
          $userPasskey === $_SESSION['tempPasskey'] &&
          time() < $_SESSION['tempExpiry']) {
    echo "success";
} else {
    echo "fail";
}
?>


