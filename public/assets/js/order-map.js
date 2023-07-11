// Leaflet has native support for raster maps, So you can create a map with a few commands only!

// The Leaflet map Object
const map = L.map('order-map').setView([48.1500327, 11.5753989], 10);

// The API Key provided is restricted to JSFiddle website
// Get your own API Key on https://myprojects.geoapify.com
const myAPIKey = "02b784fd8c9b4ab9a32db499e5e5d234";

// Retina displays require different mat tiles quality
const isRetina = L.Browser.retina;

const baseUrl = "https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}.png?apiKey={apiKey}";
const retinaUrl = "https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}@2x.png?apiKey={apiKey}";

// Add map tiles layer. Set 20 as the maximal zoom and provide map data attribution.
L.tileLayer(isRetina ? retinaUrl : baseUrl, {
    attribution: 'Powered by <a href="https://www.geoapify.com/" target="_blank">Geoapify</a> | © OpenStreetMap <a href="https://www.openstreetmap.org/copyright" target="_blank">contributors</a>',
    apiKey: myAPIKey,
    maxZoom: 20,
    id: 'osm-bright',
}).addTo(map);

//add a marker with icon generated by Geoapify Marker Icon API
const markerIcon = L.icon({
    iconUrl: `https://api.geoapify.com/v1/icon?size=xx-large&type=awesome&color=%233e9cfe&icon=paw&apiKey=${myAPIKey}`,
    iconSize: [31, 46], // size of the icon
    iconAnchor: [15.5, 42], // point of the icon which will correspond to marker's location
    popupAnchor: [0, -45] // point from which the popup should open relative to the iconAnchor
});

const zooMarkerPopup = L.popup().setContent("This is Munich Zoo");
L.marker([48.096980, 11.555466], {
    icon: markerIcon
}).bindPopup(zooMarkerPopup).addTo(map);
L.marker([47.096980, 10.555466], {
    icon: markerIcon
}).bindPopup(zooMarkerPopup).addTo(map);
