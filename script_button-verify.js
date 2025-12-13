document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("myButton");

  btn.addEventListener("mouseover", () => {
    if (!btn.disabled) {
      btn.style.backgroundColor = "#4CAF50";
    }
  });

  btn.addEventListener("mouseout", () => {
    btn.style.backgroundColor = "";
  });
});
