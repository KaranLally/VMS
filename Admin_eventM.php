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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        
    <title>Events Manager</title>
</head>

    <body>
        <div class="d-flex">
            <?= sidebarShow("eventManager"); ?>
            <!--Main div==============================================================================-->
            <div class="container-fluid content flex-grow-1 p-5">
                <!--<div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center"></div>-->
                <h2>Welcome !</h2>
                


                
                    
                


            </div>
        </div>
        

    </body>
</html>
