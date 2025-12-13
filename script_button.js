// script_button.js

function checkPasskey() {
  const keyInput = document.getElementById("passkeyInput");
  const captchaBox = document.getElementById("captchaBox");
  const openButton = document.getElementById("myButton");
  const key = keyInput.value.trim();

  // Reset classes before each check
  captchaBox.classList.remove("glow-success", "glow-error", "shake");

  fetch("checkPasskey.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "passkey=" + encodeURIComponent(key)
  })
    .then(res => res.text())
    .then(data => {
      if (data === "success") {
        // Enable button + green glow
        openButton.disabled = false;
        captchaBox.classList.add("glow-success");
      } else {
        // Disable button + red glow + shake
        openButton.disabled = true;
        captchaBox.classList.add("glow-error", "shake");

        // Remove shake class after animation ends
        setTimeout(() => captchaBox.classList.remove("shake"), 400);
      }
    })
    .catch(err => console.error("Error:", err));
}

// Attach event listener to "Use Passkey" button
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("passkeyBtn").addEventListener("click", checkPasskey);
});
