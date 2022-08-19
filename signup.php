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

<!doctype html>
<html lang="en">
  <head>
    <title>Signup</title>
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
            <div class="d-flex justify-content-center">
                <h1 class="display-4">Signup</h1>
            </div>
            <form method="post">
            <div class="form-group">
                <label for="username" style="color:#17a2b8;">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" maxlength="50">
            </div>
            <div class="form-group">
                <label for="password" style="color:#17a2b8;">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" maxlength="50">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-info" name="submit">Submit</button>
            </div>
            <br>
            </form>
            <div class="d-flex justify-content-center">
                <article style="color:#17a2b8;">Have An Account? <a href="login.php">Login Here</a></article>
            </div>
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

