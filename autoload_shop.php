

<?php

session_start();
/* ritorna tutti gli items dello shop presenti nel db*/
$conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());

$risultato = array();


if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    
    if ($categoria === '0') {
        $query = "SELECT * FROM shop_items si join shop_items_immages sii on si.itemID= sii.itemID ORDER BY RAND()";
        $res = mysqli_query($conn, $query);
        mysqli_close($conn);

        while ($row = mysqli_fetch_assoc($res)) {
            $risultato[] = $row;
        }

        $json = json_encode($risultato);
        echo $json;
    } else {
        $query = "SELECT * FROM shop_items si join shop_items_immages sii on si.itemID= sii.itemID WHERE si.categoria ='" . $categoria . "' ORDER BY RAND() ";
        $res = mysqli_query($conn, $query);
        mysqli_close($conn);

        while ($row = mysqli_fetch_assoc($res)) {
            $risultato[] = $row;
        }

        $json = json_encode($risultato);

        echo $json;
    }
}


if (isset($_GET['itemID'])) {
    $itemID = $_GET['itemID'];
    $query = "SELECT * FROM shop_items si join shop_items_immages sii on si.itemID= sii.itemID left join shop_items_size sis on si.itemID=sis.itemID WHERE si.itemID ='" . $itemID . "' ";

    $res = mysqli_query($conn, $query);
    mysqli_close($conn);

    while ($row = mysqli_fetch_assoc($res)) {
        $risultato[] = $row;
    }

    $json = json_encode($risultato);

    echo $json;

}


?>