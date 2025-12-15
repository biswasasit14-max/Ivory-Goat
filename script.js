// script.js

document.addEventListener("DOMContentLoaded", () => {
  const captchaBox = document.getElementById("captchaBox");
  const passkeyBtn = document.getElementById("passkeyBtn");
  const openButton = document.getElementById("myButton");
  const keyInput = document.getElementById("passkeyInput");
  const statusMessage = document.getElementById("statusMessage");

  async function checkPasskey() {
    const key = keyInput.value.trim();
    captchaBox.classList.remove("glow-success", "glow-error", "shake");

    try {
      const res = await fetch("checkPasskey.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "passkey=" + encodeURIComponent(key)
      });
      const data = (await res.text()).trim();

      if (data === "success") {
        openButton.disabled = false;
        captchaBox.classList.add("glow-success");
        statusMessage.textContent = "Passkey accepted!";
        openButton.onclick = () => {
          window.location.href = "Home.php"; // or wherever you want to go
        };
      } else {
        openButton.disabled = true;
        captchaBox.classList.add("glow-error", "shake");
        statusMessage.textContent = "Wrong passkey!";
        setTimeout(() => captchaBox.classList.remove("shake"), 400);
      }
    } catch (err) {
      statusMessage.textContent = "Error contacting server.";
    }
  }

  passkeyBtn.addEventListener("click", checkPasskey);
  keyInput.addEventListener("keypress", e => {
    if (e.key === "Enter") checkPasskey();
  });
});
