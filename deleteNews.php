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

    $id = $_GET['id'];
    $sql = "DELETE FROM news WHERE id = '$id'";
    $sqlComment = "DELETE FROM commentnews WHERE newsid = '$id'";
    if (mysqli_query($conn, $sql)) {
        if(mysqli_query($conn, $sqlComment)){
            echo "News Deleted Successfully";
            header("location:homepage.php");
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
?>