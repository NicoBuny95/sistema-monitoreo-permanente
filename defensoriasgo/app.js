let map = L.map('map').setView([-27.540846,-64.929762],8)



//Agregar tilelAyer mapa base desde openstreetmap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

document.getElementById('select-location').addEventListener('change',function(e){
  let coords = e.target.value.split(",");
  map.flyTo(coords,16);
})

//añadir un marcador

// rio marapa
var marker = L.marker([-27.675997,-65.425211]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.675997,-65.425211])
    .setContent("Rio Graneros")
    .openOn(map)


// arroyo matazambi
var marker = L.marker([-27.582768,-65.078598]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.582768,-65.078598])
    .setContent("Arroyo matazambi")
    .openOn(map)


// arroyo colorado
var marker = L.marker([-27.475314, -65.619984]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.475314, -65.619984])
    .setContent("Rio Chico")
    .openOn(map)


// rio colorado
    var marker = L.marker([-27.159618, -65.363922]).addTo(map);

    var popup = L.popup()
        .setLatLng([-27.159618, -65.363922])
        .setContent("Rio Colorado")
        .openOn(map)

// rio sali
var marker = L.marker([-27.157715, -65.322194]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.157715, -65.322194])
    .setContent("Rio Sali")
    .openOn(map)

// rio gastona
var marker = L.marker([-27.419498, -65.409482]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.419498, -65.409482])
    .setContent("Rio Gastona")
    .openOn(map)

// rio seco
var marker = L.marker([-27.285381, -65.550499]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.285381, -65.550499])
    .setContent("Rio Seco")
    .openOn(map)

    // rio murallon
var marker = L.marker([-27.512376, -64.894972]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.512376, -64.894972])
    .setContent("Murallon")
    .openOn(map)

// rio dulce
var marker = L.marker([-27.490886, -64.836646]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.490886, -64.836646])
    .setContent("rio dulce")
    .openOn(map)


// rio dulce
var marker = L.marker([-27.407421, -65.124566]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.407421, -65.124566])
    .setContent("arroyo mixta")
    .openOn(map)


// termas
var marker = L.marker([-27.540846,-64.929762]).addTo(map);

var popup = L.popup()
    .setLatLng([-27.540846,-64.929762])
    .setContent("Embalse termas de rio hondo")
    .openOn(map)
    



    //data tables