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
    <form method="post" enctype="multipart/form-data">
        Title: 
        <input type="text" name="title" id="title" maxlength="100" /><br><br>
        News Type: 
        <input type="text" name="type" id="type" maxlength="100" /><br><br>
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
                            header('location:showNews.php');
                        }
                    }
                }
                else{
                    if(move_uploaded_file($_FILES['mainimage']['tmp_name'], $mainimagepath)){
                        echo "<br>News Inserted Successfully";
                        header('location:showNews.php');
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

