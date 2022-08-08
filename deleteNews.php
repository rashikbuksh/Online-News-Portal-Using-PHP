<?php
    session_start();
    $loggedin = $_SESSION['loggedin'];
    $viewer = $_SESSION['access'];
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

    $id = $_GET['id'];
    $sql = "DELETE FROM news WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "News Deleted Successfully";
        header("location:showNews.php");
    }

    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
?>