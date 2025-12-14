<?php
// blocked_viewer.php

$blockFile = __DIR__ . "/blocked_ips.json";
$blockedIps = [];

// Load file if exists
if (file_exists($blockFile)) {
    $blockedIps = json_decode(file_get_contents($blockFile), true);
}

// Handle clear expired request
if (isset($_POST['clear_expired'])) {
    foreach ($blockedIps as $ip => $info) {
        if (time() >= $info['expiry']) {
            unset($blockedIps[$ip]);
        }
    }
    file_put_contents($blockFile, json_encode($blockedIps, JSON_PRETTY_PRINT));
    // Reload after cleanup
    header("Location: blocked_viewer.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blocked IPs Viewer</title>
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background: #f9f9f9;
      padding: 40px;
      color: #333;
    }
    h1 {
      color: #cc0000;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background: #cc0000;
      color: #fff;
    }
    tr:nth-child(even) {
      background: #f2f2f2;
    }
    .expired {
      color: #999;
    }
    .btn {
      margin-top: 20px;
      padding: 10px 20px;
      background: #28a745;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover {
      background: #218838;
    }
  </style>
</head>
<body>
  <h1>Blocked IPs</h1>
  <?php if (!empty($blockedIps)): ?>
    <form method="post">
      <button type="submit" name="clear_expired" class="btn">Clear Expired Entries</button>
    </form>
    <table>
      <thead>
        <tr>
          <th>IP Address</th>
          <th>Blocked At</th>
          <th>Expiry</th>
          <th>Attempts</th>
          <th>Country</th>
          <th>State</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($blockedIps as $ip => $info): ?>
          <tr class="<?php echo (time() >= $info['expiry']) ? 'expired' : ''; ?>">
            <td><?php echo htmlspecialchars($ip); ?></td>
            <td><?php echo htmlspecialchars($info['blocked_at']); ?></td>
            <td><?php echo date("Y-m-d H:i:s", $info['expiry']); ?></td>
            <td><?php echo htmlspecialchars($info['attempts']); ?></td>
            <td><?php echo htmlspecialchars($info['country']); ?></td>
            <td><?php echo htmlspecialchars($info['state']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No blocked IPs found.</p>
  <?php endif; ?>
</body>
</html>
