

import L from 'leaflet';
import 'devbridge-autocomplete';

let map = L.map('map').setView([46.232, 2.232], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var marker = L.marker([ 48.4438, 1.48814]).addTo(map);
var marker = L.marker([ 48.4438, 1.414]).addTo(map);
var marker = L.marker([ 48.4438, 1.47]).addTo(map);


marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
marker.bindPopup("<b>Hello 1!</b><br>I am a popup.").openPopup();