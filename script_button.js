function checkPasskey() {
  const keyInput = document.getElementById("passkeyInput");
  const captchaBox = document.getElementById("captchaBox");
  const openButton = document.getElementById("myButton");
  const key = keyInput.value.trim();

  // Reset glow classes
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
        setTimeout(() => captchaBox.classList.remove("shake"), 400);
      }
    })
    .catch(err => console.error("Error:", err));
}

// Attach event listener to button
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("passkeyBtn").addEventListener("click", checkPasskey);

  const btn = document.getElementById("myButton");
  btn.addEventListener("mouseover", () => {
    if (!btn.disabled) {
      btn.style.backgroundColor = "#4CAF50";
    }
  });
  btn.addEventListener("mouseout", () => {
    btn.style.backgroundColor = "";
  });
});

