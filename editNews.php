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
        <input type="text" name="title" id="title" maxlength="100" value="<?php echo $title ?>"/><br><br>
        News Type: 
        <select class="form-select" aria-label="Default select example" name="type">
        <?php
            switch($newstype)
            {
                case "World":
                    echo "<option value='World' selected>World</option>
                    <option value='International'>International</option>
                    <option value='National'>National</option>
                    <option value='Political'>Political</option>
                    <option value='Lifestyle'>Lifestyle</option>
                    <option value='Fashion'>Fashion</option>
                    <option value='Gadget'>Gadget</option>
                    <option value='Sports'>Sports</option>
                    <option value='Education'>Education</option>";
                    break;

                case "International":
                    echo "<option value='International' selected>International</option>
                    <option value='World'>World</option>
                    <option value='National'>National</option>
                    <option value='Political'>Political</option>
                    <option value='Lifestyle'>Lifestyle</option>
                    <option value='Fashion'>Fashion</option>
                    <option value='Gadget'>Gadget</option>
                    <option value='Sports'>Sports</option>
                    <option value='Education'>Education</option>";
                    break;

                case "National":
                    echo "<option value='National' selected>National</option>
                    <option value='World'>World</option>
                    <option value='International'>International</option>
                    <option value='Political'>Political</option>
                    <option value='Lifestyle'>Lifestyle</option>
                    <option value='Fashion'>Fashion</option>
                    <option value='Gadget'>Gadget</option>
                    <option value='Sports'>Sports</option>
                    <option value='Education'>Education</option>";
                    break;
                
                case "Political":
                    echo "<option value='Political' selected>Political</option>
                    <option value='World'>World</option>
                    <option value='International'>International</option>
                    <option value='National'>National</option>
                    <option value='Lifestyle'>Lifestyle</option>
                    <option value='Fashion'>Fashion</option>
                    <option value='Gadget'>Gadget</option>
                    <option value='Sports'>Sports</option>
                    <option value='Education'>Education</option>";
                    break;

                case "Lifestyle":
                    echo "<option value='Lifestyle' selected>Lifestyle</option>
                    <option value='World'>World</option>
                    <option value='International'>International</option>
                    <option value='National'>National</option>
                    <option value='Political'>Political</option>
                    <option value='Fashion'>Fashion</option>
                    <option value='Gadget'>Gadget</option>
                    <option value='Sports'>Sports</option>
                    <option value='Education'>Education</option>";
                    break;

                case "Fashion":
                    echo "<option value='Fashion' selected>Fashion</option>
                    <option value='World'>World</option>
                    <option value='International'>International</option>
                    <option value='National'>National</option>
                    <option value='Political'>Political</option>
                    <option value='Lifestyle'>Lifestyle</option>
                    <option value='Gadget'>Gadget</option>
                    <option value='Sports'>Sports</option>
                    <option value='Education'>Education</option>";
                    break;

                case "Gadget":
                    echo "<option value='Gadget' selected>Gadget</option>
                    <option value='World'>World</option>
                    <option value='International'>International</option>
                    <option value='National'>National</option>
                    <option value='Political'>Political</option>
                    <option value='Lifestyle'>Lifestyle</option>
                    <option value='Fashion'>Fashion</option>
                    <option value='Sports'>Sports</option>
                    <option value='Education'>Education</option>";
                    break;

                case "Sports":
                    echo "<option value='Sports' selected>Sports</option>
                    <option value='World'>World</option>
                    <option value='International'>International</option>
                    <option value='National'>National</option>
                    <option value='Political'>Political</option>
                    <option value='Lifestyle'>Lifestyle</option>
                    <option value='Fashion'>Fashion</option>
                    <option value='Gadget'>Gadget</option>
                    <option value='Education'>Education</option>";
                    break;

                case "Education":
                    echo "<option value='Education' selected>Education</option>
                    <option value='World'>World</option>
                    <option value='International'>International</option>
                    <option value='National'>National</option>
                    <option value='Political'>Political</option>
                    <option value='Lifestyle'>Lifestyle</option>
                    <option value='Fashion'>Fashion</option>
                    <option value='Gadget'>Gadget</option>
                    <option value='Sports'>Sports</option>";
                    break;
            }
            ?>
            </select>
        <br><br>
        Short Description: (optional)
        <input type="text" name="shortdescription" id="shortdescription" maxlength="255" values="<?php echo $shortdescription ?>"/><br><br>
        Main Image:
        <input type="file" name="mainimage" id="mainimage" values="<?php echo $mainimage ?>"><br><br>
        Description:
        <textarea type="text" name="description" id="description"><?php echo $description ?> </textarea><br><br>
        Sub-image: (optional)
        <input type="file" name="subimage" id="subimage" values="<?php echo $subimage ?>"><br><br>
        <input type="submit" name="submit" value="Submit" />
        <br>
        Main Image:
        <img src=newsimage/<?php echo $mainimage ?> height='200' weight='200'>
        <br>
        Sub-image:
        <img src=newsimage/<?php echo $subimage ?> height='200' weight='200' alt="No Image">
    </form>
    <?php
    $id = $_GET['id'];
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
        
        
        if(!empty($mainimageName) && !is_null($title) && !is_null($newstype) && !is_null($description)){
            $sql = "UPDATE news set title = '$title', shortdescription = '$shortdescription', mainimage = '$mainimageName', description = '$description', subimage = '$subimageName', date = NOW(), newstype='$newstype' where id = '$id'";
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
                    }
                }
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                echo "Some Error Occured";
            }
        }
        else if (empty($mainimageName) && !is_null($title) && !is_null($newstype) && !is_null($description)){
            if(empty($subimageName)){
                $sql = "UPDATE news set title = '$title', shortdescription = '$shortdescription', description = '$description', date = NOW(), newstype='$newstype' where id = '$id'";
                if (mysqli_query($conn, $sql)) {
                    echo "<br>News Inserted Successfully";
                    header('location:homepage.php');
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    echo "Some Error Occured";
                }
            }
            else{
                $sql = "UPDATE news set title = '$title', shortdescription = '$shortdescription', description = '$description', subimage = '$subimageName', date = NOW(), newstype='$newstype' where id = '$id'";
                if (mysqli_query($conn, $sql)) {
                    if(move_uploaded_file($_FILES['subimage']['tmp_name'], $subimagepath)){
                        echo "<br>News Inserted Successfully";
                        header('location:homepage.php');
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    echo "Some Error Occured";
                }
            }
        }
        else{
            echo "Some Error Occured";
        }
    }

    mysqli_close($conn);
?>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>