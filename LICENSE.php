<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Website License & Terms</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #f9f9f9, #e8f5e9);
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .license-container {
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.15);
      max-width: 900px;
      width: 90%;
      animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      text-align: center;
      color: #2e7d32;
      margin-bottom: 25px;
      font-size: 2.2em;
      border-bottom: 2px solid #4CAF50;
      padding-bottom: 10px;
    }

    .license-text {
      background: #f4f4f4;
      padding: 25px;
      border-radius: 8px;
      font-family: Consolas, monospace;
      font-size: 1em;
      line-height: 1.6;
      overflow-x: auto;
      white-space: pre-wrap;
      word-wrap: break-word;
      color: #444;
    }

    .highlight {
      color: #4CAF50;
      font-weight: bold;
    }

    footer {
      text-align: center;
      margin-top: 25px;
      font-size: 0.9em;
      color: #555;
    }
    footer a {
      color: #4CAF50;
      text-decoration: none;
      margin: 0 8px;
    }
    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="license-container">
    <h1>Website License & Terms</h1>
    <div class="license-text">
      <p><span class="highlight">Copyright © 2025 Roupaswa</span></p>

      <p>This website and its content are provided under the MIT License. You are free to
      use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the
      content, provided that the original copyright notice and this permission notice are
      included in all copies or substantial portions of the website.</p>

      <p>The content is provided <span class="highlight">“as is”</span>, without warranty of any kind,
      express or implied, including but not limited to warranties of merchantability,
      fitness for a particular purpose, and noninfringement. In no event shall the authors
      or copyright holders be liable for any claim, damages, or other liability, whether
      in an action of contract, tort, or otherwise, arising from, out of, or in connection
      with the website or the use of its content.</p>
    </div>

    <footer>
      <p>© 2025 Roupaswa • <a href="#">Privacy Policy</a> • <a href="#">Terms of Use</a> • <a href="#">Contact</a></p>
    </footer>
  </div>
</body>
</html>
