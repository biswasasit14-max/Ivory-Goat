// script.js
document.addEventListener("DOMContentLoaded", () => {
  const box = document.getElementById("captchaBox");
  const verifyBtn = document.getElementById("passkeyBtn");
  const proceedBtn = document.getElementById("myButton");
  const input = document.getElementById("passkeyInput");
  const status = document.getElementById("statusMessage");

  function clearVisuals() {
    box.classList.remove("glow-success", "glow-error", "shake");
    status.textContent = "";
  }

  async function checkPasskey() {
    const key = input.value.trim();
    clearVisuals();
    if (!key) { status.textContent = "Please enter a passkey."; return; }

    verifyBtn.disabled = true;
    try {
      const res = await fetch("checkPasskey.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "passkey=" + encodeURIComponent(key)
      });
      const data = (await res.text()).trim();
      if (data === "success") {
        proceedBtn.disabled = false;
        box.classList.add("glow-success");
        status.textContent = "Passkey accepted!";
        proceedBtn.onclick = () => { window.location.href = "Home.php"; };
      } else {
        proceedBtn.disabled = true;
        box.classList.add("glow-error", "shake");
        status.textContent = "Wrong passkey!";
        setTimeout(() => box.classList.remove("shake"), 350);
      }
    } catch {
      proceedBtn.disabled = true;
      box.classList.add("glow-error", "shake");
      status.textContent = "Network error. Try again.";
      setTimeout(() => box.classList.remove("shake"), 350);
    } finally {
      verifyBtn.disabled = false;
    }
  }

  verifyBtn.addEventListener("click", checkPasskey);
  input.addEventListener("keypress", e => { if (e.key === "Enter") checkPasskey(); });
  input.addEventListener("input", () => { box.classList.remove("glow-success","glow-error"); status.textContent = ""; proceedBtn.disabled = true; });
});
