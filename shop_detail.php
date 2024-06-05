<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP HS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Mandaic&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="shop_detail.css">
    <script src="shop_detail.js" defer></script>
    <?php session_start();?>
</head>

<body>
    <?php include 'navbar.php' ?>
    <?php include 'navbar_shop.php' ?>

    <div class="modal-view hidden">
        <div class="modal-side-cnt">
            <img src="immagini/icons8-indietro-100.png" class="freccia indietro">
        </div>
        <div class="modal-img-cnt">
            <div class="modal-img-box">
                <img src="#" class="modal-img">
            </div>
        </div>
        <div class="modal-side-cnt">
            <img src="immagini/icons8-x-96.png" class="icon-x ">
            <img src="immagini/icons8-avanti-100.png" class="freccia avanti">


        </div>
    </div>

    <div class="big-cnt font">
        <div class="cnt-img">
            <div class="box-img small">
                <img class="immagine">
            </div>
            <div class="box-img">
                <img class="immagine">
            </div>
            <div class="box-img">
                <img class="immagine">
            </div>
            <div class="box-img">
                <img class="immagine">
            </div>
        </div>
        <div class="cnt-details">
            <div class="cnt-name">
                <div class="box-sx">
                    <div class="box-name-brand"></div>
                    <div class="box-name-item"></div>
                    <div class="filler"></div>
                    <div class="box-costo"></div>
                    <div class="box-colore">Color: </div>
                </div>
                <div class="box-dx">
                    <img src="" class="img-save-icon">
                </div>
            </div>
            <div class="cnt-size">
                <div class="box-text-size">Size:</div>
                <div class="box-form-size">
                    <form class="form" id="form-size">
                        <div class="cnt-form-chose">

                            <input type="radio" name="size" id="XS" value="XS" class="input-button">
                            <label for="XS" id="XS_L" class="radio-label">XS</label>

                            <input type="radio" name="size" id="S" value="S" class="input-button">
                            <label for="S" id="S_L"   class="radio-label">S</label>

                            <input type="radio" name="size" id="M" value="M" class="input-button">
                            <label for="M" id="M_L"  class="radio-label">M</label>

                            <input type="radio" name="size" id="L" value="L" class="input-button">
                            <label for="L" id="L_L" class="radio-label">L</label>
                        </div>
                        <input type="submit"  id="submit-button"  value="ADD TO CART" class="submit-size-button">
                    </form>
                </div>
            </div>
            <div id="info-cart" class="hidden">*Aggiunto al carrello</div>
            <div class="cnt-info-item ">
                <div class="box-info-shipping border-bottom">
                    <p class="text-info-shipping">Ships from EU</p>
                    <p class="text-info-shipping">You qualify for free shipping</p>
                    <p class="text-info-shipping">14 day free returns worldwide</p>
                    <p class="text-info-shipping">* Prices including VAT</p>
                </div>
                <div class="box-info-text border-bottom">
                    <p class="text-info-title">Editor's note:</p>
                    <p class="text-info-description"></p>
                </div>
                <div class="box-info-text second border-bottom">
                    <p class="text-info-title">Product Details:</p>
                    <p class="text-info-description "></p>
                </div>
            </div>
        </div>

    </div>
    <?php include 'foother.php' ?>
</body>

</html>