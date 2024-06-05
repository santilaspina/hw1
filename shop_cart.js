fetch('load_cart.php').then(onResponse).then(onJson);

function onResponse(event) {
    return event.json();
}

function onJson(json) {
    console.log(json);
    let costo_tot = 0;
    for (let key in json) {
        console.log(json[key]);

        const cnt_cart_item = document.createElement('div');
        cnt_cart_item.classList.add('cnt-cart-item');
        cnt_cart_item.id=json[key].itemID;

        const cnt_img = document.createElement('a');
        cnt_img.classList.add('cnt-img');
        cnt_img.href='shop_detail.php?itemID=' + json[key].itemID;

        const img = document.createElement('img');
        img.classList.add('img-item');

        console.log(json[key].img1);



        img.src = json[key].img1;
        console.log(img);

        cnt_img.appendChild(img);
        cnt_cart_item.appendChild(cnt_img);

        const cnt_info = document.createElement('div');
        cnt_info.classList.add('cnt-info');

        const box_dx = document.createElement('div');
        box_dx.classList.add('box-dx');

        const box_details = document.createElement('div');
        box_details.classList.add('box-details');

        const brand_name = document.createElement('div');
        brand_name.classList.add('brand-name-box');
        brand_name.textContent = json[key].brand;

        const item_name = document.createElement('div');
        item_name.classList.add('item-name-box');
        item_name.textContent = json[key].nome;

        const item_color = document.createElement('div');
        item_color.classList.add('color-box');
        item_color.textContent = "Color: " + json[key].colore;

        const item_size = document.createElement('div');
        item_size.classList.add('size-box');
        item_size.textContent = "Size: " + json[key].size_item;

        const filler = document.createElement('div');
        filler.classList.add('filler');

        box_details.appendChild(brand_name);
        box_details.appendChild(item_name);
        box_details.appendChild(item_color);
        box_details.appendChild(item_size);
        box_details.appendChild(filler);

        const box_opt = document.createElement('div');
        box_opt.classList.add('box-option');

        const rmv_box = document.createElement('div'); //quan poi aggiungere l'event listener per eliminare l'item dal carrello, con relativa fetch
        rmv_box.classList.add('remove-box');
        rmv_box.id = json[0].itemID;
        rmv_box.textContent = "Remove";

        rmv_box.addEventListener('click', RemoveShoppingCart);              
        
        
        function RemoveShoppingCart(){
    
            fetch('remove_shopping_cart.php?itemID=' + json[key].itemID).then(response=>response.json()).then(function(json){console.log(json)});
    
            costo_tot = costo_tot - parseInt(json[key].costo);
    
            const subtotal = document.getElementById('subtotal');
            subtotal.textContent = costo_tot + ",00 $";
    
            const total = document.getElementById('total');
            total.textContent = (parseInt(costo_tot) + 15) + ",00 $";   
            
            const cnt= document.getElementById(json[key].itemID);
            console.log(cnt);

            document.getElementById('cnt-items').removeChild(cnt);   
        }







        const ltr_box = document.createElement('div');
        ltr_box.classList.add('later-box');
        ltr_box.id = "save-later";
        ltr_box.textContent = "Save For Later"; //qua aggiungere l'event listenere per toglierlo dal carrello e aggiungerlo ai preferiti, con relativa fetch

        ltr_box.addEventListener('click', AddSaved);
        ltr_box.addEventListener('click', RemoveShoppingCart);

        function AddSaved(event){

            fetch('saved.php?action=2&itemID='+ json[key].itemID).then(response=>response.json()).then(function(json){console.log(json)});

        }




        box_opt.appendChild(rmv_box);
        box_opt.appendChild(ltr_box);

        box_dx.appendChild(box_details);
        box_dx.appendChild(box_opt);

        const box_sx = document.createElement('div');
        box_sx.classList.add('box-sx');

        const item_costo = document.createElement('div');
        item_costo.classList.add('box-costo');
        item_costo.textContent = json[key].costo + ",00$";
        costo_tot = costo_tot + parseInt(json[key].costo);

        box_sx.appendChild(item_costo);

        cnt_info.appendChild(box_dx);
        cnt_info.appendChild(box_sx);

        cnt_cart_item.appendChild(cnt_info);

        document.getElementById('cnt-items').appendChild(cnt_cart_item);


        //manca tutta la parte della somma dei prezzi e manca pure la media query in css quando lo schermo si rimpicciolisce
    }

    console.log(costo_tot);

    const subtotal = document.getElementById('subtotal');
    subtotal.textContent = costo_tot + ",00 $";

    const total = document.getElementById('total');
    total.textContent = (parseInt(costo_tot) + 15) + ",00 $";

    //qua faccio la parte delle fetch per rimuovere gli elementi dal carrello o aggiungerli ai preferiti


    



}

