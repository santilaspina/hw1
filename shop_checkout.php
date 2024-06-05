<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HE Checkout Order</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Mandaic&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="shop_checkout.css">
    <script src="shop_checkout.js" defer></script>

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
        $user_numero = "";
        $user_indirizzo = "";
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
            } else if (isset($row['nome']) && isset($row['cognome']) && isset($row['numero'])) {

                $user_name = $row['nome'];
                $user_lastname = $row['cognome'];
                $user_numero = $row['numero_telefono'];
            }
        }
    }

    ?>
</head>

<body>
    <div class="navbar">
        <div class="filler"></div>
        <div class="nav-big-box">
            <a href="index.php">
                <img class="nav-img" src="immagini/Highsnobiety.svg">
            </a>

        </div>
        <div class="filler">
            <a href="shop_cart.php">
                <img class="x-icon" src="immagini/icons8-x-96.png">
            </a>
        </div>
    </div>

    <div class="check-order font hidden" id="check-order">ORDINE EFFETTUATO CORRETTAMENTE</div>

    <div class="big-cnt font">
        <div class="cnt-sx">

            <div class="box-address-data">
                <div class="cnt-title">shipping address</div>
                <div class="form-container">
                    <form method="post" class="form" id="address-data" action="">
                        <input type="text" name="name" placeholder="Name: <?php echo $user_name ?> " class="box-input-small">
                        <input type="text" name="lastname" placeholder="Last Name: <?php echo $user_lastname ?>" class="box-input-small">


                        <input type="text" name="address" placeholder="Address: <?php echo $user_indirizzo ?>" class="box-input-big">

                        <input type="text" name="city" placeholder="City: <?php echo $user_citta ?>" class="box-input-big">



                        <input type="text" name="zipcode" placeholder="Zip Code: <?php echo $user_zipcode ?>" class="box-input-small">
                        <input type="text" name="phonenumber" placeholder="Phone Number: " class="box-input-big">

                        <input type="submit" id="submit-address-data" class="button" value="Submit data">
                    </form>
                </div>
                <div class="hidden" id="message-insert-address">Dati Iseriti correttamente</div>
            </div>

            <div class="box-shipping-method">
                <div class="cnt-title">shipping method</div>
                <div class="form-container">
                    <form action="" class="form" id="shipping-method">
                        <select name="shipping-method-select" class="box-input-big">
                            <option value="" disabled selected>Shipping Method</option>
                            <option value="1">
                                FedEx Europe Standard (FREE over 200,00 €) 10,00€</option>
                            <option value="2" selected>
                                DHL Europe (FREE over 200,00 €) 10,00€</option>
                            <option value="3">FedEx Priority Shipping 15,00€</option>
                        </select>
                        <input type="submit" id="submit-shipping-method" class="button" value="Submit Shipping Method">
                        <div class="hidden" id="message-insert-shipping"></div>
                    </form>

                </div>
            </div>

            <div class="box-payment-method">
                <div class="cnt-title">select payment method</div>
                <div class="form-container">
                    <form action="" class="payment-form" name="payment-method" id="payment-method">
                        <input type="radio" name="payment-method" id="card" value="card" class="input-button">
                        <label for="card" id="card_L" class="radio-label">Card</label>

                        <input type="radio" name="payment-method" id="PayPal" value="PayPal" class="input-button">
                        <label for="PayPal" id="PayPal_L" class="radio-label">PayPal</label>

                        <input type="radio" name="payment-method" id="GooglePay" value="GooglePay" class="input-button">
                        <label for="GooglePay" id="GogglePay_L" class="radio-label">Google Pay</label>

                        <input type="radio" name="payment-method" id="ApplePay" value="ApplePay" class="input-button">
                        <label for="ApplePay" id="ApplePay_L" class="radio-label">Apple Pay</label>

                        <input type="submit" name="submit-payment-method" class="button" value="Submit Payment Method">
                    </form>
                </div>
            </div>

            <div class="box-payment-data hidden" id="box-payment-data">
                <div class="cnt-title">insert payment data</div>
                <div class="form-container">
                    <form action="" name="payment-data" id="payment-data" class="form">
                        <input type="text" name="cardnumber" placeholder="Card Number" class="box-input cardnumber">
                        <input type="text" name="expiredate" placeholder="Expire Date" class="box-input expiredate">
                        <input type="text" name="expiredate" placeholder="CVV" class="box-input cvv">
                        <input type="submit" name="submit-payment-data" id="pay" class="button" value="PAY">
                    </form>
                </div>
            </div>
        </div>

        <div class="cnt-dx">
            <div class="cnt-title">order summary</div>
            <div class="cnt-costi">
                <div class="box-top">
                    <div class="box-costi">Subtotal <div id="subtotal"></div>
                    </div>
                    <div class="box-costi">Shipping <div id="shipping-cost"></div>
                    </div>
                </div>
                <div class="box-total">Total <div id="total"></div>
                </div>
            </div>
            <div class="cnt-items" id="box-items"> <!-- tutti i dati se li prende poi da js anche aggiungendo piu items. i dati li prende direttamente dalla tabella del carrello-->
                <!-- <div class="box-item" >
                    <div class="box-img">
                        <img src="immagini/shop-page-img/clothing/item2-front.avif" class="img-item">
                    </div>
                    <div class="box-information dim">
                        <div class="brand-name-box">carhartt</div>
                        <div class="item-name-box">maglietta</div>
                        <div class="color-box">color: black</div>
                        <div class="size-box"> size: M</div>
                        <div class="box-costo">700,00$</div>
                        <div class="filler"></div>
                    </div>
                </div>
                <div class="box-item">
                    <div class="box-img">
                        <img src="immagini/shop-page-img/clothing/item2-front.avif" class="img-item">
                    </div>
                    <div class="box-information dim">
                        <div class="brand-name-box">carhartt</div>
                        <div class="item-name-box">maglietta</div>
                        <div class="color-box">color: black</div>
                        <div class="size-box"> size: M</div>
                        <div class="box-costo">700,00$</div>
                        <div class="filler"></div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>



    <?php include 'foother.php' ?>





</body>

</html>