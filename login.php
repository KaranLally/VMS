<?php
session_start();
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


if (!isset($_POST['user_id']) || trim($_POST['user_id']) === '') {
    die("<script>
            alert('Please enter host/guest ID');
            window.location.href = 'login.html';
        </script>");
}
$user_id = intval($_POST['user_id']);
if ($user_id < 600) {
    //if 0~599 login as host_id
    $userQuery = $pdo->query("SELECT * FROM host WHERE host_id = $user_id");
    $data = $userQuery->fetch();
    //check if ID exist
    if (!$data) {
        die("Invalid host ID.");
    }
    $_SESSION['role'] = "host";
    //for host page not admin
    $_SESSION['host_id'] = $user_id;
    //go to Dashboard page
    header("Location: Dashboard.php");
    exit();
}elseif ($user_id == 9000){
    // 9000 admin ID
    $_SESSION['role'] = "admin";
    //jump to admin page
    header("Location: admin.html");
    exit();
} else {
    // 600+ guest
    $userQuery = $pdo->query("SELECT * FROM guest WHERE guest_id = $user_id");
    $data = $userQuery->fetch();
    if (!$data) {
        die("<script>
            alert('Invaild host/guest ID');
            window.location.href = 'login.html';
        </script>");
    }

    $_SESSION['role'] = "guest";
    $_SESSION['guest_id'] = $user_id;
    header("Location: Dashboard.php");
    exit();
}
?>
