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

<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
        height: 100%;
        background-image: linear-gradient(black, grey);
        }
    </style>
  </head>
  <body>
    <div class="container h-100 d-flex justify-content-center vh-100">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 jumbotron my-auto">
            <h1 class="display-4" align="center">Online News Portal</h1>
            <form action="login.php" method="post">
            <div class="form-group">
                <label for="username" style="color:#17a2b8;">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" >
            </div>
            <div class="form-group">
                <label for="password" style="color:#17a2b8;">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-outline-info" name="submit">Submit</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>