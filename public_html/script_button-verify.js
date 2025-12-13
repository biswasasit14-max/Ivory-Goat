// script_button.js

function checkPasskey() {
  const keyInput = document.getElementById("passkeyInput");
  const key = keyInput.value.trim();

  fetch("checkPasskey.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "passkey=" + encodeURIComponent(key)
  })
    .then(res => res.text())
    .then(data => {
      if (data === "success") {
        document.getElementById("myButton").disabled = false;
        alert("Passkey accepted! You can now open the link.");
      } else {
        alert("Invalid passkey. Try again.");

        // Trigger shake animation
        keyInput.classList.add("shake");
        setTimeout(() => keyInput.classList.remove("shake"), 400);
      }
    })
    .catch(err => console.error("Error:", err));
}

// ------------------------------
// Optional: Hover/click effects for the Open Link button
// ------------------------------
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("myButton");

  btn.addEventListener("mouseover", () => {
    if (!btn.disabled) {
      btn.style.backgroundColor = "#4CAF50"; // green highlight
    }
  });

  btn.addEventListener("mouseout", () => {
    btn.style.backgroundColor = ""; // reset
  });

  btn.addEventListener("click", () => {
    if (btn.disabled) {
      alert("You must enter the correct passkey first!");
    }
  });
});
