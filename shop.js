
//SOTTO CONTROLLO TIPO DI SHOP E FETCH IN BASE AL TIPO

let index_categoria;
const categoria = document.querySelector('.cnt-shop-type .cnt-shop-name');
if (categoria.dataset.categoria === '2') {
    index_categoria = 2;
} else if (categoria.dataset.categoria === '3') {
    index_categoria = 3
} else if (categoria.dataset.categoria === '1') {
    index_categoria = 1
} else {
    index_categoria = 0;
}



fetch('autoload_shop.php?categoria=' + index_categoria).then(onResponse).then(onJson);
console.log('CATEGORIA:' + index_categoria);


function onResponse(event) {    
    return event.json();
}

function onJson(json) {   
    const loadmore = document.querySelector('.box-loadmore');
    loadmore.addEventListener('click', addNewItems);
    
    const num_items = document.querySelector('.cnt-shop-type .cnt-shop-num');
    num_items.textContent = Object.keys(json).length + " items";    

    let index_json;


    for (let y = 0; y < 6; y++) {       

        const big_cnt = document.querySelector('.big-cnt');

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
        title_box.textContent = json[y].brand;
        description_box.appendChild(title_box);

        const description_box_text = document.createElement('div');
        description_box_text.classList.add('description-box-text');
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
                if (dataJson.length > 0) {
                    save_img.src = 'immagini/icons8-nastro-segnalibro-riempito.png';
                    save_img.dataset.saved = 1;
                } else {
                    save_img.src = 'immagini/icons8-nastro-segnalibro.svg';
                    save_img.dataset.saved = 0;
                }
        });

        save_img.addEventListener('click', addSavedItem);


        save_box.appendChild(save_img);
        item_description_box.appendChild(save_box);
        item_cnt.appendChild(item_description_box);
        big_cnt.appendChild(item_cnt);

        index_json = y + 1;
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
                /*console.log(dataJson);*/
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

        fetch('saved.php?action=3&itemID=' + RmId)
            .then(response => response.json())
            .then(dataJson => {
                console.log(dataJson);
            });
        RemoveItem.removeEventListener('click', removeSavedItem);
        RemoveItem.addEventListener('click', addSavedItem);
    }

    
    function addNewItems() {

        for (let y = 0; y < 3; y++) {        
            console.log(index_json);
            console.log(json);

            const img1 = json[index_json].img1;
            const img2 = json[index_json].img2;


            const big_cnt = document.querySelector('.big-cnt');

            const linkURL = 'shop_detail.php?itemID=' + json[index_json].itemID;
            const item_cnt = document.createElement('div');
            item_cnt.classList.add('item-cnt');

            const item_img = document.createElement('a');
            item_img.classList.add('item-img');


            const img = document.createElement('img');
            img.classList.add('immagine');
            img.classList.add('zoom');

            img.src = img1;
            img.dataset.id = json[index_json].itemID;
            item_img.href = linkURL;

            img.addEventListener('mouseenter', function (event) {
                const id = event.currentTarget.dataset.itemID;
                const img = event.currentTarget;
                img.src = img2;
            });

            img.addEventListener('mouseleave', function (event) {
                const id = event.currentTarget.dataset.itemID;
                const img = event.currentTarget;
                img.src = img1;
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
            title_box.textContent = json[index_json].brand;
            description_box.appendChild(title_box);

            const description_box_text = document.createElement('div');
            description_box_text.classList.add('description-box-text');
            description_box_text.innerHTML = json[index_json].nome + "<br>" + json[index_json].costo + "$";
            description_box.appendChild(description_box_text);

            item_description_box.appendChild(description_box);

            const save_box = document.createElement('div');
            save_box.classList.add('save-box');
            const save_img = document.createElement('img');
            save_img.classList.add('icon-img');
            save_img.dataset.id = json[index_json].itemID;

            fetch('saved.php?action=1&itemID=' + json[index_json].itemID)
                .then(response => response.json())
                .then(dataJson => {
                    if (dataJson.length > 0) {
                        save_img.src = 'immagini/icons8-nastro-segnalibro-riempito.png';
                    } else {
                        save_img.src = 'immagini/icons8-nastro-segnalibro.svg';
                    }
                });

            save_img.addEventListener('click', addSavedItem);
            save_img.classList.add('icon-img');
            save_box.appendChild(save_img);

            item_description_box.appendChild(save_box);

            item_cnt.appendChild(item_description_box);
         
            big_cnt.appendChild(item_cnt);

            index_json = index_json + 1;
        }
    }
}








