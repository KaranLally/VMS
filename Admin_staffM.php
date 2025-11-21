<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
require_once "functionSet.php";
if (trim($_SESSION['role'])!='admin') {
    header("Location: login.html");
    exit();
}$sql = "
    SELECT s.staff_id, s.staff_name, s.position,
           c.start_date, c.end_date,
           ec.contact_name, ec.contact_phone_num, ec.relationship,
           sup.supervisor_id, sup.supervisor_pos, sup.staff_pos,
           w.event_id
    FROM staff s
    LEFT JOIN contractor c ON s.staff_id = c.staff_id
    LEFT JOIN emergency_contact ec ON s.staff_id = ec.staff_id
    LEFT JOIN supervisor sup ON s.staff_id = sup.staff_id
    LEFT JOIN works w ON s.staff_id = w.staff_id
    ORDER BY s.staff_id;
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$staffResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Manager</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body>
<div class="d-flex">
  <?= sidebarShow("staff"); ?>
  <div class="container-fluid content flex-grow-1 p-5">
    <h2>Staff Management</h2><br>

    <?php
    if (empty($staffResults)) {
        echo "<div class='alert alert-warning'>No staff records found</div>";
    } else {
        foreach ($staffResults as $row) {
            echo "<div class='list-group mb-3'>";
            echo "<div class='list-group-item'><b>Staff ID:</b> " . htmlspecialchars($row['staff_id']) . "</div>";
            echo "<div class='list-group-item'><b>Name:</b> " . htmlspecialchars($row['staff_name']) . "</div>";
            echo "<div class='list-group-item'><b>Position:</b> " . htmlspecialchars($row['position']) . "</div>";
            if ($row['start_date']) {
                echo "<div class='list-group-item'><b>Contract:</b> " . htmlspecialchars($row['start_date']) . " to " . htmlspecialchars($row['end_date']) . "</div>";
            }
            if ($row['contact_name']) {
                echo "<div class='list-group-item'><b>Emergency Contact:</b> " . htmlspecialchars($row['contact_name']) . " (" . htmlspecialchars($row['relationship']) . ") - " . htmlspecialchars($row['contact_phone_num']) . "</div>";
            }
            if ($row['supervisor_id']) {
                echo "<div class='list-group-item'><b>Supervisor:</b> ID " . htmlspecialchars($row['supervisor_id']) . " (" . htmlspecialchars($row['supervisor_pos']) . ")</div>";
            }
            if ($row['event_id']) {
                echo "<div class='list-group-item'><b>Works Event ID:</b> " . htmlspecialchars($row['event_id']) . "</div>";
            }
            echo "</div>";
        }
    }
    ?>
  </div>
</div>
</body>
</html>
