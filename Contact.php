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
  <title>Contact Us</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #333;
      line-height: 1.6;
    }

    header {
      background-color: #4CAF50;
      color: white;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    header h1 {
      margin: 0;
      font-size: 2em;
    }

    main {
      max-width: 800px;
      margin: 30px auto;
      padding: 20px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    h2 {
      color: #4CAF50;
      margin-bottom: 15px;
      border-bottom: 2px solid #4CAF50;
      padding-bottom: 5px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin: 10px 0 5px;
      font-weight: bold;
    }

    input, textarea {
      padding: 10px;
      border: 1px solid #aaa;
      border-radius: 6px;
      font-size: 1em;
      transition: border-color 0.3s ease;
    }

    input:focus, textarea:focus {
      border-color: #4CAF50;
      outline: none;
    }

    textarea {
      resize: vertical;
      min-height: 120px;
    }

    .btn {
      margin-top: 15px;
      padding: 12px;
      background: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1em;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn:hover {
      background: #45a049;
      transform: scale(1.05);
    }

    .btn:active {
      background: #3e8e41;
      transform: scale(0.98);
    }

    footer {
      background-color: #222;
      color: #ccc;
      text-align: center;
      padding: 15px;
      font-size: 0.9em;
      position: fixed;
      bottom: 0;
      width: 100%;
      box-shadow: 0 -2px 6px rgba(0,0,0,0.2);
    }

    footer p {
      margin: 0;
    }
  </style>
</head>
<body>
  <header>
    <h1>Contact Us</h1>
  </header>

  <main>
    <h2>We’d love to hear from you!</h2>
    <form action="sendMessage.php" method="post">
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" required>

      <label for="subject">Subject</label>
      <input type="text" id="subject" name="subject" required>

      <label for="message">Message</label>
      <textarea id="message" name="message" required></textarea>

      <button type="submit" class="btn">Send Message</button>
    </form>
  </main>

  <footer>
    <p>© 2025 Your Company. All rights reserved.</p>
  </footer>
</body>
</html>
