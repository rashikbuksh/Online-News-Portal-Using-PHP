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
    <button id="addnewsbtn" class="float-left submit-button">Add News</button>
    <button id="shownewsbtn" class="float-left submit-button">Show News</button>
    
    </body>
    <script type="text/javascript">
    document.getElementById("addnewsbtn").onclick = function () {
        location.href = "addNews.php";
    };
    document.getElementById("shownewsbtn").onclick = function () {
        location.href = "showNews.php";
    };
    </script>
</html>