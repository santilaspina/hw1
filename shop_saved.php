<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HS Saved</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Mandaic&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="shop_saved.css">
    <script src="shop_saved.js" defer></script>
    <?php
    session_start();
    ?>
</head>

<body>
    <?php include 'navbar.php' ?>
    <?php include 'navbar_shop.php' ?>

    <div class="cnt-shop-type font">
        <div class="cnt-shop-name">saved</div>
        <div class="<?php if (isset($_SESSION['id_session'])) {
                        echo "hidden";
                    } ?>"> You are not Logged in! 
         <a href=" login.php">LOG IN</a></div>
    </div>

    <div class="cnt-big font">

        <!-- <div class="item-cnt">
            <div class="item-img"></div>
            <div class="item-description-box">
                <div class="description-box">
                    <div class="title-box"></div>
                    <div class="description-box-text">
                    </div>
                </div>
                <div class="save-box">
                    <img src="immagini/icons8-nastro-segnalibro.svg" class="icon-img">
                </div>
            </div>
        </div> -->

    </div>
    <?php include 'foother.php' ?>
</body>

</html>