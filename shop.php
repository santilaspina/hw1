<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP HS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Mandaic&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="shop.css">
    <script src="shop.js" defer></script>

    <?php
        session_start();
    ?>

</head>

<body>
    <?php include 'navbar.php' ?>
    <?php include 'navbar_shop.php'?>
    <!--
    <div class="cnt-select-shop">
        <a href="shop.php" class="shop-select-link font underline" data-categoria="0">new arrivals</a>
        <a href="shop_clothing.php" class="shop-select-link font" data-categoria="2">clothing</a>
        <a href="shop_footwear.php" class="shop-select-link font" data-categoria="3">footwear</a>
        <a href="shop_accessories.php" class="shop-select-link font" data-categoria="1">accessories</a>
    </div> -->

    <div class="cnt-shop-type font">
        <div class="cnt-shop-name" data-categoria="0">new arrivals</div>
        <div class="cnt-shop-num"></div> <!--questo valore si modifica poi tramite js e php dipendendo dal db-->

    </div>

    <div class="big-cnt font">

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
        </div>
        <div class="item-cnt">
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
        </div>
        <div class="item-cnt">
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
        </div>
        <div class="item-cnt">
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
        </div>
        <div class="item-cnt">
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
        </div>
        <div class="item-cnt">
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
        </div>
        <div class="item-cnt">
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
        </div>
        <div class="item-cnt">
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
        </div>
-->

    </div>
    <div class="box-loadmore font">LOAD MORE</div>

    <?php include 'foother.php' ?>

</body>

</html>