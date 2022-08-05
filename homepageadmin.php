<?php
    session_start();
    $loggedin = $_SESSION['loggedin'];
    $viewer = $_SESSION['access'];
    if($loggedin == '1'){
        echo "Welcome ".$_SESSION['username']. '<br><br>';
    }
    else{
        header('location:login.php');
    }
?>
<html>
    <head>
        <title>Home Page For Admin</title>
    </head>
    <body>

    </body>
</html>