<?php
    session_start();
    $loggedin = $_SESSION['loggedin'];
    $viewer = $_SESSION['access'];
    $userid = $_SESSION['userid'];
    if($loggedin == '1'){
        
    }
    else{
        header('location:login.php');
    }

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "onlinenewsportal";


    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>

<html lang="en">
  <head>
    <title>Homepage</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
    <body>
    <div role="navigation">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <a class="navbar-brand" href="homepage.php">Online News Portal</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <?php
                        if($viewer == 'Viewer'){
                            
                        }
                        else if($viewer == 'Admin'){
                            echo '<a class="nav-link" href="addNews.php">Add News</a>';
                        }
                    ?>
                </li>
                </div>
                </ul>
                <form action="searchPage.php" class="form-inline my-2 my-lg-0">
                &nbsp;&nbsp;
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                    if($loggedin == '1'){
                        echo "&nbsp".$_SESSION['username'];
                    }
                ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    <br>
    <div class="d-flex justify-content-center">
    <?php
        if(isset($_GET['search'])){
            $searchItem = $_GET['search'];
            $sql = "SELECT * FROM news WHERE title LIKE '%$searchItem%'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                echo '<div><h3>'.$resultCheck.' news found...</h3><br>';
                while($row = mysqli_fetch_assoc($result)){
                    $title = $row['title'];
                    $id = $row['id'];
                    echo '<div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title">'.$title.'</h5>
                    <a href="singleNews.php?id='.$id.'" class="btn btn-primary">View</a>
                    </div>
                    </div></div>';
                }
            }
        }
                    
    ?>
    </div>
    </body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>