<?php
session_start();
if (!isset($_SESSION['id_session'])) {
    header("Location: 22index.php");
} else {
    $conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());

    $risultato=array();
    
    $orderID= mysqli_real_escape_string($conn, $_GET['orderID']);
    $itemID= mysqli_real_escape_string($conn, $_GET['itemID']);
    $size= mysqli_real_escape_string($conn, $_GET['size']);

    $query = "INSERT INTO order_items(orderID, itemID, size_item)
                values(\"$orderID\", \"$itemID\", \"$size\")";

    $res = mysqli_query($conn, $query);
    mysqli_close($conn);
    echo $res;    
    
}
