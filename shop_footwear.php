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
</head>

<body>
    <?php include 'navbar.php' ?>
    <?php include 'navbar_shop.php' ?>

    <div class="cnt-shop-type font">
        <div class="cnt-shop-name" data-categoria="3">footwear</div>
        <div class="cnt-shop-num"></div> <!--questo valore si modifica poi tramite js e php dipendendo dal db-->

    </div>

    <div class="big-cnt font">
    </div>
    <div class="box-loadmore font">LOAD MORE</div>

    <?php include 'foother.php' ?>

</body>

</html>