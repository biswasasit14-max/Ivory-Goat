let solution = null;
        // Set your secret passkey here

        const PASSKEY = "OPEN";

        // Check passkey input (case-sensitive)
        function checkPasskey() {
  const key = document.getElementById("passkeyInput").value.trim();

  if (key.toUpperCase() === "OPEN") {
    // Enable the Open Link button
    document.getElementById("myButton").disabled = false;
    alert("Passkey accepted! You can now open the link.");
  } else {
    alert("Invalid passkey. Try again.");
  }
}