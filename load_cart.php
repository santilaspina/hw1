<?php
session_start();
if (!isset($_SESSION['id_session'])) {
    header("Location: login.php");
    exit;
} else if (isset($_SESSION['id_session'])) {

    $userID = $_SESSION['id_session'];
    $items=array();


    $conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());
    $query = "SELECT si.itemID, sc.size_item, si.brand, si.nome, si.colore, si.costo, sii.img1 FROM shopping_cart sc JOIN
                 shop_items si on sc.itemID=si.itemID JOIN shop_items_immages sii on si.itemID=sii.itemID where sc.userID = \"$userID\";";


    $res = mysqli_query($conn, $query);
    mysqli_close($conn);

    while($row= mysqli_fetch_assoc($res)){
        $items[]=$row;
    }



    $json = json_encode($items);
    echo $json;
}
?>