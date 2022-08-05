<?php
    session_start();

    $_SESSION['loggedin'] = 0;
    $_SESSION['username'] = ' ';
    $_SESSION['access']=' ';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "onlinenewsportal";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $findUser = "SELECT id, password, access FROM login WHERE username='$username'";
        $result = mysqli_query($conn, $findUser);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                if($row['password'] == $password){

                    $_SESSION['loggedin'] = 1;
                    $_SESSION['username'] = $username;
                    $_SESSION['access'] = $row['access'];

                    echo 'login successful';
                    if($_SESSION['access'] == 'Viewer'){
                        header('location:homepage.php');
                    }
                    else if($_SESSION['access'] == 'Admin'){
                        header('location:homepageadmin.php');
                    }
                    
                }
                else{
                    echo 'Password is incorrect' . '<br >';
                }
            }
        }
        else{
            echo 'User Not Found' . '<br >';
        }
    }
    
    
    mysqli_close($conn);
?>


<html>
    <head>
        <title>Login Page</title>
    </head>

    <body>
        <form method="POST">
        Username: 
        <input type="text" name="username" maxlength="50" />
        Password: 
        <input type="password" name="password" maxlength="50" />
        <input type="submit" name="submit" value="login" />
    </form>
    </body>
</html>