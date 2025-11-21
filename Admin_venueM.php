<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
require_once "functionSet.php";
if (trim($_SESSION['role']) != 'admin') {
    header("Location: login.html");
    exit();
}
$venuelist = ['venue_id', 'venue_address', 'size', 'venue_type'];

$searchResults = [];
$sql = "SELECT venue_id, venue_address, size, venue_type FROM venue"; // base query

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchId = trim($_POST['venue_id']);

    // Build WHERE conditions dynamically
    $conditions = [];
    $params = [];

    if (!empty($searchId) && $searchId !== 'all') {
        $conditions[] = "venue_id = :searchId";
        $params[':searchId'] = [$searchId, PDO::PARAM_INT];
    }

    if ($conditions) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }
}
$stmt = $pdo->prepare($sql);
foreach ($params ?? [] as $key => [$val, $type]) {
    $stmt->bindValue($key, $val, $type);
}
$stmt->execute();
$searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<title>Venue Manager</title>
</head>

<body>
    <div class="d-flex">
        <?= sidebarShow("venue"); ?>
        <!--Main div==============================================================================-->
        <div class="container-fluid content flex-grow-1 p-5">
            <!--<div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center"></div>-->
            <h2>Welcome Administrator!</h2><br>
            <h4>Filter:</h4>
            <form action="Admin_venueM.php" method="post" class="mb-3">
                Venue ID: <input type="text" name="venue_id">
                <input type="submit" value="Search">
            </form>

            <?php
            if (empty($searchResults)) {
                echo "<div class='alert alert-warning'>No Venue found</div>";
            } else {
                foreach ($searchResults as $row) {
                    echo "<div class='list-group mb-3'>";
                    foreach ($venuelist as $info) {
                        echo "<div class='list-group-item'>"
                            . "<b>" . htmlspecialchars($info) . ":</b> "
                            . htmlspecialchars($row[$info])
                            . "</div>";
                    }
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
