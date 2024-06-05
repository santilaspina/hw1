<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HS Login Page </title>
    <link rel="stylesheet" href="account_details.css">
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
        $user_lastname = "";

        if ($res) {
            $row = mysqli_fetch_assoc($res);
            $user_mail = $row['email'];
            $_SESSION['user_mail'] = $row['email'];
            if (isset($row['nome']) && isset($row['cognome']) && isset($row['numero'])) {
                $user_name = $row['nome'];
                $user_lastname = $row['cognome'];
                $user_numero = $row['numero'];
            }
        }
    }
    ?>
</head>

<body>

    <?php require_once 'navbar.php' ?>
    <div class="cnt-select-shop">
        <a href="account_details.php" class="shop-select-link font underline">ACCOUNT DETAILS</a>
        <a href="account_addresses.php" class="shop-select-link font">ADDRESSES</a>
        <a href="shop_footwear.php" class="shop-select-link font">MY ORDERS</a>
    </div>



    <div class="container font">
        <div class="container-form">
            <div class="title-box">personal information</div>
            <div class="mail-box">Email <br>
                <?php echo $user_mail; ?>
            </div>
            <form class="form-box" action="carica_dati_user.php" method="post">

                <select name="salutation" class="input-form-box">
                    <option value="Salutation" class="input-form-box">Salutation</option>
                    <option value="Mr">Mr</option>
                    <option value="Ms">Ms</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Mx">Mx</option>
                </select>

                <input type="text" name="first_name" class="input-form-box" placeholder="First Name: <?php echo $row['nome'] ?>">
                <input type="text" name="last_name" class="input-form-box" placeholder="Last Name: <?php echo $row['cognome'] ?>">
                <input type="text" name="phone_number" class="input-form-box" placeholder="Phone number: <?php echo $row['numero_telefono'] ?>">

                <input type="submit" value="SAVE CHANGES" name="signin" class="button">
            </form>
        </div>

        <div class="container-form form2">
            <div class="title-box title2">change password</div>
            <form class="form-box">

                <input type="text" class="input-form-box" placeholder="Current Password">
                <input type="text" class="input-form-box" placeholder="New Password">
                <div class="errore-password">*La password deve contenere almeno un carattere minuscolo, uno maiuscolo, e un carattere speciale</div>


                <input type="submit" value="UPDATE PASSWORD" name="signin" class="button">
            </form>

            <div class="log-out-box">
                <p class="line1"><?php echo $user_mail ?> </p>
                <p class="line2">Not You? <a href="session_logout.php" class="black">Log Out </a>
            </div>
        </div>



    </div>










    </div>

    </div>

    <?php require_once 'foother.php' ?>


</body>

</html>