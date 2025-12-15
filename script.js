// script.js

document.addEventListener("DOMContentLoaded", () => {
  const captchaBox = document.getElementById("captchaBox");
  const passkeyBtn = document.getElementById("passkeyBtn");
  const openButton = document.getElementById("myButton");
  const keyInput = document.getElementById("passkeyInput");
  const statusMessage = document.getElementById("statusMessage");

  async function checkPasskey() {
    const key = keyInput.value.trim();
    if (!key) {
      statusMessage.textContent = "Please enter a passkey.";
      return;
    }

    captchaBox.classList.remove("glow-success", "glow-error", "shake");
    passkeyBtn.disabled = true;

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
          window.location.href = "Home.php";
        };
      } else if (data === "fail") {
        openButton.disabled = true;
        captchaBox.classList.add("glow-error", "shake");
        statusMessage.textContent = "Wrong passkey!";
        setTimeout(() => captchaBox.classList.remove("shake"), 400);
      } else {
        statusMessage.textContent = "Unexpected response: " + data;
      }
    } catch (err) {
      statusMessage.textContent = "Error contacting server.";
    } finally {
      passkeyBtn.disabled = false;
    }
  }

  passkeyBtn.addEventListener("click", checkPasskey);
  keyInput.addEventListener("keypress", e => {
    if (e.key === "Enter") checkPasskey();
  });
});
