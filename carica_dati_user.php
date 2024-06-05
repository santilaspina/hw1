<?php
session_start();
unset($_SESSION['error_flag_sigin']);
$conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());
$userID = $_SESSION["id_session"];




if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['phone_number']) && isset($_POST['address-line1']) && isset($_POST['city']) && isset($_POST['zip-code'])) { //dati che arrivano da account address
    $query = "SELECT * FROM users u LEFT JOIN users_data ud on u.id=ud.id WHERE u.id = \"$userID\"";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);

    $nome = mysqli_real_escape_string($conn, $_POST['first_name']);
    $cognome = mysqli_real_escape_string($conn, $_POST['last_name']);
    $numero = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $indirizzo = mysqli_real_escape_string($conn, $_POST['address-line1']);
    $citta = mysqli_real_escape_string($conn, $_POST['city']);
    $codice_postale = mysqli_real_escape_string($conn, $_POST['zip-code']);


    //con i due if qui sotto vedo cosa inserire
    //1° IF) Non c'è alcun tipo di dato salvato all'interno del db, percio salvo tutto
    //2° IF) sono salvati solo nome, cognome e numero di telefono
    //£° IF)è tutto salvato percio faccio solo l'update


    if (empty($row['nome']) && empty($row['cognome']) && empty($row['numero_telefono']) && empty($row['indirizzo']) && empty($row['citta']) && empty($row['codice_postale'])) {

        $query = "INSERT INTO users_data (id, nome, cognome, numero_telefono, indirizzo, citta, codice_postale) VALUES (\"$userID\", \"$nome\", \"$cognome\", \"$numero\", \"$indirizzo\",\"$citta\"  , \"$codice_postale\" ";
        $res1 = mysqli_query($conn, $query);
        header("Location: account_addresses.php");
    } else if (!empty($row['nome']) && !empty($row['cognome']) && !empty($row['numero_telefono']) && empty($row['indirizzo']) && empty($row['citta']) && empty($row['codice_postale'])) {
        $query = "UPDATE users_data SET indirizzo = \"$indirizzo\" , citta = \"$citta\", codice_postale = \"$codice_postale\" WHERE id=$userID";
        $res1 = mysqli_query($conn, $query);
        header("Location: account_addresses.php");
    } else {
        $query = "UPDATE users_data SET nome= \"$nome\", cognome=\"$cognome\", numero_telefono=\"$numero\", indirizzo = \"$indirizzo\" , citta = \"$citta\", codice_postale = \"$codice_postale\" WHERE id=$userID";
        $res1 = mysqli_query($conn, $query);
        header("Location: account_addresses.php");
    }
} else if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['phone_number'])) {  //dati che arrivano dalla pagina account_details
   
 


    $query = "SELECT * FROM users u LEFT JOIN users_data ud on u.id=ud.id WHERE u.id = \"$userID\"";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);

    $nome = mysqli_real_escape_string($conn, $_POST['first_name']);
    $cognome = mysqli_real_escape_string($conn, $_POST['last_name']);
    $numero = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $indirizzo = mysqli_real_escape_string($conn, $_POST['address-line1']);
    $citta = mysqli_real_escape_string($conn, $_POST['city']);
    $codice_postale = mysqli_real_escape_string($conn, $_POST['zip-code']);

    if (!empty($row['nome']) && !empty($row['cognome']) && !empty($row['numero_telefono'])) {
        $query = "UPDATE users_data SET nome= \"$nome\", cognome=\"$cognome\", numero_telefono=\"$numero\" WHERE id=$userID";
        $res1 = mysqli_query($conn, $query);
        header("Location: account_addresses.php");
    } else if(!empty($nome) && !empty($cognome) && !empty($numero)){
        $query = "INSERT INTO users_data (id, nome, cognome, numero_telefono, indirizzo, citta, codice_postale) VALUES (\"$userID\", \"$nome\", \"$cognome\", \"$numero\", null, null, null)";
        $res = mysqli_query($conn, $query);
        header("Location: account_details.php");
    }
}
