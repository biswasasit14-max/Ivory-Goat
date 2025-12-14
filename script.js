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
