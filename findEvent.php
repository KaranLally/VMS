<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
require_once "functionSet.php";
if (!isset($_SESSION['host_id']) && !isset($_SESSION['guest_id'])) {
    header("Location: login.html");
    exit();
}

$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchId   = trim($_POST['event_id']);
    $searchType = $_POST['event_type'];

    if (!empty($searchId) && $searchType !== "null" && $searchType !== "all") {
        // Both ID and type must match
        $sql = "SELECT * FROM events 
                WHERE event_id = :searchId AND event_type = :searchType";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':searchId', $searchId, PDO::PARAM_INT);
        $stmt->bindParam(':searchType', $searchType, PDO::PARAM_STR);
    } elseif (!empty($searchId)) {
        // Only ID
        $sql = "SELECT * FROM events 
                WHERE event_id = :searchId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':searchId', $searchId, PDO::PARAM_INT);
    } elseif ($searchType === "all") {
        // All events
        $sql = "SELECT * FROM events";
        $stmt = $pdo->prepare($sql);
    } elseif ($searchType !== "null") {
        // Only type
        $sql = "SELECT * FROM events 
                WHERE event_type = :searchType";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':searchType', $searchType, PDO::PARAM_STR);
    }

    if (isset($stmt)) {
        $stmt->execute();
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    
    <title>Find Event</title>
</head>
<body>
    <div class="d-flex"> <?= sidebarShow("findEvent"); ?>
        <!--Main div==============================================================================-->
        <div class="container-fluid content flex-grow-1 p-5">
            <h1>Search Event</h1>
            <form action="findEvent.php" method="post" class="mb-3"> Event ID: <input type="text" name="event_id">
                <br><br> <label for="event_type">Event type</label> <select name="event_type" id="event_type">
                    <option value="null">--choose type--</option>
                    <option value="all">all events</option>
                    <option value="concert">concert</option>
                    <option value="conference">conference</option>
                    <option value="gala">gala</option>
                    <option value="wedding">wedding</option>
                </select> <br><br> <input type="submit" value="Search">
            </form> <!-- Results go here, BELOW the form -->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($searchResults)) {
                    echo "<div class='alert alert-warning'>Item not found</div>";
                } else {
                    foreach ($searchResults as $row) {
                        echo "<div class='list-group mb-3'>";
                        foreach ($eventlist as $info) {
                            echo "<div class='list-group-item'>"
                                . "<b>" . htmlspecialchars($info) . ":</b> "
                                . htmlspecialchars($row[$info])
                                . "</div>";
                        }
                        echo "</div>";
                    }
                }
            }
            ?>

        </div>
</body>
</html>
