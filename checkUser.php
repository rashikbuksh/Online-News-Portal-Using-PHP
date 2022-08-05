<?php
function checkUser()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "onlinenewsportal";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT access FROM login";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    echo $row["access"] . "<br>";
}
?>