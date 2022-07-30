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
    $sql = "SELECT * FROM login";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo $row["id"]. " " . $row["username"] . $row["password"] . $row["access"] . "<br>";
        }
    } else {
        echo "0 results";
    }

}
?>