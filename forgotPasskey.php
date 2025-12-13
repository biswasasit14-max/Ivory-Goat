<?php
// forgotPasskey.php
session_start();

// Generate a random temporary passkey
$tempPasskey = bin2hex(random_bytes(4)); // e.g., "a3f9b2c1"

// Store it with expiry (15 minutes from now)
$_SESSION['tempPasskey'] = $tempPasskey;
$_SESSION['tempExpiry'] = time() + (15 * 60);

// Return to client
echo $tempPasskey;
?>
