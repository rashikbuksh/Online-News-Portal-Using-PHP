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

    if($viewer == 'Viewer'){
        header('location:homepage.php');
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
                            echo '<a class="nav-link active" href="addNews.php">Add News</a>';
                        }
                    ?>
                </li>
                </div>
                </ul>
                <form class="form-inline my-2 my-lg-0">
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
    <form method="post" enctype="multipart/form-data">
        Title: 
        <input type="text" name="title" id="title" maxlength="100" /><br><br>
        News Type: 
        <select class="form-select" aria-label="Default select example" name="type">
            <option selected>News Type</option>
            <option value="World">World</option>
            <option value="International">International</option>
            <option value="National">National</option>
            <option value="Political">Political</option>
            <option value="Lifestyle">Lifestyle</option>
            <option value="Fashion">Fashion</option>
            <option value="Gadget">Gadget</option>
            <option value="Sports">Sports</option>
            <option value="Education">Education</option>
        </select><br><br>
        Short Description: (optional)
        <input type="text" name="shortdescription" id="shortdescription" maxlength="255" /><br><br>
        Main Image:
        <input type="file" name="mainimage" id="mainimage"><br><br>
        Description:
        <textarea type="text" name="description" id="description"> </textarea><br><br>
        Sub-image: (optional)
        <input type="file" name="subimage" id="subimage"><br><br>
        <input type="submit" name="submit" value="Submit" />
    </form>
    <?php
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $newstype = $_POST['type'];
        $shortdescription = $_POST['shortdescription'];
        $directory = "newsimage/";
        $mainimageName = basename($_FILES["mainimage"]["name"]);
        $mainimagepath = $directory . $mainimageName;
        echo 'gg ' . $mainimagepath . '<br>';
        $description = $_POST['description'];
        $subimageName = basename($_FILES["subimage"]["name"]);
        $subimagepath = $directory . $subimageName;
        echo 'gg ' . $subimagepath . '<br>';
        
        if(!empty($mainimageName) && !is_null($title) && !is_null($newstype) && !is_null($description)){
            $sql = "INSERT INTO news (title, newstype, shortdescription, mainimage, description, subimage, date) VALUES ('$title', '$newstype', '$shortdescription', '$mainimageName', '$description', '$subimageName', NOW())";
            if (mysqli_query($conn, $sql)) {
                if(!empty($subimageName)){
                    echo '<br>subimage found';
                    if(move_uploaded_file($_FILES['mainimage']['tmp_name'], $mainimagepath)){
                        if(move_uploaded_file($_FILES['subimage']['tmp_name'], $subimagepath)){
                            echo "<br>News Inserted Successfully";
                            header('location:homepage.php');
                        }
                    }
                }
                else{
                    if(move_uploaded_file($_FILES['mainimage']['tmp_name'], $mainimagepath)){
                        echo "<br>News Inserted Successfully";
                        header('location:homepage.php');
                    }
                }
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                echo "Some Error Occured";
            }
        }
    }

    mysqli_close($conn);
?>
   </body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
