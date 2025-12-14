// script.js

document.addEventListener("DOMContentLoaded", () => {
  const captchaBox = document.getElementById("captchaBox");
  const passkeyBtn = document.getElementById("passkeyBtn");
  const openButton = document.getElementById("myButton");
  const keyInput = document.getElementById("passkeyInput");
  const statusMessage = document.getElementById("statusMessage");

  function checkPasskey() {
    const key = keyInput.value.trim();

    // Read maxAttempts from hidden input or data attribute
    const maxAttempts = document.getElementById("maxAttempts")
      ? document.getElementById("maxAttempts").value
      : captchaBox.dataset.maxAttempts;

    captchaBox.classList.remove("glow-success", "glow-error", "shake");

    fetch("checkPasskey.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "passkey=" + encodeURIComponent(key) + "&maxAttempts=" + encodeURIComponent(maxAttempts)
    })
      .then(res => res.text())
      .then(data => {
        if (data === "success") {
          openButton.disabled = false;
          captchaBox.classList.add("glow-success");
          statusMessage.textContent = "Passkey accepted!";
          openButton.onclick = () => {
            window.location.href = "Home.php";
          };
        } else if (data.startsWith("timeout")) {
          const type = data.split(":")[1];
          // Redirect with query string so timeout.html knows the type
          window.location.href = "timeout.html?type=" + type;
        } else {
          openButton.disabled = true;
          captchaBox.classList.add("glow-error", "shake");
          statusMessage.textContent = "Wrong passkey!";
          setTimeout(() => captchaBox.classList.remove("shake"), 400);
        }
      })
      .catch(err => console.error("Error:", err));
  }

  passkeyBtn.addEventListener("click", checkPasskey);
  keyInput.addEventListener("keypress", e => {
    if (e.key === "Enter") checkPasskey();
  });
});
