// script.js

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
                window.location.href = "Home.php";
            };
        } else if (data === "timeout") {
            // Redirect to timeout page
            window.location.href = "timeout.html";
        } else {
            openButton.disabled = true;
            captchaBox.classList.add("glow-error", "shake");
            setTimeout(() => captchaBox.classList.remove("shake"), 400);
        }
    })
    .catch(err => console.error("Error:", err));
}

// Attach event listeners
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("passkeyBtn").addEventListener("click", checkPasskey);

    const btn = document.getElementById("myButton");
    btn.addEventListener("mouseover", () => {
        if (!btn.disabled) btn.style.backgroundColor = "#4CAF50";
    });
    btn.addEventListener("mouseout", () => {
        btn.style.backgroundColor = "";
    });

    document.getElementById("passkeyInput").addEventListener("keypress", (e) => {
        if (e.key === "Enter") {
            checkPasskey();
        }
    });
});
