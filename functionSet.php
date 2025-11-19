<?php
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
    switch ($active){
        case "Dashboard": $dB = "active"; $fE = "text-white"; $fO = "text-white"; $bl = "text-white";
        break;
        case "findEvent": $dB = "text-white"; $fE = "active"; $fO = "text-white"; $bl = "text-white";
        break;
        case "findOrder": $dB = "text-white"; $fE = "text-white"; $fO = "active"; $bl = "text-white";
        break;
        case "billing": $dB = "text-white"; $fE = "text-white"; $fO = "text-white"; $bl = "active";
        break;
        default: $dB = "active"; $fE = "text-white"; $fO = "text-white"; $bl = "text-white";
    }
    $id = $_SESSION["host_id"];

echo <<<HTML
    <div class="sidebar">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 260px; min-height: 100vh"> 
                    <a href="Dashboard.html" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"><span class="fs-4 mx-3">VMS</span></a>
                    <hr> 
                    <ul class="nav nav-pills flex-column mb-auto"> 
                        <li class="nav-item"><a href="Dashboard.php" class="nav-link <?= $dB ?>" aria-current="page">Dashboard</a></li> 
                        <li><a href="findEvent.php" class="nav-link <?= $fE ?>e">Find my Event</a></li> 
                        <li><a href="findOrder.php" class="nav-link <?= $fO ?>">Find my Order</a></li> 
                        <li><a href="billing.php" class="nav-link <?= $bl ?>">Billing</a></li> 
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

function getNextEvent($pdo, $id){
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
    
}



?>