<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
require_once "functionSet.php";
if (!isset($_SESSION['host_id']) && !isset($_SESSION['guest_id'])) {
    header("Location: login.html");
    exit();
}
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

<title>Billing Page</title>
</head>

<body>
    <?php
    $hostId = $_SESSION['host_id']; // logged-in host
    
    $sql = "
    SELECT h.host_id, h.host_address, h.host_phone_num,
           i.invoice_id, i.amount, i.status
    FROM billed b
    JOIN host h ON b.host_id = h.host_id
    JOIN invoice i ON b.invoice_id = i.invoice_id
    WHERE h.host_id = :hostId
";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':hostId', $hostId, PDO::PARAM_INT);
    $stmt->execute();
    $billingResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="d-flex">
        <?= sidebarShow("findBilling"); ?>
        <!--Main div==============================================================================-->
        <div class="container-fluid content flex-grow-1 p-5">
            <h2>Billing Information</h2>

            <?php
            if (empty($billingResults)) {
                echo "<div class='alert alert-warning'>No billing records found</div>";
            } else {
                foreach ($billingResults as $row) {
                    echo "<div class='list-group mb-3'>";
                    echo "<div class='list-group-item'><b>Invoice ID:</b> " . htmlspecialchars($row['invoice_id']) . "</div>";
                    echo "<div class='list-group-item'><b>Amount:</b> $" . htmlspecialchars($row['amount']) . "</div>";
                    echo "<div class='list-group-item'><b>Status:</b> " . htmlspecialchars($row['status']) . "</div>";
                    echo "<div class='list-group-item'><b>Host Address:</b> " . htmlspecialchars($row['host_address']) . "</div>";
                    echo "<div class='list-group-item'><b>Host Phone:</b> " . htmlspecialchars($row['host_phone_num']) . "</div>";
                    echo "</div>";
                }
            }
            ?>

        </div>
    </div>


</body>

</html>
