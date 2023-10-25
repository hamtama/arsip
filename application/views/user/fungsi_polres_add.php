<script>
$(document).ready(function() {
    $('.leaflet-container').css({
        "max-width": "100%",
        "max-height": "100%",
        "height": "400px",
        "width": "600px",

    });
});

const cities = L.layerGroup();
<?php foreach ($map as $map) : ?>
const <?= $map['name'] ?> = L.marker([<?= $map['latitude'] ?>, <?= $map['longitude'] ?>]).bindPopup(
    '<?= $map['nama_polres'] ?>').addTo(cities);
<?php endforeach; ?>


const mbAttr =
    'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
const mbUrl =
    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

const streets = L.tileLayer(mbUrl, {
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    attribution: mbAttr
});

const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

const map = L.map('maps', {
    center: [-7.797068, 110.370529],
    zoom: 11,
    layers: [osm, cities]
});

const baseLayers = {
    'OpenStreetMap': osm,
    'Streets': streets
};

const overlays = {
    'Cities': cities
};


const layerControl = L.control.layers(baseLayers, overlays).addTo(map);
const crownHill = L.marker([-7.797068, 110.370529]).bindPopup('This is Crown Hill Park.');
const rubyHill = L.marker([-7.797068, 110.370529]).bindPopup('This is Ruby Hill Park.');
const parks = L.layerGroup([crownHill, rubyHill]);


const satellite = L.tileLayer(mbUrl, {
    id: 'mapbox/satellite-v9',
    tileSize: 512,
    zoomOffset: -1,
    attribution: mbAttr
});


layerControl.addBaseLayer(satellite, 'Satellite');
layerControl.addOverlay(parks, 'Parks');
L.control.scale().addTo(map);



var mapId = document.getElementById('maps');

function fullScreenView() {
    mapId.requestFullscreen();
}

var removeMarkers = function() {
    map.eachLayer(function(layer) {

        if (layer.myTag && layer.myTag === "myGeoJSON") {
            map.removeLayer(layer)
        }

    });

}



map.on('click', function(e) {
    console.log(e)
    $('.coordinate').html(`Lat: ${e.latlng.lat} Lng: ${e.latlng.lng}`);
})

// Search Location
L.Control.geocoder().addTo(map);
</script>