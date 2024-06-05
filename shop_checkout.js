//variabili che mi servono per poi fare la fetch che mi salva le cose dentro al db
let nome = '';
let lastname = '';
let address = '';
let city = '';
let zipcode = '';
let phone = '';
let shipping_type = 0;
let costo_tot = 0;
let json_saved = null;


fetch('load_cart.php').then(response => response.json()).then(onJson);

function onJson(json) {
    /*console.log("DATi nel carrello:" + json);*/

    json_saved = json;


    const cnt_items = document.getElementById('box-items');

    for (let key in json) {//qua vengono inseriti tutti i dati della pagina


        const box_item = document.createElement('div');
        box_item.classList.add('box-item');
        box_item.dataset.id = json[key].itemID;

        const box_img = document.createElement('div');
        box_img.classList.add('box-img');
        /*console.log(box_img);*/
        const img = document.createElement('img');
        img.src = json[key].img1;
        img.classList.add('img-item');
        box_img.appendChild(img);
        box_item.appendChild(box_img);

        const box_information = document.createElement('div');
        box_information.classList.add('box-information');
        box_information.classList.add('dim');

        const brand_name_box = document.createElement('div');
        brand_name_box.classList.add('brand-name-box');
        brand_name_box.textContent = json[key].brand;
        box_information.appendChild(brand_name_box);

        const item_name_box = document.createElement('div');
        item_name_box.classList.add('item-name-box');
        item_name_box.textContent = json[key].nome;
        box_information.appendChild(item_name_box);

        const color_box = document.createElement('div');
        color_box.classList.add('color-box');
        color_box.textContent = json[key].colore;
        box_information.appendChild(color_box);

        const size_box = document.createElement('div');
        size_box.classList.add('size-box');
        size_box.textContent = json[key].size_item;
        box_information.appendChild(size_box);

        const box_costo = document.createElement('div');
        box_costo.classList.add('box-costo');
        box_costo.textContent = json[key].costo + ",00$";
        box_information.appendChild(box_costo);

        const filler = document.createElement('div');
        filler.classList.add('filler');
        box_information.appendChild(filler);

        costo_tot = costo_tot + parseInt(json[key].costo);

        box_item.appendChild(box_information);
        cnt_items.appendChild(box_item);
    }
    const subtotal = document.getElementById('subtotal');
    subtotal.textContent = costo_tot + ",00$";
}



const form_address_data = document.getElementById('address-data');
form_address_data.addEventListener('submit', function (event) {//salva i dati inseriti per lo shipping
    event.preventDefault();

    const button = document.getElementById('submit-address-data');
    /*button.classList.add('unclickable');*/


    const form = event.currentTarget;

    nome = form.elements['name'].value;
    lastname = form.elements['lastname'].value;
    address = form.elements['address'].value;
    city = form.elements['city'].value;


    const numeri = /^\d+$/;
    if (numeri.test(form.elements['zipcode'].value) && numeri.test(form.elements['phonenumber'].value)) {//controlla se sono stati inseriti solamente numeri
        zipcode = form.elements['zipcode'].value;
        phone = form.elements['phonenumber'].value;
    } else {
        const messagge = document.getElementById('message-insert-address');
        messagge.classList.remove('hidden');
        messagge.classList.add('error');
        messagge.textContent = 'Inserire correttamente zipcode e/o numero di telefono';
    }

    if (!nome || !lastname || !address || !city || !zipcode || !phone) {
        alert('Please fill out all required fields.');
        return;
    } else if (zipcode.lengt != 5 && phone.length != 10) {
        
        const messagge = document.getElementById('message-insert-address');
        messagge.classList.remove('hidden');
        messagge.classList.add('error');
        messagge.textContent = 'Inserire correttamente zipcode e/o numero di telefono';
    } else {
        const messagge = document.getElementById('message-insert-address');
        messagge.classList.remove('hidden');
        messagge.textContent = 'Dati inseriti correttamente';
        form_address_data.removeEventListener('submit', function () { });
        button.classList.add('unclickable');
    }

});


const form_shipping_method = document.getElementById('shipping-method');
form_shipping_method.addEventListener('submit', function (event) { //salva il tipo di shipping

    event.preventDefault();

    const shipping_form = event.currentTarget;
    const select = shipping_form.elements['shipping-method-select'];
    shipping_type = select.value;


    const shipping_cost = document.getElementById('shipping-cost');


    if (shipping_type == 1 || shipping_type == 2) {
        shipping_cost.textContent = '10,00$';
        const total = document.getElementById('total');
        total.textContent = (parseInt(costo_tot) + 10) + ",00$";
    } else if (shipping_type == 3) {
        shipping_cost.textContent = '15,00$';
        const total = document.getElementById('total');
        total.textContent = (parseInt(costo_tot) + 15) + ",00$";
    }



    const messagge = document.getElementById('message-insert-shipping');
    messagge.textContent = 'Dati inseriti correttamente';
    messagge.classList.remove('hidden');

    form_shipping_method.removeEventListener('submit');

});

const form = document.getElementById('payment-method');
/*console.log(form);*/
form.addEventListener('submit', function (event) { //qua fa apparire la schermata per inserire i dati di pagamento
    event.preventDefault();


    const selectedRadio = form.querySelector('input[name="payment-method"]:checked');
    const selectedValue = selectedRadio.value;


    if (selectedValue == 'card') {
        const box = document.getElementById('box-payment-data');
        box.classList.remove('hidden');
    }
});



const form_payment_data = document.getElementById('payment-data');
//in teoria diovrebbe essere una api esterna

form_payment_data.addEventListener('submit', function (event) {
    event.preventDefault();

    //qua si occupa di fare la fetch per salvare i dati nella tabella degli ordini e si occupa anche di 
    // fare una fetch ad una pagine che elimina il carrello

    fetch('add_order_data.php?name=' + nome + "&lastname=" + lastname + "&phone=" + phone
        + "&address=" + address + "&city=" + city + "&zipcode=" + zipcode + "&shipping_type=" + shipping_type
    ).then(response => response.json()).then(function (json) {
        //qua fa apparire un messaggio di ordine avvenuto con successo
        //mi devo fare tornare l'order id cosi da passarlo alla funzione che si occupa di aggiunger
        //gli elementi nella tabella order_items dichiarate dentro il json
        /*console.log("ORDERID: "+json);*/
        /*console.log(json_saved);*/
        const orderID=json[0].orderID;

        for(let key in json_saved){
            fetch('add_order_items.php?orderID=' + orderID + "&itemID=" + json_saved[key].itemID + "&size=" + json_saved[key].size_item)
            .then(response=>response.json()).then(function(event){
                /*console.log("Inserimento item:" + event);*/
            });
        }       
    });

    document.getElementById('check-order').classList.remove('hidden');

});
