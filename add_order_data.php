<?php
session_start();
if (!isset($_SESSION['id_session'])) {
    header("Location: 22index.php");
} else {
    $conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());

    $risultato=array();



    $userID = $_SESSION['id_session'];
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $lastname =  mysqli_real_escape_string($conn, $_GET['lastname']);
    $address =  mysqli_real_escape_string($conn, $_GET['address']);
    $city =  mysqli_real_escape_string($conn, $_GET['city']);
    $zipcode =  mysqli_real_escape_string($conn, $_GET['zipcode']);
    $phone =  mysqli_real_escape_string($conn, $_GET['phone']);
    $shipping_type = $_GET['shipping_type'];


    $query = "INSERT INTO orders(userID, nome, cognome, numero_telefono, indirizzo, citta, codice_postale, shipping_type)
                values(\"$userID\", \"$name\", \"$lastname\", \"$phone\", \"$address\", \"$city\", \"$zipcode\", \"$shipping_type\")";



    $res = mysqli_query($conn, $query);
    if ($res == true) {
        $query = "SELECT orderID FROM orders WHERE userID=\"$userID\" ORDER BY order_date DESC LIMIT 1";
        $orderID = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($orderID)) {
            $risultato[] = $row;
        }
        mysqli_close($conn);
        echo json_encode($risultato);
    }
    
}
