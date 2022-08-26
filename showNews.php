<?php
    session_start();
    $loggedin = $_SESSION['loggedin'];
    $viewer = $_SESSION['access'];
    if($loggedin == '1'){
        echo "Welcome ".$_SESSION['username']. '<br><br>';
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
    <title>Login</title>
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="addNews.php">Add News</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <?php
                    if($loggedin == '1'){
                        echo '<a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">Logout</a>';
                    }
                    else{
                        echo '<a class="btn btn-outline-success my-2 my-sm-0" href="login.php">Login</a>';
                    }
                ?>
                </form>
            </div>
        </nav>
    </div>
<div class="table-responsive">
    <table class="table" align='center' border='1'>
        <thead class="thead-dark">
            <tr>
                <th scope="col">Title</th>
                <th scope="col">News Type</th>
                <th scope="col">Short Description</th>
                <th scope="col">Main Image</th>
                <th scope="col">Description</th>
                <th scope="col">Sub-image</th>
                <th scope="col">Date</th>
                <th scope="col">Edit</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM news";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["title"] . "</th>";
                        echo "<td>" . $row["newstype"] . "</td>";
                        echo "<td>" . $row["shortdescription"] . "</td>";
                        echo "<td><img src='newsimage/" . $row["mainimage"] . "' height='200' weight='200'></td>";
                        echo "<td>" . $row["description"] . "</td>";
                        if(!empty($row["subimage"])){
                            echo "<td><img src='newsimage/" . $row["subimage"] . "' height='200' weight='200'></td>";
                        }
                        else{
                            echo "<td>No subimage</td>";
                        }
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td><a href='editNews.php?id=" . $row["id"] . "'>Edit</a></td>";
                        echo "<td><a href='deleteNews.php?id=" . $row["id"] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
