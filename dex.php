<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Secure Access Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Secure authentication portal for access. Enter your passkey to continue.">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <?php $scriptVersion = filemtime(__DIR__ . "/script.js"); ?>
  <style>
    :root{--green:#4CAF50;--greenD:#2e7d32;--red:#f44336;--fg:#333;--bg:#f9f9f9}
    *{box-sizing:border-box}body{font-family:Arial,Helvetica,sans-serif;margin:0;min-height:100vh;display:flex;flex-direction:column;background:var(--bg);color:var(--fg);text-align:center}
    h1{font-family:monospace;margin:0;padding:20px;color:#fff;background:linear-gradient(135deg,var(--green),var(--greenD));border-bottom:3px solid #45a049;box-shadow:0 2px 4px rgba(0,0,0,.2)}
    main{flex:1;display:flex;align-items:center;justify-content:center}
    .captchaBox{margin:40px auto;padding:24px;width:360px;background:#fff;border:1px solid #ddd;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.12);transition:box-shadow .3s}
    .input-group{display:flex;align-items:center;gap:10px;border:1px solid #aaa;border-radius:8px;padding:10px 12px;margin-top:12px;background:#fdfdfd;transition:border-color .2s,box-shadow .2s}
    .input-group:focus-within{border-color:var(--green);box-shadow:0 0 8px rgba(76,175,80,.35)}
    .input-group i{color:var(--green);font-size:1.1em}
    .input-group input{flex:1;border:0;outline:none;background:transparent;font-size:1em;padding:6px}
    .btn{margin-top:14px;padding:12px 18px;border:0;border-radius:8px;color:#fff;background:linear-gradient(135deg,var(--green),var(--greenD));font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .2s,transform .15s,box-shadow .2s}
    .btn:hover{background:linear-gradient(135deg,#45a049,#1b5e20);transform:translateY(-1px);box-shadow:0 4px 10px rgba(0,0,0,.2)}
    .btn:active{transform:scale(.98)}
    .btn:disabled{background:#ccc;color:#666;cursor:not-allowed;box-shadow:none}
    .get-passkey{display:inline-block;margin-top:12px;padding:10px 16px;border-radius:8px;color:#fff;text-decoration:none;background:linear-gradient(135deg,#2196F3,#1565C0)}
    .get-passkey:hover{background:linear-gradient(135deg,#1E88E5,#0D47A1);transform:translateY(-1px)}
    footer{background:#222;color:#ddd;padding:14px;font-size:.9em}
    @keyframes shake{0%,100%{transform:translateX(0)}20%{transform:translateX(-6px)}40%{transform:translateX(6px)}60%{transform:translateX(-6px)}80%{transform:translateX(6px)}}
    .shake{animation:shake .35s}
    @keyframes glowS{0%{box-shadow:0 0 12px 4px rgba(76,175,80,.75);border-color:var(--green)}70%{box-shadow:0 0 12px 4px rgba(76,175,80,.35)}100%{box-shadow:none;border-color:#aaa}}
    @keyframes glowE{0%{box-shadow:0 0 12px 4px rgba(244,67,54,.75);border-color:var(--red)}70%{box-shadow:0 0 12px 4px rgba(244,67,54,.35)}100%{box-shadow:none;border-color:#aaa}}
    .glow-success{animation:glowS 1.8s ease-out forwards}
    .glow-error{animation:glowE 1.8s ease-out forwards}
    @media(max-width:420px){.captchaBox{width:92%;padding:20px}}
  </style>
</head>
<body>
  <h1>Secure Access Portal</h1>
  <main>
    <div class="captchaBox" id="captchaBox">
      <div class="input-group">
        <label for="passkeyInput" class="sr-only">Passkey</label>
        <i class="fas fa-lock"></i>
        <input type="password" id="passkeyInput" placeholder="Enter Passkey" autocomplete="off" aria-describedby="statusMessage">
      </div>
      <button class="btn" id="passkeyBtn"><i class="fas fa-key"></i> Verify</button>
      <button class="btn" id="myButton" type="button" disabled><i class="fas fa-link"></i> Proceed</button>
      <p><a href="form.html" class="get-passkey"><i class="fas fa-external-link-alt"></i> Get Passkey</a></p>
      <div id="statusMessage" aria-live="polite"></div>
    </div>
  </main>
  <footer><p>&copy; 2025 Roupaswa All Rights Reserved.</p></footer>
  <script src="script.js?v=<?php echo $scriptVersion; ?>"></script>
</body>
</html>
