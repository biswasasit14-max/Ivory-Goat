<?php
// blocked_viewer.php

$blockFile = __DIR__ . "/blocked_ips.json";
$blockedIps = [];

if (file_exists($blockFile)) {
    $blockedIps = json_decode(file_get_contents($blockFile), true);
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete one IP
    if (isset($_POST['delete_ip'])) {
        $ip = $_POST['delete_ip'];
        unset($blockedIps[$ip]);
    }

    // Clear all
    if (isset($_POST['clear_all'])) {
        $blockedIps = [];
    }

    // Clear expired
    if (isset($_POST['clear_expired'])) {
        foreach ($blockedIps as $ip => $info) {
            if (time() >= $info['expiry']) {
                unset($blockedIps[$ip]);
            }
        }
    }

    // Clear by country
    if (isset($_POST['clear_country'])) {
        $country = $_POST['clear_country'];
        foreach ($blockedIps as $ip => $info) {
            if (strcasecmp($info['country'], $country) === 0) {
                unset($blockedIps[$ip]);
            }
        }
    }

    // Clear by state
    if (isset($_POST['clear_state'])) {
        $state = $_POST['clear_state'];
        foreach ($blockedIps as $ip => $info) {
            if (strcasecmp($info['state'], $state) === 0) {
                unset($blockedIps[$ip]);
            }
        }
    }

    // Clear older than date
    if (isset($_POST['clear_before'])) {
        $date = strtotime($_POST['clear_before']);
        foreach ($blockedIps as $ip => $info) {
            if (strtotime($info['blocked_at']) < $date) {
                unset($blockedIps[$ip]);
            }
        }
    }

    // Bulk delete selected
    if (isset($_POST['selected_ips'])) {
        foreach ($_POST['selected_ips'] as $ip) {
            unset($blockedIps[$ip]);
        }
    }

    file_put_contents($blockFile, json_encode($blockedIps, JSON_PRETTY_PRINT));
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
    body { font-family: "Segoe UI", Arial, sans-serif; background:#f9f9f9; padding:40px; }
    h1 { color:#cc0000; }
    table { width:100%; border-collapse:collapse; background:#fff; box-shadow:0 0 10px rgba(0,0,0,0.1); }
    th, td { padding:10px; border:1px solid #ddd; }
    th { background:#cc0000; color:#fff; }
    tr:nth-child(even){ background:#f2f2f2; }
    .btn { padding:6px 12px; border:none; border-radius:4px; cursor:pointer; font-size:0.9em; }
    .btn-delete { background:#dc3545; color:#fff; }
    .btn-clear { background:#007bff; color:#fff; margin:5px; }
    .btn:hover { opacity:0.85; }
  </style>
  <script>
    function confirmAction(msg) {
      return confirm(msg);
    }
  </script>
</head>
<body>
  <h1>Blocked IPs</h1>

  <?php if (!empty($blockedIps)): ?>
    <form method="post" onsubmit="return confirmAction('Are you sure? This cannot be undone.')">
      <button type="submit" name="clear_all" class="btn btn-clear">Clear All</button>
      <button type="submit" name="clear_expired" class="btn btn-clear">Clear Expired</button>
      <input type="text" name="clear_country" placeholder="Country code">
      <button type="submit" class="btn btn-clear">Clear by Country</button>
      <input type="text" name="clear_state" placeholder="State/Region">
      <button type="submit" class="btn btn-clear">Clear by State</button>
      <input type="date" name="clear_before">
      <button type="submit" class="btn btn-clear">Clear Before Date</button>

      <table>
        <thead>
          <tr>
            <th>Select</th>
            <th>IP Address</th>
            <th>Blocked At</th>
            <th>Expiry</th>
            <th>Attempts</th>
            <th>Country</th>
            <th>State</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($blockedIps as $ip => $info): ?>
            <tr>
              <td><input type="checkbox" name="selected_ips[]" value="<?php echo htmlspecialchars($ip); ?>"></td>
              <td><?php echo htmlspecialchars($ip); ?></td>
              <td><?php echo htmlspecialchars($info['blocked_at']); ?></td>
              <td><?php echo date("Y-m-d H:i:s", $info['expiry']); ?></td>
              <td><?php echo htmlspecialchars($info['attempts']); ?></td>
              <td><?php echo htmlspecialchars($info['country']); ?></td>
              <td><?php echo htmlspecialchars($info['state']); ?></td>
              <td>
                <button type="submit" name="delete_ip" value="<?php echo htmlspecialchars($ip); ?>" class="btn btn-delete" onclick="return confirmAction('Delete IP <?php echo $ip; ?>?')">Delete</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <button type="submit" class="btn btn-clear" onclick="return confirmAction('Delete selected IPs?')">Delete Selected</button>
    </form>
  <?php else: ?>
    <p>No blocked IPs found.</p>
  <?php endif; ?>
</body>
</html>
