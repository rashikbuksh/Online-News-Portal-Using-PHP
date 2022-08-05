<?php

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "onlinenewsportal";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $access = 'Viewer';
    if($username != "" && $password != ""){
        $sql = "INSERT INTO login (username, password, access) VALUES ('$username', '$password', '$access')";
        if (mysqli_query($conn, $sql)) {
            echo "User Created Successfully";
        } else {
            echo "User already exists";
        }
    }
}


mysqli_close($conn);
?>


<html>
    <head>
        <title> </title>
    </head>
<body>
    <h1>Sign Up</h1>
    <form method="post">
        Username: 
        <input type="text" name="username" maxlength="50" />
        Password: 
        <input type="password" name="password" maxlength="50" />
        <input type="submit" name="submit" value="Sign Up" />
    </form>
</body>
</html>

