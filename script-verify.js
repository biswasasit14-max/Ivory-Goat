document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("secureForm");

  form.addEventListener("submit", (event) => {
    const response = grecaptcha.getResponse();
    if (!response) {
      event.preventDefault();
      alert("Please complete the captcha before submitting.");
    }
  });
});
