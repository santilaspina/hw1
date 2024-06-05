<?php
session_start();
if (!isset($_SESSION['id_session'])) {
    header("Location: login.php");
    exit;
} else if (isset($_SESSION['id_session']) && isset($_GET['itemID'])) {

    $userID = $_SESSION['id_session'];
    $itemID=$_GET['itemID'];
    


    $conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());
    $query = "DELETE FROM shopping_cart WHERE userID= \"$userID\" AND itemID=\"$itemID\"";


    $res = mysqli_query($conn, $query);
    mysqli_close($conn);


    $json = json_encode($res);
    echo $json;
}
?>