<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
require_once "functionSet.php";
if (trim($_SESSION['role'])!='admin') {
    header("Location: login.html");
    exit();
}

// Query all guests
$sql = "SELECT guest_id, event_title FROM guest ORDER BY guest_id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$guestResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?= sidebarShow("customer"); ?>
    <div class="container-fluid content flex-grow-1 p-5">
        <h2>Guest Management</h2><br>

       <?php
foreach ($guestResults as $row) {
    echo "<div class='list-group mb-3'>";
    echo "<div class='list-group-item'><b>Guest ID:</b> " 
        . htmlspecialchars($row['guest_id'] ?? '') . "</div>";

    // handle null event_title
    $eventTitle = $row['event_title'] ?? 'No event assigned';
    echo "<div class='list-group-item'><b>Event Title:</b> " 
        . htmlspecialchars($eventTitle) . "</div>";

    echo "</div>";
}
?>

    </div>
</div>
</body>
</html>
