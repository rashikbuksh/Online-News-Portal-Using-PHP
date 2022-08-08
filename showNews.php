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

<body>
    <table align='center' border='1'>
        <tr>
            <th>Title</th>
            <th>Short Description</th>
            <th>Main Image</th>
            <th>Description</th>
            <th>Sub-image</th>
            <th>Date</th>
            <th>Edit</th>
            <th></th>
        </tr>
        <?php
            $sql = "SELECT * FROM news";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["title"] . "</td>";
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
    </table>
</body>
