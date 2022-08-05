<?php
function checkUser()
{

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "onlinenewsportal";

    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT access FROM login";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    echo $row["access"] . "<br>";
}
?>