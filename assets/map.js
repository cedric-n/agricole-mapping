

import L from 'leaflet';
import 'devbridge-autocomplete';

let map = L.map('map').setView([48.852969, 2.349903], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var marker = L.marker([ 48.4438, 1.48814]).addTo(map);
var marker = L.marker([ 45.4438, 1.414]).addTo(map);
var marker = L.marker([ 49.4438, 1.47]).addTo(map);


marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
marker.bindPopup("<b>Hello 1!</b><br>I am a popup.").openPopup();