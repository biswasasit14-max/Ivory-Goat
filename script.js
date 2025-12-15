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

    captchaBox.classList.remove("glow-success", "
