

function addNewsItem(event) {
    const Objnews = [{
        "nome": "obj1",
        "img": "immagini/img-news/img-news-more/img-Obj1.png",
        "title": "Thanks to Rihanna, No One Can Go Pantless Again",
        "sub-title": "(STYLE) 14 HOURS AGO"
    },
    {
        "nome": "obj2",
        "img": "immagini/img-news/img-news-more/img-Obj2.png",
        "title": "KEEN's New Sghoe Leaves Nothin to the Immagination",
        "sub-title": "(STYLE) 17 HOURS AGO"
    },
    {
        "nome": "obj3",
        "img": "immagini/img-news/img-news-more/img-Obj3.png",
        "title": "Ypur Favourite Perfume Could Be Used to Treat Depression",
        "sub-title": "(BEAUTY) 19 HOURS AGO"
    },
    {
        "nome": "obj4",
        "img": "immagini/img-news/img-news-more/img-Obj4.png",
        "title": "The Gant Archive — A Shirt With History",
        "sub-title": "(STYLE, SPONSORED) 20 HOURS AGO"
    }
    ];

    const box = document.querySelector('.container-news');
    const container = document.createElement('div');
    const cntImg = document.createElement('div');
    const img = document.createElement('img');
    const cntText = document.createElement('div');
    const text = document.createElement('p');
    const subtitle = document.createElement('p');


    container.classList.add('container-new');
    cntImg.classList.add('container-img-new');
    cntImg.classList.add('zoom');
    img.classList.add('img-big-new');
    cntText.classList.add('container-text-new');
    cntText.classList.add('font');
    text.classList.add('text-new');
    subtitle.classList.add('sub-title');
    subtitle.classList.add('sub-news');

    img.src = Objnews[i].img;
    text.textContent = Objnews[i].title;
    subtitle.textContent = Objnews[i]["sub-title"];


    cntImg.appendChild(img);
    cntText.appendChild(text);
    cntText.appendChild(subtitle);

    container.appendChild(cntImg);
    container.appendChild(cntText);

    box.appendChild(container);
    i = i + 1;
}


const loadmore = document.querySelector('.box-loadmore');
loadmore.addEventListener('click', addNewsItem);
let i = 0; //indice degli oggetti della lista


const shop1items = document.getElementsByClassName('shop-img');

for (let y = 0; y < shop1items.length; y++) {
    shop1items[y].addEventListener('mouseenter', ChangeShopImg);
    shop1items[y].addEventListener('mouseleave', ChangeShopImgDefault);
}

//API spotify


function onJson(json) {
    console.log(json);

    for (let i = 0; i < 4; i++) {
        //creo gli elementi da aggiungere alla pagina
        const container= document.getElementById('box-music');

        const item_cnt=document.createElement('div');
        item_cnt.classList.add('item-cnt');

        const item_img= document.createElement('div');
        item_img.classList.add('item-img');

        const img = document.createElement('img');
        img.classList.add('immagine');
        img.classList.add('zoom');
        img.src=json.albums.items[i].images[2].url;

        item_img.appendChild(img);
        item_cnt.appendChild(item_img);

        const item_description_box= document.createElement('div');
        item_description_box.classList.add('item-description-box');
        item_description_box.classList.add('font');

        const description_box= document.createElement('div');
        description_box.classList.add('description-box');

        const title_box= document.createElement('div');
        title_box.classList.add('title-box');
        title_box.textContent=json.albums.items[i].artists[0].name;
        description_box.appendChild(title_box);

        const subtitle_box= document.createElement('div');
        subtitle_box.classList.add('description-box-text');
        subtitle_box.textContent=json.albums.items[i].name;
        description_box.appendChild(subtitle_box);
        

        item_description_box.appendChild(description_box);
        item_cnt.appendChild(item_description_box);
        container.appendChild(item_cnt);
    }
}



fetch('get_spotify_data.php').then(onResponse).then(onJson);

function onResponse(response) {
    return response.json();
}


fetch('autoload_shop.php?categoria=0').then(onResponse).then(onShopJson);
fetch('autoload_shop.php?categoria=3').then(onResponse).then(onShopShoeJson);

function onResponse(event) {
   
    return event.json();
}

function onShopJson(json) {
    for (let y = 0; y < 4; y++) {

        const big_cnt = document.getElementById('new-arrivals');

        const linkURL = 'shop_detail.php?itemID=' + json[y].itemID;

        const item_cnt = document.createElement('div');
        item_cnt.classList.add('item-cnt');
        /*item_cnt.href=linkURL*/

        const item_img = document.createElement('a');
        item_img.classList.add('item-img');
        const img = document.createElement('img');  //qua poi devo assegnare il sorgente
        img.classList.add('immagine');
        img.classList.add('zoom');
        /*console.log(json[index_json]);*/
        img.src = json[y].img1;
        item_img.href = linkURL;

        img.addEventListener('mouseenter', function (event) {
            const img = event.currentTarget;
            img.src = json[y].img2;
        });

        img.addEventListener('mouseleave', function (event) {
            const img = event.currentTarget;
            img.src = json[y].img1;
        });


        item_img.appendChild(img);
        item_cnt.appendChild(item_img);

        const item_description_box = document.createElement('div');
        item_description_box.classList.add('item-description-box');


        const description_box = document.createElement('a');
        description_box.classList.add('description-box');
        description_box.href = linkURL;

        const title_box = document.createElement('div');
        title_box.classList.add('title-box');
        title_box.classList.add('font');
        title_box.textContent = json[y].brand;
        description_box.appendChild(title_box);

        const description_box_text = document.createElement('div');
        description_box_text.classList.add('description-box-text');
        description_box_text.classList.add('font');
        description_box_text.innerHTML = json[y].nome + "<br>" + json[y].costo + "$";
        description_box.appendChild(description_box_text);

        item_description_box.appendChild(description_box);

        const save_box = document.createElement('div');
        save_box.classList.add('save-box');
        const save_img = document.createElement('img');
        save_img.classList.add('icon-img');
        save_img.dataset.id = json[y].itemID;



        fetch('saved.php?action=1&itemID=' + json[y].itemID)
            .then(response => response.json())
            .then(dataJson => {
                console.log(dataJson);
                if (dataJson != 2) {
                    if (dataJson.length > 0) {
                        save_img.src = 'immagini/icons8-nastro-segnalibro-riempito.png';
                        save_img.dataset.saved = 1;
                        save_img.addEventListener('click', removeSavedItem);

                    } else {
                        save_img.src = 'immagini/icons8-nastro-segnalibro.svg';
                        save_img.dataset.saved = 0;
                        save_img.addEventListener('click', addSavedItem);
                    }
                }
            });

        /*save_img.addEventListener('click', addSavedItem);*/

        save_box.appendChild(save_img);
        item_description_box.appendChild(save_box);
        item_cnt.appendChild(item_description_box);
        /*console.log(item_cnt);*/
        big_cnt.appendChild(item_cnt);
    }


    function addSavedItem(event) {
       
        const Additem = event.currentTarget;
        const id = Additem.dataset.id;

        Additem.dataset.saved = 1;
        const isSaved = Additem.dataset.saved;
        
        Additem.src = 'immagini/icons8-nastro-segnalibro-riempito.png';

       

        fetch('saved.php?action=2&itemID=' + id)
            .then(response => response.json())
            .then(dataJson => {
               /* console.log(dataJson);*/
            });

        Additem.removeEventListener('click', addSavedItem);
        Additem.addEventListener('click', removeSavedItem);
    }
    function removeSavedItem(event) {
        const RemoveItem = event.currentTarget;
        const RmId = RemoveItem.dataset.id;

        RemoveItem.dataset.saved = 0;
        const isSaved = RemoveItem.dataset.saved;
        
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

}

function onShopShoeJson(json) {   

    for (let y = 0; y < 4; y++) {

        const big_cnt = document.getElementById('cnt-shop-shoe');

        const linkURL = 'shop_detail.php?itemID=' + json[y].itemID;

        const item_cnt = document.createElement('div');
        item_cnt.classList.add('item-cnt');
        

        const item_img = document.createElement('a');
        item_img.classList.add('item-img');
        const img = document.createElement('img');  
        img.classList.add('immagine');
        img.classList.add('zoom');        
        img.src = json[y].img1;
        item_img.href = linkURL;

        img.addEventListener('mouseenter', function (event) {
            const img = event.currentTarget;
            img.src = json[y].img2;
        });

        img.addEventListener('mouseleave', function (event) {
            const img = event.currentTarget;
            img.src = json[y].img1;
        });


        item_img.appendChild(img);
        item_cnt.appendChild(item_img);

        const item_description_box = document.createElement('div');
        item_description_box.classList.add('item-description-box');

        const description_box = document.createElement('a');
        description_box.classList.add('description-box');
        description_box.href = linkURL;

        const title_box = document.createElement('div');
        title_box.classList.add('title-box');
        title_box.classList.add('font');
        title_box.textContent = json[y].brand;
        description_box.appendChild(title_box);

        const description_box_text = document.createElement('div');
        description_box_text.classList.add('description-box-text');
        description_box_text.classList.add('font');
        description_box_text.innerHTML = json[y].nome + "<br>" + json[y].costo + "$";
        description_box.appendChild(description_box_text);

        item_description_box.appendChild(description_box);

        const save_box = document.createElement('div');
        save_box.classList.add('save-box');
        const save_img = document.createElement('img');
        save_img.classList.add('icon-img');
        save_img.dataset.id = json[y].itemID;


        fetch('saved.php?action=1&itemID=' + json[y].itemID)
            .then(response => response.json())
            .then(dataJson => {
                if (dataJson != 2) { //2 è un semplice numero che mi serve per vedere se è stato fatto il login

                    if (dataJson.length > 0) {
                        save_img.src = 'immagini/icons8-nastro-segnalibro-riempito.png';
                        save_img.dataset.saved = 1;
                        save_img.addEventListener('click', removeSavedItem);
                    } else {
                        save_img.src = 'immagini/icons8-nastro-segnalibro.svg';
                        save_img.dataset.saved = 0;
                        save_img.addEventListener('click', addSavedItem);
                    }
                }
            });

        

        save_box.appendChild(save_img);
        item_description_box.appendChild(save_box);
        item_cnt.appendChild(item_description_box);
        big_cnt.appendChild(item_cnt);

    }


    function addSavedItem(event) {
        
        const Additem = event.currentTarget;
        const id = Additem.dataset.id;

        Additem.dataset.saved = 1;       
        
        Additem.src = 'immagini/icons8-nastro-segnalibro-riempito.png';

        

        fetch('saved.php?action=2&itemID=' + id)
            .then(response => response.json())
            .then(dataJson => {
                console.log(dataJson);
            });

        Additem.removeEventListener('click', addSavedItem);
        Additem.addEventListener('click', removeSavedItem);
    }
    function removeSavedItem(event) {
        const RemoveItem = event.currentTarget;
        const RmId = RemoveItem.dataset.id;

        RemoveItem.dataset.saved = 0;
        
        RemoveItem.src = 'immagini/icons8-nastro-segnalibro.svg';
        
        fetch('saved.php?action=3&itemID=' + RmId)
            .then(response => response.json())
            .then(dataJson => {
                console.log(dataJson);
            });
        RemoveItem.removeEventListener('click', removeSavedItem);
        RemoveItem.addEventListener('click', addSavedItem);
    }
}











