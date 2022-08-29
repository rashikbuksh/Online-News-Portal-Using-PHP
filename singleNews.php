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

    $id = $_GET['id'];
    $sql = "SELECT * FROM news WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $newstype = $row['newstype'];
            $shortdescription = $row['shortdescription'];
            $mainimage = $row['mainimage'];
            $description = $row['description'];
            $subimage = $row['subimage'];
        }
    }
    else{
        echo "0 results";
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
                <li class="nav-item">
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
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
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
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
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
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM news WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
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
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Comments</h5>
                        <?php
                            $sql = "SELECT * FROM commentnews WHERE newsid = '$id'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<p class='card-text'>" . $row["message"] . "</p>";
                                    echo "<small>" . $row["date"] . "</small>";
                                    if($row["userid"] == $userid){
                                        echo "<br><a href='deleteComment.php?commentid=" . $row["commentid"] . "'>Delete</a>";
                                    }
                                }
                            }
                        ?>
                        <br>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Comment</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                        <?php
                            if(isset($_POST['submit'])){
                                $comment = $_POST['message'];
                                $sql = "INSERT INTO commentnews (message, newsid, date, userid) VALUES ('$comment', '$id', NOW(), '$userid')";
                                if(mysqli_query($conn, $sql)){
                                    echo "<script>alert('Comment added successfully')</script>";
                                    echo "<script>window.location.href='singleNews.php?id=$id'</script>";
                                }
                                else{
                                    echo "<script>alert('Error adding comment')</script>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>