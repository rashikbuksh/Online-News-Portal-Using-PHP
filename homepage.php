<?php
session_start();
$loggedin = $_SESSION['loggedin'];
$viewer = $_SESSION['access'];
if($loggedin == '1'){
    if($viewer == 'Viewer'){
        echo "Welcome ".$_SESSION['username']. '<br><br>';
    }
    else{
        header('location:homepageadmin.php');
    }
}
else{
    header('location:login.php');
}
?>
<html>
    <head>
        <title>Home Page For Viewers</title>
    </head>
    <body>

    </body>
</html>