<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $connString = "mysql:host=localhost;dbname=venue_managment_database";
    $user = "root";
    $pass = "root";
    $pdo = new PDO($connString,$user,$pass);
    //echo "connected";
}
  catch (PDOException $e)
{
    die($e->getMessage());
}



$eventlist = array("event_id","time","date","event_type");

function sidebarShow($active){
    if($_SESSION['role']=='host'){
    switch ($active){
        case "Dashboard": $dB = "active"; $fE = "text-white"; $fO = "text-white"; $bl = "text-white";
        break;
        case "findEvent": $dB = "text-white"; $fE = "active"; $fO = "text-white"; $bl = "text-white";
        break;
        case "findOrder": $dB = "text-white"; $fE = "text-white"; $fO = "active"; $bl = "text-white";
        break;
        case "findBilling": $dB = "text-white"; $fE = "text-white"; $fO = "text-white"; $bl = "active";
        break;
        default: $dB = "text-white"; $fE = "text-white"; $fO = "text-white"; $bl = "text-white";
    }
    $id = $_SESSION["host_id"];

echo <<<HTML
    <div class="sidebar">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 260px; min-height: 100vh"> 
                    <a href="Dashboard_host.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"><span class="fs-4 mx-3">VMS</span></a>
                    <hr> 
                    <ul class="nav nav-pills flex-column mb-auto"> 
                        <li class="nav-item"><a href="Dashboard_host.php" class="nav-link <?= $dB ?>" aria-current="page">Dashboard</a></li> 
                        <li><a href="findEvent.php" class="nav-link <?= $fE ?>e">Find Event</a></li> 
                        <li><a href="findBilling.php" class="nav-link <?= $bl ?>">Billing</a></li> 
                    </ul> 
                    <hr> 
                    <div class="dropdown"> 
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <strong id="sidebar_user_id">$id</strong> 
                        </a> 

                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"> 
                            <li><a class="dropdown-item" href="#">Settings</a></li> 
                            <li><a class="dropdown-item" href="#">Delete account</a></li> 
                            <li><hr class="dropdown-divider"></li> 
                            <li><a class="dropdown-item" href="login.html">Sign out</a></li> 
                        </ul> 
                    </div> 
            </div>
    </div>
HTML;
    }elseif($_SESSION['role']=='admin'){
        switch ($active){
        case "eventManager": $eM = "active"; $sf = "text-white"; $iv = "text-white"; $ct = "text-white"; $vn = "text-white";
        break;
        case "staff": $eM = "text-white"; $sf = "active"; $iv = "text-white"; $ct = "text-white"; $vn = "text-white";
        break;
        case "invoice": $eM = "text-white"; $sf = "text-white"; $iv = "active"; $ct = "text-white"; $vn = "text-white";
        break;
        case "customer": $eM = "text-white"; $sf = "text-white"; $iv = "text-white"; $ct = "active"; $vn = "text-white";
        break;
        case "venue": $eM = "text-white"; $sf = "text-white"; $iv = "text-white"; $ct = "text-white"; $vn = "active";
        break;
        default: $eM = "text-white"; $sf = "text-white"; $iv = "text-white"; $ct = "text-white"; $vn = "text-white";
    }
    $id = "Administrator";

echo <<<HTML
    <div class="sidebar">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 260px; min-height: 100vh"> 
                    <a href="Admin_eventM.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"><span class="fs-4 mx-3">VMS</span></a>
                    <hr> 
                    <ul class="nav nav-pills flex-column mb-auto"> 
                        <li class="nav-item"><a href="Admin_eventM.php" class="nav-link <?= $eM ?>" aria-current="page">Event</a></li> 
                        <li><a href="Admin_staffM.php" class="nav-link <?= $sf ?>e">Staff</a></li> 
                        <li><a href="Admin_invoiceM.php" class="nav-link <?= $iv ?>">Invoice</a></li> 
                        <li><a href="Admin_customerM.php" class="nav-link <?= $ct ?>">Customer</a></li> 
                        <li><a href="Admin_venueM.php" class="nav-link <?= $vn ?>">Venue</a></li>
                    </ul> 
                    <hr> 
                    <div class="dropdown"> 
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <strong id="sidebar_user_id">$id</strong> 
                        </a> 

                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"> 
                            <li><a class="dropdown-item" href="hashCodeGenerator.php">dev tools</a></li> 
                            <li><hr class="dropdown-divider"></li> 
                            <li><a class="dropdown-item" href="login.html">Sign out</a></li> 
                        </ul> 
                    </div> 
            </div>
    </div>
HTML;
    }else{
        //TODO
        switch ($active){
        case "Dashboard": $dB = "active"; $fE = "text-white"; $fO = "text-white"; $bl = "text-white";
        break;
        case "findEvent": $dB = "text-white"; $fE = "active"; $fO = "text-white"; $bl = "text-white";
        break;
        case "findOrder": $dB = "text-white"; $fE = "text-white"; $fO = "active"; $bl = "text-white";
        break;
        case "findBilling": $dB = "text-white"; $fE = "text-white"; $fO = "text-white"; $bl = "active";
        break;
        default: $dB = "text-white"; $fE = "text-white"; $fO = "text-white"; $bl = "text-white";
    }
    $id = $_SESSION["guest_id"];

echo <<<HTML
    <div class="sidebar">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 260px; min-height: 100vh"> 
                    <a href="Dashboard_guest.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"><span class="fs-4 mx-3">VMS</span></a>
                    <hr> 
                    <ul class="nav nav-pills flex-column mb-auto"> 
                        <li class="nav-item"><a href="Dashboard_guest.php" class="nav-link <?= $dB ?>" aria-current="page">Dashboard</a></li> 
                        <li><a href="findEvent.php" class="nav-link <?= $fE ?>e">Find Event</a></li>
                    </ul> 
                    <hr> 
                    <div class="dropdown"> 
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <strong id="sidebar_user_id">$id</strong> 
                        </a> 

                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"> 
                            <li><a class="dropdown-item" href="#">Settings</a></li> 
                            <li><a class="dropdown-item" href="#">Delete account</a></li> 
                            <li><hr class="dropdown-divider"></li> 
                            <li><a class="dropdown-item" href="login.html">Sign out</a></li> 
                        </ul> 
                    </div> 
            </div>
    </div>
HTML;
    }
}

function getNextEvent($pdo, $id){
    if($id<600){
        $sql = "
            SELECT events.event_id, events.time, events.date, events.event_type
            FROM `hosts_event`
            JOIN events ON hosts_event.event_id = events.event_id
            WHERE hosts_event.host_id = :target
            ORDER BY events.date ASC
            LIMIT 1;
        ";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':target',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }else{
        $sql = "
            SELECT events.event_id, events.time, events.date, events.event_type
            FROM `attends`
            JOIN events ON attends.event_id = events.event_id
            WHERE attends.guest_id = :target
            ORDER BY events.date ASC
            LIMIT 1;
        ";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':target',$id);
        $statement->execute();
        $ReturnArray = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$ReturnArray){
            return null;
        }

        return $ReturnArray;
    }
}


//@para $role: host or guest
function autoCreatedNewId($role){
    global $pdo;

    if($role == 'host'){
        $findLastIdStmt = $pdo->query("SELECT MAX(host_id) AS maxid FROM host WHERE host_id < 600");
        $lastIdRow = $findLastIdStmt->fetch();
        return $lastIdRow["maxid"]+1;
    }else{
        $findLastIdStmt = $pdo->query("SELECT MAX(guest_id) AS maxid FROM guest WHERE guest_id >= 600");
        $lastIdRow = $findLastIdStmt->fetch();
        return $lastIdRow["maxid"]+1;
    }
}



?>
