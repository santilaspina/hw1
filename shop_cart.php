<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HS Shopping Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Mandaic&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="shop_cart.css">
    <script src="shop_cart.js" defer></script>
    <?php session_start(); ?>
</head>

<body>
    <?php include 'navbar.php' ?>
    <?php include 'navbar_shop.php' ?>

    <div class="big-cnt font">
        <div class="cnt-dx" id="cnt-items">
            <div class="cnt-title">your cart</div>

            <div class="<?php if(isset($_SESSION['id_session'])){echo "hidden";}?>">You are not Logged In!
                <a href="login.php">Log In </a>
            </div>

            <!--<div class="cnt-cart-item">
                <div class="cnt-img">
                    <img src="immagini/shop-page-img/clothing/item2-front.avif" class="img-item"> cambiare il src da js
                </div>
                <div class="cnt-info">
                    <div class="box-dx">
                        <div class="box-details">
                            <div class="brand-name-box">carhartt</div>
                            <div class="item-name-box">maglietta</div>
                            <div class="color-box">color: black</div>
                            <div class="size-box"> size: M</div>
                            <div class="filler"></div>

                        </div>
                        <div class="box-option">
                            <div class="remove-box">Remove</div>
                            <div class="later-box">Save for Later</div>
                        </div>
                    </div>
                    <div class="box-sx">
                        <div class="box-costo">44,00$</div>
                    </div>
                </div>
            </div>
            -->
        </div>
        <div class="cnt-sx <?php if (!isset($_SESSION['id_session'])) {
                                echo "hidden";
                            } ?>">
            <div class="cnt-title">order summary</div>
            <div class="cnt-costi">
                <div class="box-top">
                    <div class="box-costi">Subtotal <div id="subtotal"></div>
                    </div>
                    <div class="box-costi">Shipping <div>15,00$</div>
                    </div>
                </div>
                <div class="box-total">Total <div id="total"></div>
                </div>
            </div>
            <div class="cnt-checkout">
                <a class="button-checkout" id="checkout" href="shop_checkout.php">CHECKOUT </a>
            </div>
            <div class="box-shipping-details">
                <div class="box-top-details">14 day free returns worldwide</div>
                <div class="box-bottom-details">Import Duties <br>
                    We ship to your door; any additional import charges such as duties will be taken care of by us</div>
            </div>
            <div class="box-account">
                <p>
                    <?php if (isset($_SESSION['user_mail'])) {
                        echo $_SESSION['user_mail'] . "</p> <p>Not You? <a href=\"session_logout.php\" class=\"link\">Change Account</a></p>";
                    }
                    ?>
            </div>
        </div>
    </div>


    <?php include 'foother.php' ?>

</body>

</html>