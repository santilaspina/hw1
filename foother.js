document.addEventListener("DOMContentLoaded", mapsAPI); //appena finisce di caricare la pagina html chiama la funzione 



function mapsAPI() {
    var pos = { lat: 52.5028966, lng: 13.3237714 }; //pos è una variabile che indica la posizione in cui centrare la mappa
    var map = new google.maps.Map(document.getElementById('map'), { //questo crea l'oggetto mappa di google e lo mette dentra il div con id = map
        center: pos, zoom: 14, mapId: "DEMO_MAP_ID",
    })

    var marker = new google.maps.marker.AdvancedMarkerElement({
        position: pos,
        map: map,
        title: "Highsnobiety Berlin Office"
    });
}