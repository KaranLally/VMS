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

$signUpType = $_POST["signUpRole"];

if($signUpType==="host"){

    $signUpAddr = $_POST["signUpAddress"];
    $signUpPNum = $_POST["signUpPhoneNum"];
    $signUpPass = password_hash($_POST["signUpPassword"],PASSWORD_DEFAULT);

    if(isset($signUpAddr) && isset($signUpPNum) && isset($_POST["signUpPassword"])){

        //auto increase id
        $newId = autoCreatedNewId("host");

        $sqlSignUp = "INSERT INTO host (host_id, host_address, host_phone_num, `password`) VALUES (:id, :addr, :pNum, :hPass)";
        $statement = $pdo->prepare($sqlSignUp);
        $statement->bindValue(':id', $newId);
        $statement->bindValue(':addr', $signUpAddr);
        $statement->bindValue(':pNum', $signUpPNum);
        $statement->bindValue(':hPass', $signUpPass);
        $statement->execute();
    }else{
        die("<script>
            alert('Something went wrong, check your sign-up information and try again');
            window.location.href = 'signUp.html';
            </script>"
        );
    }

    //output the host_id to user
    die("<script>
            alert('Account created! Your Host ID is $newId. Close to login in login page');
            window.location.href = 'login.html';
        </script>"
    );

}else{//for guest

    $signUpPass = password_hash($_POST["signUpPassword"],PASSWORD_DEFAULT);

    if(isset($_POST["signUpPassword"])){

        //auto increase id
        $newId = autoCreatedNewId("guest");

        $sqlSignUp = "INSERT INTO guest (guest_id, `password`) VALUES (:id, :hPass)";
        $statement = $pdo->prepare($sqlSignUp);
        $statement->bindValue(':id', $newId);
        $statement->bindValue(':hPass', $signUpPass);
        $statement->execute();
    }else{
        die("<script>
            alert('Something went wrong, check your sign-up information and try again');
            window.location.href = 'signUp.html';
            </script>"
        );
    }

    //output the guest_id to user
    die("<script>
            alert('Account created! Your Guest ID is $newId. Close to login in login page');
            window.location.href = 'login.html';
        </script>"
    );

}


?>