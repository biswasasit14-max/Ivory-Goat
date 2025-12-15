<?php
// blocked_viewer.php

$blockFile = __DIR__ . "/blocked_ips.json";
$archiveFile = __DIR__ . "/archived_ips.json";

// Load files
$blockedIps = file_exists($blockFile) ? json_decode(file_get_contents($blockFile), true) : [];
$archivedIps = file_exists($archiveFile) ? json_decode(file_get_contents($archiveFile), true) : [];

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Archive expired
    if (isset($_POST['archive_expired'])) {
        foreach ($blockedIps as $ip => $info) {
            if (time() >= $info['expiry']) {
                $archivedIps[$ip] = $info;
                unset($blockedIps[$ip]);
            }
        }
    }

    // Archive before date
    if (isset($_POST['archive_before'])) {
        $date = strtotime($_POST['archive_before']);
        foreach ($blockedIps as $ip => $info) {
            if (strtotime($info['blocked_at']) < $date) {
                $archivedIps[$ip] = $info;
                unset($blockedIps[$ip]);
            }
        }
    }

    // Delete selected
    if (isset($_POST['selected_ips'])) {
        foreach ($_POST['selected_ips'] as $ip) {
            unset($blockedIps[$ip]);
        }
    }

    // Save files
    file_put_contents($blockFile, json_encode($blockedIps, JSON_PRETTY_PRINT));
    file_put_contents($archiveFile, json_encode($archivedIps, JSON_PRETTY_PRINT));
    header("Location: blocked_viewer.php");
    exit;
}

// --- Filtering ---
$search = $_GET['search'] ?? '';
if ($search) {
    $blockedIps = array_filter($blockedIps, function($info, $ip) use ($search) {
        return stripos($ip, $search) !== false ||
               stripos($info['country'], $search) !== false ||
               stripos($info['state'], $search) !== false;
    }, ARRAY_FILTER_USE_BOTH);
}

// --- Sorting ---
$sort = $_GET['sort'] ?? 'blocked_at';
$order = $_GET['order'] ?? 'asc';
usort($blockedIps, function($a, $b) use ($sort, $order) {
    $valA = $a[$sort] ?? '';
    $valB = $b[$sort] ?? '';
    if ($sort === 'expiry' || $sort === 'attempts') {
        $valA = (int)$valA;
        $valB = (int)$valB;
    } else {
        $valA = strtotime($valA);
        $valB = strtotime($valB);
    }
    return $order === 'asc' ? $valA <=> $valB : $valB <=> $valA;
});

// --- Pagination ---
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 50;
$total = count($blockedIps);
$totalPages = ceil($total / $perPage);
$blockedIps = array_slice($blockedIps, ($page-1)*$perPage, $perPage, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blocked IPs Viewer</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f9f9f9; padding:40px; }
    h1 { color:#cc0000; }
    table { width:100%; border-collapse:collapse; background:#fff; box-shadow:0 0 10px rgba(0,0,0,0.1); }
    th, td { padding:10px; border:1px solid #ddd; }
    th { background:#cc0000; color:#fff; cursor:pointer; }
    tr:nth-child(even){ background:#f2f2f2; }
    .btn { padding:6px 12px; border:none; border-radius:4px; cursor:pointer; font-size:0.9em; }
    .btn-action { background:#007bff; color:#fff; margin:5px; }
    .btn-delete { background:#dc3545; color:#fff; }
    .pagination a { margin:0 5px; text-decoration:none; }
    .search-bar { margin-bottom:20px; }
  </style>
  <script>
    function confirmAction(msg) { return confirm(msg); }
  </script>
</head>
<body>
  <h1>Blocked IPs</h1>

  <form method="get" class="search-bar">
    <input type="text" name="search" placeholder="Search IP, country, state" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit" class="btn btn-action">Search</button>
  </form>

  <form method="post" onsubmit="return confirmAction('Are you sure?')">
    <button type="submit" name="archive_expired" class="btn btn-action">Archive Expired</button>
    <input type="date" name="archive_before">
    <button type="submit" class="btn btn-action">Archive Before Date</button>

    <?php if (!empty($blockedIps)): ?>
      <table>
        <thead>
          <tr>
            <th>Select</th>
            <th><a href="?sort=ip&order=<?php echo $order==='asc'?'desc':'asc'; ?>">IP Address</a></th>
            <th><a href="?sort=blocked_at&order=<?php echo $order==='asc'?'desc':'asc'; ?>">Blocked At</a></th>
            <th><a href="?sort=expiry&order=<?php echo $order==='asc'?'desc':'asc'; ?>">Expiry</a></th>
            <th><a href="?sort=attempts&order=<?php echo $order==='asc'?'desc':'asc'; ?>">Attempts</a></th>
            <th><a href="?sort=country&order=<?php echo $order==='asc'?'desc':'asc'; ?>">Country</a></th>
            <th><a href="?sort=state&order=<?php echo $order==='asc'?'desc':'asc'; ?>">State</a></th>
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
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <button type="submit" class="btn btn-delete" onclick="return confirmAction('Delete selected IPs?')">Delete Selected</button>
    <?php else: ?>
      <p>No blocked IPs found.</p>
    <?php endif; ?>
  </form>

  <div class="pagination">
    <?php for ($i=1; $i<=$totalPages; $i++): ?>
      <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&sort=<?php echo urlencode($sort); ?>&order=<?php echo urlencode($order); ?>">
        <?php echo $i; ?>
      </a>
    <?php endfor; ?>
  </div>
</body>
</html>
