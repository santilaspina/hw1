<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="account_addresses.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Mandaic&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">

    <?php
    session_start();
    if (!isset($_SESSION['id_session'])) {
        header("Location: login.php");
        exit;
    } else {
        $conn = mysqli_connect("localhost", "root", "", "homework") or die(mysqli_connect_error());

        $userID = $_SESSION['id_session'];

        $query = "SELECT * FROM users u LEFT JOIN users_data ud on u.id=ud.id WHERE u.id = \"$userID\"";
        $res = mysqli_query($conn, $query);

        $user_mail = "";
        $user_name = "";
        $user_lastname ="";
        $user_numero = "";
        $user_indirizzo ="";
        $user_citta = "";
        $user_zipcode = "";


        if ($res) {
            $row = mysqli_fetch_assoc($res);
            $user_mail = $row['email'];


            if (isset($row['nome']) && isset($row['cognome']) && isset($row['numero_telefono']) && isset($row['indirizzo']) && isset($row['citta']) && isset($row['codice_postale'])) {

                $user_name = $row['nome'];
                $user_lastname = $row['cognome'];
                $user_numero = $row['numero_telefono'];
                $user_indirizzo = $row['indirizzo'];
                $user_citta = $row['citta'];
                $user_zipcode = $row['codice_postale'];
            } 
            else if (isset($row['nome']) && isset($row['cognome']) && isset($row['numero'])) {

                $user_name = $row['nome'];
                $user_lastname = $row['cognome'];
                $user_numero = $row['numero_telefono'];
            } 
        }
    }

    ?>

</head>

<body>
    <?php require_once 'navbar.php' ?>
    <div class="cnt-select-shop">
        <a href="account_details.php" class="shop-select-link font ">ACCOUNT DETAILS</a>
        <a href="account_addresses.php" class="shop-select-link underline font">ADDRESSES</a>
        <a href="shop_footwear.php" class="shop-select-link font">MY ORDERS</a>
    </div>



    <div class="container font">
        <div class="container-form">
            <div class="title-box">shipping address</div>
            <div class="mail-box">Email <br>
                <?php echo $user_mail; ?>
            </div>

            <form class="form-box" action="carica_dati_user.php" method="post">

                <input type="text" name="first_name" class="input-form-box" placeholder="First Name: <?php echo $user_name ?>">
                <input type="text" name="last_name" class="input-form-box" placeholder="Last Name: <?php echo $user_lastname ?> ">
                <input type="text" name="phone_number" class="input-form-box" placeholder="Phone number: <?php echo $user_numero ?>">
                <input type="text" name="address-line1" class="input-form-box" placeholder="Address Line 1: <?php echo $user_indirizzo ?>  ">
                <input type="text" name="address-line2" class="input-form-box" placeholder="Address Line 2 (optional): ">
                <input type="text" name="city" class="input-form-box" placeholder="City: <?php echo $user_citta ?>">
                <input type="text" name="zip-code" class="input-form-box" placeholder="Zip Code: <?php echo $user_zipcode ?>">

                <input type="submit" value="SAVE CHANGES" name="signin" class="button">
            </form>
        </div>


        <div class="log-out-box">
            <p class="line1"><?php echo $user_mail ?> </p>
            <p class="line2">Not You? <a href="session_logout.php" class="black">Log Out </a>
        </div>
    </div>












    <?php require_once 'foother.php' ?>
</body>

</html>