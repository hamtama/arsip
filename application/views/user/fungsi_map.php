<script>
var geomap;
var nilaiMax;
var geojson;




$('#tahun, #bulan').change(function() {
    var tahun = $('#tahun').val();
    var bulan = $('#bulan').val();
    // console.log(bulan);
    $.ajax({
        url: "/polres/searchmap",
        type: "POST",
        dataType: 'json',
        data: {
            tahun: tahun,
            bulan: bulan
        },
        success: function(data) {
            geomap = data.geojson;
            nilaiMax = data.nilaiMax.max;
            removeMarkers();
            showsearch();
        }
    });

});



const cities = L.layerGroup();
<?php foreach ($map as $map) : ?>

const <?= $map['name'] ?> = L.marker([<?= $map['latitude'] ?>, <?= $map['longitude'] ?>]).bindPopup(
    '<?= $map['nama_polres'] ?>').addTo(cities);
// const mDenver = L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.').addTo(cities);
// const mAurora = L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.').addTo(cities);
// const mGolden = L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.').addTo(cities);



<?php endforeach; ?>


function getColor(d) {
    return d > (nilaiMax / 8) * 7 ? '#800026' :
        d > (nilaiMax / 8) * 6 ? '#BD0026' :
        d > (nilaiMax / 8) * 5 ? '#E31A1C' :
        d > (nilaiMax / 8) * 4 ? '#FC4E2A' :
        d > (nilaiMax / 8) * 3 ? '#FD8D3C' :
        d > (nilaiMax / 8) * 2 ? '#FEB24C' :
        d > (nilaiMax / 8) * 1 ? '#FED976' :
        d == 0 ? '#ffffff' :
        '#FFEDA0';
}



function style(feature) {
    return {
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7,
        fillColor: getColor(parseInt(feature.properties.nilai))
    };
}


function onEachFeature(feature, layer) {
    console.log(feature.properties.nilai);
    layer.bindPopup("Jumlah Kejahatan Konvensional " + feature.properties.region + " : " + feature.properties
        .nilai +
        " Kasus");
    layer.myTag = "myGeoJSON"
}

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


function showsearch() {
    geojson = L.geoJson(geomap, {
        // remove: remove,
        style: style,
        onEachFeature: onEachFeature,
    }).addTo(map);
}



//// calling function 

// removesearch();










map.on('click', function(e) {
    console.log(e)
    $('.coordinate').html(`Lat: ${e.latlng.lat} Lng: ${e.latlng.lng}`);
})

// Search Location
L.Control.geocoder().addTo(map);




// var map = L.map('maps').setView([-7.797068, 110.370529], 12);
// L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 19,
//     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
// }).addTo(map);
// var marker = L.marker([-7.797068, 110.370529]).addTo(map);
// marker = L.marker([-7.757126, 110.400440]).addTo(map);
// marker.bindPopup("Yogyakarta").openPopup();
</script>