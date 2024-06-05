<?php
session_start();
unset($_SESSION['error_flag_sigin']);
$conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());


//qua caso in cui i dati post arrivano dalla pagina di sign up
if (isset($_GET['email']) && isset($_GET['password'])) {

    //caso in cui vengono inserite le credenziali di un utente già registrato
    $mail = mysqli_real_escape_string($conn, $_GET['email']);
    $password =  $_GET['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT password FROM users WHERE email = '" . $mail . "'";
    $res3 = mysqli_query($conn, $query);
    if (mysqli_num_rows($res3) > 0) {
        $_SESSION["error_flag_sigin"] = "Errore: utente già registrato";
        header("Location: sigin.php");
        mysqli_close($conn);
        exit;
    }

    $query = "INSERT INTO users (email, password) VALUES (\"$mail\", \"$password_hash\")";
    $res = mysqli_query($conn, $query);

    if ($res) {

        $query = "SELECT id FROM users WHERE email = '" . $mail . "'";
        $res1 = mysqli_query($conn, $query);

        if ($res1) {
            $row = mysqli_fetch_assoc($res1);
            if ($row) {
                $id = $row['id'];
                $_SESSION['id_session'] = $id;
                header("Location: account_details.php");
            }
            mysqli_close($conn);
            exit;
        }
    } else {
        $_SESSION["error_flag_sigin"] = "Errore durante la registrazione";
        mysqli_close($conn);
        header("Location: sigin.php");
        exit;
    }
    exit;
}
