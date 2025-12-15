<?php
// index.php
$scriptVersion = filemtime(__DIR__ . "/script.js");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Secure Access Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body{font-family:Arial,Helvetica,sans-serif;margin:0;min-height:100vh;display:flex;flex-direction:column;background:#f9f9f9;color:#333;text-align:center}
    h1{margin:0;padding:20px;color:#fff;background:linear-gradient(135deg,#4CAF50,#2e7d32);font-family:monospace}
    main{flex:1;display:flex;align-items:center;justify-content:center}
    .box{margin:40px auto;padding:24px;width:340px;background:#fff;border:1px solid #ddd;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.12)}
    .input-group{display:flex;align-items:center;gap:10px;border:1px solid #aaa;border-radius:8px;padding:10px;margin-top:12px}
    .input-group:focus-within{border-color:#4CAF50;box-shadow:0 0 8px rgba(76,175,80,.35)}
    .input-group i{color:#4CAF50}
    .input-group input{flex:1;border:0;outline:none}
    .btn{margin-top:14px;padding:12px;border:0;border-radius:8px;color:#fff;background:linear-gradient(135deg,#4CAF50,#2e7d32);cursor:pointer;font-weight:600;width:100%;display:flex;align-items:center;justify-content:center;gap:8px}
    .btn:disabled{background:#ccc;color:#666;cursor:not-allowed}
    footer{background:#222;color:#ddd;padding:14px;font-size:.9em}
    @keyframes shake{0%,100%{transform:translateX(0)}20%{transform:translateX(-6px)}40%{transform:translateX(6px)}60%{transform:translateX(-6px)}80%{transform:translateX(6px)}}
    .shake{animation:shake .35s}
    @keyframes glowS{0%{box-shadow:0 0 12px 4px rgba(76,175,80,.75);border-color:#4CAF50}70%{box-shadow:0 0 12px 4px rgba(76,175,80,.35)}100%{box-shadow:none;border-color:#aaa}}
    @keyframes glowE{0%{box-shadow:0 0 12px 4px rgba(244,67,54,.75);border-color:#f44336}70%{box-shadow:0 0 12px 4px rgba(244,67,54,.35)}100%{box-shadow:none;border-color:#aaa}}
    .glow-success{animation:glowS 1.8s ease-out forwards}
    .glow-error{animation:glowE 1.8s ease-out forwards}
  </style>
</head>
<body>
  <h1>Secure Access Portal</h1>
  <main>
    <div class="box" id="captchaBox">
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" id="passkeyInput" placeholder="Enter Passkey" autocomplete="off">
      </div>
      <button class="btn" id="passkeyBtn"><i class="fas fa-key"></i> Verify</button>
      <button class="btn" id="myButton" type="button" disabled><i class="fas fa-link"></i> Proceed</button>
      <div id="statusMessage" aria-live="polite"></div>
    </div>
  </main>
  <footer><p>&copy; 2025 Roupaswa All Rights Reserved.</p></footer>
  <script src="script.js?v=<?php echo $scriptVersion; ?>"></script>
</body>
</html>
