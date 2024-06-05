<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HS Login Page </title>
    <link rel="stylesheet" href="login.css">
    <script src="chekdata.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Mandaic&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <?php
    session_start();

    unset($_SESSION['error_flag_login']);


    if (isset($_SESSION["id_session"])) {
        header(("Location: account_details.php"));
        exit;
    } else if (isset($_POST['email']) && isset($_POST['password'])) {

        $conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());

        $mail = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);


        $query = "SELECT * FROM users WHERE email = '" . $mail . "'";
        $res = mysqli_query($conn, $query);

        if (mysqli_num_rows($res) > 0) {

            $row = mysqli_fetch_assoc($res);

            if (password_verify($password, $row['password'])) {

                $_SESSION["id_session"] = $row['id'];
                header("Location: account_details.php");
                mysqli_close($conn);
                exit;
            } else {
                $_SESSION['error_flag_login'] = "Errore: Password errata";
            }
        } else {
            $_SESSION['error_flag_login'] = "Errore: Nessun utente registrato con queste credenziali";
        }
    }
    ?>
</head>

<body>

    <?php require_once 'navbar.php' ?>;


    <div class="container font">

        <div class="box-form">

            <p class="login-text-box">LOG IN TO YOUR ACCOUNT</p>

            <div class="form-container">
                <form method="post" class="form" name="signin-data" action="login.php">
                    <input type="email" name="email" placeholder="E-Mail Address" class="box-input">
                    <div class="errore-email hidden">*Inserisci una mail valida</div>
                    <input type="password" name="password" placeholder="Password" class="box-input">
                    <div class="errore-password hidden">*Inserisci una password valida</div>

                    <?php
                    if (isset($_SESSION['error_flag_login'])) {
                        echo "<div class=\"errore-password \">" . $_SESSION['error_flag_login'] . " </div>";
                        unset($_SESSION['error_flag_login']);
                    }
                    ?>

                    <input type="submit" value="SIGN IN" name="signin" class="button-sigin">
                </form>
            </div>

            <div class="button-container">

                <div class="help-box">
                    <p class="sign-up">Not a member?
                        <a href="sigin.php" class="sign-up link">SIGN UP</a>
                    </p>
                    <a href="#" class="forgot-password link">FORGOT PASSWORD?</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'foother.php' ?>


</body>

</html>