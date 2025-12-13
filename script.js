function checkPasskey() {
  const keyInput = document.getElementById("passkeyInput");
  const captchaBox = document.getElementById("captchaBox");
  const openButton = document.getElementById("myButton");
  const key = keyInput.value.trim();

  captchaBox.classList.remove("glow-success", "glow-error", "shake");

  fetch("checkPasskey.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "passkey=" + encodeURIComponent(key)
  })
    .then(res => res.text())
    .then(data => {
      if (data === "success") {
        openButton.disabled = false;
        captchaBox.classList.add("glow-success");
        openButton.onclick = () => {
          window.location.href = "Home.html";
        };
      } else {
        openButton.disabled = true;
        captchaBox.classList.add("glow-error", "shake");
        setTimeout(() => captchaBox.classList.remove("shake"), 400);
      }
    })
    .catch(err => console.error("Error:", err));
}

// Forgot Passkey handler
function forgotPasskey() {
  fetch("forgotPasskey.php")
    .then(res => res.text())
    .then(tempKey => {
      alert("Your temporary passkey is: " + tempKey + "\nIt will expire in 15 minutes.");
    })
    .catch(err => console.error("Error:", err));
}

document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("passkeyBtn").addEventListener("click", checkPasskey);
  document.getElementById("forgotBtn").addEventListener("click", forgotPasskey);

  const btn = document.getElementById("myButton");
  btn.addEventListener("mouseover", () => {
    if (!btn.disabled) btn.style.backgroundColor = "#4CAF50";
  });
  btn.addEventListener("mouseout", () => {
    btn.style.backgroundColor = "";
  });
});

document.getElementById("passkeyInput").addEventListener("keypress", (e) => {
  if (e.key === "Enter") checkPasskey();
});
