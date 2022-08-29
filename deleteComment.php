<?php
    session_start();
    $loggedin = $_SESSION['loggedin'];
    $viewer = $_SESSION['access'];
    $userid = $_SESSION['id'];
    if ($loggedin == '1') {
        echo "Welcome " . $_SESSION['username'] . '<br><br>';
    }
    else {
        header('location:login.php');
    }
    if($viewer == 'Viewer'){
        header('location:homepage.php');
    }
?>
<?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "onlinenewsportal";


    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $commentid = $_GET['commentid'];
    $sql2 = "SELECT * FROM commentnews WHERE commentid = '$commentid'";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_assoc($result2)){
            $newsid = $row['newsid'];
        }
    }
    $sql = "DELETE FROM commentnews WHERE commentid = '$commentid'";
    if (mysqli_query($conn, $sql)) {
        echo "News Deleted Successfully";
        header("location:singleNews.php?id=$newsid");
    }

    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
?>