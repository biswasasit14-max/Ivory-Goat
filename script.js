// script.js

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

        // Redirect randomly to Home.html or Directory.html when clicked
        openButton.onclick = () => {
          const randomChoice = Math.random() < 0.5 ? "Home.html" : "Directory.html";
          window.location.href = randomChoice;
        };
      } else {
        // Disable button + red glow + shake
        openButton.disabled = true;
        captchaBox.classList.add("glow-error", "shake");

        // Remove shake after animation
        setTimeout(() => captchaBox.classList.remove("shake"), 400);
      }
    })
    .catch(err => console.error("Error:", err));
}

// Attach event listeners after DOM loads
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

  // Allow pressing Enter to trigger check
  document.getElementById("passkeyInput").addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      checkPasskey();
    }
  });
});
