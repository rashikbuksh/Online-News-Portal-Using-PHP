<?php
    session_start();
    $loggedin = $_SESSION['loggedin'];
    $viewer = $_SESSION['access'];
    $userid = $_SESSION['userid'];

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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Search</button>
                
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
                    <?php
                        if($loggedin == '1'){
                            echo '<a class="dropdown-item" href="login.php">Logout</a>';
                        }
                        else{
                            echo '<a class="dropdown-item" href="login.php">Login</a>';
                        }
                    ?>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    <br>
    <div class="container">
        <div class="row">
            
            <?php
                $sql = "SELECT * FROM news ORDER BY date DESC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-lg-4 mb-4'>";
                        echo "<div class='card' style='width: 18rem;'>";
                        echo "<div class='card-header'>". $row["newstype"] ."</div>";
                        echo "<img class='card-img-top' src='newsimage/" . $row["mainimage"] . "' alt='Card image cap' height='400' width='650'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row["title"] . "</h5>";
                        echo "<p class='card-text'>" . $row["shortdescription"] . "</p>";
                        echo "<a class='card-link' href='singleNews.php?id=".$row["id"]."'>View</a>";
                        if($viewer == 'Admin'){
                            echo "<a class='card-link' href='editNews.php?id=".$row["id"]."'>Edit</a>";
                            echo "<a class='card-link' href='deleteNews.php?id=".$row["id"]."'>Delete</a>";
                        }
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>
    </body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>