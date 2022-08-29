<?php
    session_start();
    $loggedin = $_SESSION['loggedin'];
    $viewer = $_SESSION['access'];
    $userid = $_SESSION['userid'];
    if($loggedin == '1'){
        echo "Welcome ".$_SESSION['username']. '<br><br>';
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
    <form method="post" enctype="multipart/form-data">
        Title: 
        <input type="text" name="title" id="title" maxlength="100" value="<?php echo $title ?>"/><br><br>
        News Type: 
        <input type="text" name="type" id="type" maxlength="100" value="<?php echo $newstype ?>" /><br><br>
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

