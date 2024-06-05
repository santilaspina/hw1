<?php
    session_start();
    if(!isset($_SESSION['id_session'])){
        header("Location: login.php");
        exit;
    }else if (isset($_SESSION['id_session']) && isset($_GET['itemID']) && isset($_GET['size'])){

        $userID=$_SESSION['id_session'];
        $itemID=$_GET['itemID'];
        $size = $_GET['size'];


        $conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());
        $query="INSERT INTO shopping_cart(userID, itemID, size_item) VALUES (\"$userID\",\"$itemID\",\"$size\");";

        $res = mysqli_query($conn, $query);
        mysqli_close($conn);
        
        echo $res;
    }
?>