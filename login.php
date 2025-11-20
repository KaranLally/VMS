<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
require_once "functionSet.php";
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

//check user id
if (!isset($_POST['user_id']) || trim($_POST['user_id']) === '') {
    die("<script>
            alert('Please enter host/guest ID');
            window.location.href = 'login.html';
        </script>"
    );
}

//check user password
if (!isset($_POST["loginPassword"]) || trim($_POST["loginPassword"]) === '') {
    die("<script>
            alert('Please enter password');
            window.location.href = 'login.html';
        </script>"
    );
}

$user_id = intval($_POST['user_id']);
$inputPass = $_POST["loginPassword"];

if ($user_id == 9000){
    // 9000 admin ID
    $_SESSION['role'] = "admin";
    if($inputPass == "000000"){
        //jump to admin page
        header("Location: Admin_eventM.php");
        exit();
    }else{
        die("<script>
                alert('Invaild admin password');
                window.location.href = 'login.html';
            </script>"
        );
    }
    

}elseif ($user_id < 600) {
    //if 0~599 login as host_id
    $userQuery = $pdo->query("SELECT * FROM host WHERE host_id = $user_id");
    $data = $userQuery->fetch(PDO::FETCH_ASSOC);
    //check if ID exist and verify password from database
    if (!$data || !password_verify($inputPass, $data["password"])) {
        die("<script>
                alert('Invalid ID or Password');
                window.location.href = 'login.html';
            </script>"
        );
    }
    $_SESSION['role'] = "host";
    //for host page not admin
    $_SESSION['host_id'] = $user_id;
    //go to Dashboard page
    header("Location: Dashboard_host.php");
    exit();

}else {
    // 600+ guest
    $userQuery = $pdo->query("SELECT * FROM guest WHERE guest_id = $user_id");
    $data = $userQuery->fetch(PDO::FETCH_ASSOC);
    //check if ID exist and verify password from database
    if (!$data || !password_verify($inputPass, $data["password"])) {
        die("<script>
                alert('Invalid ID or Password');
                window.location.href = 'login.html';
            </script>"
        );
    }

    $_SESSION['role'] = "guest";
    $_SESSION['guest_id'] = $user_id;
    header("Location: Dashboard_guest.php");
    exit();
}
?>
