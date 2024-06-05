<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HS Login Page </title>
    <link rel="stylesheet" href="login.css">
    <script src="chekdata_siging.js" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyChOtIoH4uT80XLuOSarD30phVE9W2LzZU&loading=async"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Mandaic&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <?php session_start() ?>
</head>

<body>

    <?php require_once 'navbar.php' ?>


    <div class="container font">
        <div class="box-form">

            <p class="login-text-box">CREATE YOUR ACCOUNT</p>

            <?php 
            $conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());
            $query = "SELECT id FROM users WHERE email = 'laspinasanti@gmail.com'";
            $res1 = mysqli_query($conn, $query);
            if ($res1) {
                $row = mysqli_fetch_assoc($res1);                
            } 
            $id=$row['id'];
           
           
            echo $id;


            /*echo json_encode($row['id']);*/

            ?>



            <div class="form-container">
                <form method="get" class="form" name="signin-data" action="register_user.php">
                    <input type="email" name="email" placeholder="E-Mail Address" class="box-input">
                    <div class="errore-email hidden">*Inserisci una mail valida</div>
                    <input type="password" name="password" placeholder="Password" class="box-input">
                    <div class="errore-password hidden">*Inserisci una password valida</div>

                    <?php
                    if (isset($_SESSION['error_flag_sigin'])) {
                        echo "<div class=\"errore-password \">*Utente gia registrato! Effettua il LOG-IN </div>";
                        unset($_SESSION['error_flag_sigin']);
                    }
                    ?>

                    <input type="submit" value="SIGN UP" name="signin" class="button-sigin">
                </form>
            </div>

            <div class="button-container">

                <div class="help-box">
                    <p class="sign-up">Already a member?
                        <a href="login.php" class="sign-up link">LOG IN</a>
                    </p>
                    <!--<a href="#" class="forgot-password link">FORGOT PASSWORD?</a> -->
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'foother.php' ?>


</body>

</html>