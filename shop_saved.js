function onJson(json) {
    console.log(json);


    for (let key in json) {

        const big_cnt = document.querySelector('.cnt-big');

        const item_cnt = document.createElement('div');
        item_cnt.classList.add('item-cnt');
        /*item_cnt.href=linkURL*/
        item_cnt.dataset.id = json[key].itemID;


        const linkURL = 'shop_detail.php?itemID=' + json[key].itemID;
        const item_img = document.createElement('a');
        item_img.classList.add('item-img');
        const img = document.createElement('img');  
        img.classList.add('immagine');
        img.classList.add('zoom');
        /*console.log(json[index_json]);*/
        img.src = json[key].img1;
        item_img.href = linkURL;

        img.addEventListener('mouseenter', function (event) {
            const img = event.currentTarget;
            img.src = json[key].img2;
        });

        img.addEventListener('mouseleave', function (event) {
            const img = event.currentTarget;
            img.src = json[key].img1;
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
        title_box.textContent = json[key].brand;
        description_box.appendChild(title_box);

        const description_box_text = document.createElement('div');
        description_box_text.classList.add('description-box-text');
        description_box_text.innerHTML = json[key].nome + "<br>" + json[key].costo + "$";
        description_box.appendChild(description_box_text);

        item_description_box.appendChild(description_box);

        const save_box = document.createElement('div');
        save_box.classList.add('save-box');
        const save_img = document.createElement('img');
        save_img.classList.add('icon-img');
        save_img.dataset.id = json[key].itemID;
        save_img.src = 'immagini/icons8-cestino-64.png';



        save_img.addEventListener('click', function (event) {

            const img = event.currentTarget;
            console.log(img.dataset.id);
            fetch('saved.php?action=3&itemID=' + img.dataset.id).then(response => response.json()).then(dataJson => {
                console.log(dataJson)
                if (dataJson == true) {

                    const big_cnt = document.querySelector('.cnt-big');
                    const item_cnt = document.querySelectorAll('.cnt-big .item-cnt');
                    

                    for (let key in item_cnt) {
                        if (item_cnt[key].dataset.id == img.dataset.id) {
                            console.log(item_cnt[key].dataset.id)
                            big_cnt.removeChild(item_cnt[key]);
                        }
                    }
                }
            });
        });



        save_box.appendChild(save_img);
        item_description_box.appendChild(save_box);
        item_cnt.appendChild(item_description_box);
        console.log(item_cnt);
        big_cnt.appendChild(item_cnt);

        /*index_json = y + 1;*/



    }








}




fetch('saved.php?action=4').then(response => {
    return response.json();
}).then(onJson);
