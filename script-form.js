// script-form.js
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("detailsForm");
  const resultBox = document.getElementById("result");

  // Fixed passkey
  const fixedPasskey = "OPEN";

  form.addEventListener("submit", (event) => {
    event.preventDefault(); // stop page reload

    const name = document.getElementById("name").value.trim();

    // Show result with copy button
    resultBox.innerHTML = `
      Thank you, <strong>${name}</strong>!<br>
      Your passkey for the website is:<br>
      <span id="passkey" style="font-size:22px; color:#059669;">${fixedPasskey}</span><br>
      <button class="copy-btn" id="copyBtn">Copy to Clipboard</button>
    `;

    // Trigger slide-up animation
    resultBox.classList.remove("show-result"); // reset if already shown
    void resultBox.offsetWidth; // force reflow
    resultBox.classList.add("show-result");

    // Add copy functionality
    const copyBtn = document.getElementById("copyBtn");
    copyBtn.addEventListener("click", () => {
      const passkeyText = document.getElementById("passkey").textContent;
      navigator.clipboard.writeText(passkeyText).then(() => {
        copyBtn.textContent = "Copied!";
        copyBtn.style.background = "#34d399"; // brighter green
        setTimeout(() => {
          copyBtn.textContent = "Copy to Clipboard";
          copyBtn.style.background = "#86efac"; // reset
        }, 2000);
      });
    });
  });
});
