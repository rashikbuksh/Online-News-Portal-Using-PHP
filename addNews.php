<?php

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
        $shortdescription = $_POST['shortdescription'];
        $mainimageName = basename($_FILES["mainimage"]["name"]);
        $mainimagepath = "newsimage/" . $mainimageName;
        echo 'gg ' . $mainimageName;
        $description = $_POST['description'];
        $subimageName = basename($_FILES["subimage"]["name"]);
        echo 'gg ' . $subimageName;
        $subimagepath = "newsimage/" . $subimageName;
        $currentdatetime = date('Y-m-d H:i:s');
        
        if(empty($mainimageName) && is_null($title) && is_null($description)){
            $sql = "INSERT INTO news (title, shortdescription, mainimage, description, subimage, date) VALUES ('$title', '$shortdescription', '$mainimageName', '$description', '$subimageName', '$currentdatetime')";
            if (mysqli_query($conn, $sql)) {
                if(empty($subimageName)){
                    if(move_uploaded_file($_FILES['mainimage']['name'], $mainimagepath)){
                        echo "News Inserted Successfully";
                    }
                }
                else{
                    if(move_uploaded_file($_FILES['mainimage']['name'], $mainimagepath) && move_uploaded_file($_FILES['subimage']['name'], $subimagepath)){
                        echo "News Inserted Successfully";
                    }
                }
            } else {
                echo "Some Error Occured";
            }
        }
    }

    mysqli_close($conn);
?>

