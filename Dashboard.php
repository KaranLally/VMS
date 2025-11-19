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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        
    <title>Dashboard</title>
</head>

    <body>
        <div class="d-flex">
            <?= sidebarShow("Dashboard"); ?>
            <!--Main div==============================================================================-->
            <div class="container-fluid content flex-grow-1 p-5">
                <!--<div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center"></div>-->
                <h2>Welcome, host <?= $_SESSION['host_id'] ?> !</h2>
                


                
                    <div class="list-group list-group-checkable d-grid gap-2 border-0"> 
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableRadios1">Your Next Event:
                            <span class="d-block small opacity-50">
                                <?php 
                                    foreach($eventlist as $info) {
                                        echo $info.": ".getNextEvent($pdo,$_SESSION['host_id'])[$info] ."<br>";
                                    }
                                ?>
                            </span> 
                        </label> 
                    </div>
                


            </div>
        </div>
        

    </body>
</html>
