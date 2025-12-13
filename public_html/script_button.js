// Optional: Add hover or click effects for the Open Link button
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
