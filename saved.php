<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());

if (isset($_SESSION["id_session"])) {
    $userID = $_SESSION["id_session"];
    if (isset($_GET["action"]) && isset($_GET["itemID"])) {

        if ($_GET["action"] == 1) {  // action=1 serve per checcare se ci sono elementi di quell'utente gia aggiunti ai preferiti
            $itemID = $_GET["itemID"];
            $query = "SELECT * FROM saved s WHERE userID = \"$userID\" AND itemID = \"$itemID \"";
            $res = mysqli_query($conn, $query);
            mysqli_close($conn);


            $risultato = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $risultato[] = $row;
            }
            $json = json_encode($risultato);
            echo $json;
        } else if ($_GET["action"] == 2) {  //action=2 serve per aggiungere un elemento all'interno della tabella dei salvati

            $itemID = $_GET["itemID"];
            $query = "INSERT INTO saved (userID, itemID) VALUES (\"$userID\", \"$itemID\");";
            $res = mysqli_query($conn, $query);
            mysqli_close($conn);
            $json = json_encode($res);
            echo $json;
        } else if (($_GET["action"] == 3)) {   //action=3 serve per eliminare un elemento dalla tabella degli elementi salvati

            $itemID = $_GET["itemID"];
            $query = "DELETE FROM saved WHERE userID= \"$userID\" and itemID= \"$itemID\"";
            $res = mysqli_query($conn, $query);
            mysqli_close($conn);
            $json = json_encode($res);
            echo $json;
        }
    }
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 4) {   //action=4 quando il php mi deve ritornare tutti gli elementi, e i dati, degli elementi salvati
            $query = "SELECT * FROM saved s join shop_items si on s.itemID= si.itemID  join shop_items_immages sii on si.itemID=sii.itemID WHERE s.userID= \"$userID\"";
            $res = mysqli_query($conn, $query);
            mysqli_close($conn);


            $risultato = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $risultato[] = $row;
            }
            $json = json_encode($risultato);
            echo $json;
        }
    }
}else echo json_encode(2);   //qua devo tornare un valore per fare un controllo sulla sessione.
//se il valore è settato su sessio
