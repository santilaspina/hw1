const URLstring = window.location.search;

const parametri = new URLSearchParams(URLstring);

const itemID = parametri.get('itemID');


/*console.log(itemID);*/

fetch('autoload_shop.php?itemID=' + itemID).then(onResponse).then(onJson);

function onResponse(event) {
    return event.json()
}

function onJson(json) {
    /*console.log(json);*/

    const img = document.querySelectorAll('.big-cnt .cnt-img .box-img .immagine');
    /*console.log(img);*/

    img[0].src = json[0].img1;
    img[0].dataset.img = "img1";
    img[0].addEventListener('click', openModal);

    img[1].src = json[0].img2;
    img[1].dataset.img = "img2";
    img[1].addEventListener('click', openModal);

    img[2].src = json[0].img3;
    img[2].dataset.img = "img3";
    img[2].addEventListener('click', openModal);

    img[3].src = json[0].img4;
    img[3].dataset.img = "img4";
    img[3].addEventListener('click', openModal);

    function openModal(event) {
        const immagine = event.currentTarget;

        let imgID = immagine.dataset.img;
        /*console.log(imgID);
        console.log(json);*/


        document.querySelector(".modal-view").classList.remove("hidden");
        document.querySelector('body').classList.add("no-scroll");

        const imgx = document.querySelector(".modal-view .modal-img-cnt .modal-img");
        imgx.src = json[0][imgID];

        imgx.addEventListener('click', function () {
            imgx.classList.toggle('zoom');
        });

        document.querySelector(".modal-view .modal-side-cnt .freccia.indietro").addEventListener('click', function (event) {
            if (imgID == 'img1') {
                imgx.src = json[0].img4;
                imgID = "img4";
            } else if (imgID == 'img2') {
                imgx.src = json[0].img1;
                imgID = "img1";
            } else if (imgID == 'img3') {
                imgx.src = json[0].img2;
                imgID = "img2";
            } else if (imgID == 'img4') {
                imgx.src = json[0].img3;
                imgID = "img3";
            }
        });

        document.querySelector(".modal-view .modal-side-cnt .freccia.avanti").addEventListener('click', function (event) {
            if (imgID == 'img1') {
                imgx.src = json[0].img2;
                imgID = "img2";
            } else if (imgID == 'img2') {
                imgx.src = json[0].img3;
                imgID = "img3";
            } else if (imgID == 'img3') {
                imgx.src = json[0].img4;
                imgID = "img4";
            } else if (imgID == 'img4') {
                imgx.src = json[0].img1;
                imgID = "img1";
            }
        });

        document.querySelector(".modal-view .modal-side-cnt .icon-x").addEventListener('click', function () {

            document.querySelector(".modal-view").classList.add("hidden");
            document.querySelector('body').classList.remove("no-scroll");
        });
    };

    const icona = document.querySelector(".big-cnt .cnt-details .cnt-name .box-dx .img-save-icon");
    icona.dataset.id = json[0].itemID;

    fetch('saved.php?action=1&itemID=' + itemID)  //checka se l'item è gia stato salvato
        .then(response =>{ return response.json()})
        .then(dataJson => {            

            if (dataJson.length > 0) {
                icona.src = 'immagini/icons8-nastro-segnalibro-riempito.png';
                icona.dataset.saved = 1;
            } else {
                icona.src = 'immagini/icons8-nastro-segnalibro.svg';
                icona.dataset.saved = 0;
            }
        });
    icona.addEventListener('click', addSavedItem);

    function addSavedItem(event) {
        /*console.log(event);*/
        const Additem = event.currentTarget;
        const id = Additem.dataset.id;

        Additem.dataset.saved = 1;
        
        
        Additem.src = 'immagini/icons8-nastro-segnalibro-riempito.png';

        /*qua poi fare la fetch ad una pagina php che si occupa di salvare l'item all'interno della tabella
        del DB*/

        fetch('saved.php?action=2&itemID=' + id)
            .then(response => response.json())
            .then(dataJson => {
                /*console.log(dataJson);*/
            });

        Additem.removeEventListener('click', addSavedItem);
        Additem.addEventListener('click', removeSavedItem);
    }
    function removeSavedItem(event) {
        const RemoveItem = event.currentTarget;
        const RmId = RemoveItem.dataset.id;

        RemoveItem.dataset.saved = 0;
       
       
        RemoveItem.src = 'immagini/icons8-nastro-segnalibro.svg';

        /*qua la fetch per rimuovere l'entry nella tabella dei salbvati*/
        fetch('saved.php?action=3&itemID=' + RmId)
            .then(response => response.json())
            .then(dataJson => {
                /*console.log(dataJson);*/
            });
        RemoveItem.removeEventListener('click', removeSavedItem);
        RemoveItem.addEventListener('click', addSavedItem);
    }
    const brand = document.querySelector('.cnt-details .cnt-name .box-sx .box-name-brand');
    brand.textContent = json[0].brand;

    const item_name = document.querySelector('.cnt-details .cnt-name .box-sx .box-name-item');
    item_name.textContent = json[0].nome;

    const item_costo = document.querySelector('.cnt-details .cnt-name .box-sx .box-costo');
    item_costo.textContent = json[0].costo + ",00 €";

    const item_colore = document.querySelector('.cnt-details .cnt-name .box-sx .box-colore');
    item_colore.textContent = "Color: " + json[0].colore;

    const item_note = document.querySelector('.cnt-info-item .box-info-text .text-info-description');
    item_note.textContent = json[0].descrizione;

    const item_material = document.querySelector('.cnt-info-item .box-info-text.second .text-info-description ');
    /*console.log(item_material);*/
    item_material.textContent = json[0].materiale;

    
    if(json[0].categoria == 1){
        document.querySelector('.big-cnt .cnt-details .cnt-size .box-text-size').classList.add('hidden');
        document.querySelector('.big-cnt .cnt-details .cnt-size .box-form-size .form .cnt-form-chose').classList.add('hidden');
        //fare il controllo che c'e almeno uno acquistabile senno disabilitare il tasto add to cart
        //fare prima il controllo di categoria per gli accessori cosi da non disabilotare il tasto 
    }else if (json[0].numXS == 0 || json[0].numS == 0 || json[0].numM == 0 || json[0].numL == 0) {
        if (json[0].numXS == 0) {
            document.getElementById('XS_L').removeAttribute('for');
            document.getElementById('XS_L').classList.add('unclickable');
        }if (json[0].numS == 0) {
            document.getElementById('S_L').removeAttribute('for');
            document.getElementById('S_L').classList.add('unclickable');
        }if (json[0].numM == 0) {
            document.getElementById('M_L').removeAttribute('for');
            document.getElementById('M_L').classList.add('unclickable');
        }if (json[0].numL == 0) {
            document.getElementById('L_L').removeAttribute('for');
            document.getElementById('L_L').classList.add('unclickable');
        }if(json[0].numXS == 0 && json[0].numS == 0 && json[0].numM == 0 && json[0].numL == 0){
            document.getElementById('submit-button').disabled = true;
        }
    }
}

//prendo il riferimento al form, quando faccio il submit faccio una fetch ad una pagina php che mi salva userID, itemID, misura scelta e costo.
//lo faccio da qua cosi evito il ricaricamento della pagina e riesco a prendere l'itemID.
//lo userID lo prendo direttamete dalla pagina php che mi va a asalvare i dati all'interno del db


document.querySelector('#form-size').addEventListener('submit',function(event){

    event.preventDefault();    
    const form = event.currentTarget;
    let input=form.querySelectorAll('input[name="size"]');
    let size=null;
    

    /*console.log(form);*/

    input.forEach(element => {
        if(element.checked){
            size=element.value;
        }        
    });
    if(size==null && itemID>=9){
        alert("Selezionare una misura prima di aggiungere al carrello");
        return;
    }

    /*console.log("SIZE: " + size);*/
    document.getElementById('submit-button').disabled = true;
    document.getElementById('submit-button').classList.add('unclickable');

    document.getElementById('info-cart').classList.remove('hidden');
    if(size==null){
        size="One Size";
    }

    fetch('add_shopping_cart.php?itemID=' + itemID + "&size=" + size).then(response=>console.log(response));
});

