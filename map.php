<?php
    include('include/importcss.php'); // เรียกใช่ไฟล์ include css
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาตำแหน่ง</title>
</head>

<body>
    <style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

    #map {
        height: 500px;
    }

    /* Optional: Makes the sample page fill the window. */

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        background-color: #fff;
        border: 0;
        border-radius: 2px;
        box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
        margin: 10px;
        padding: 0 0.5em;
        font: 400 18px Roboto, Arial, sans-serif;
        overflow: hidden;
        font-family: Roboto;
        padding: 0;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #searchInput {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
    }

    #searchInput:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }

    #target {
        width: 345px;
    }
    </style>


    <!-- Google map -->
    <div id="map"></div>

    <!-- Search input -->
    <input id="searchInput" class="controls" type="text" placeholder="Search Box" />
    <!-- Display geolocation data -->
    <ul class="geo-data">
        <br>
        <li>Full Address: <span id="location"></span></li>
        <li>Postal Code: <span id="postal_code"></span></li>
        <li>Country: <span id="country"></span></li>
        <li>Latitude: <span id="lat"></span></li>
        <li>Longitude: <span id="lon"></span></li>
        <br>
        <a href="openrestaurant.php" class="btn btn-warning mb-2  float-left">
            Close
        </a>
    </ul>

    <!-- <div class="modal-footer">
        <a href="openrestaurant.php" class="btn btn-info mb-2  float-right">
            หาตำแหน่ง ละติจูด ลองจิจูด
        </a>
    </div> -->

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpaHi6JeMnPBYV7MnnG3anyPz5rho4Wl4&callback=initAutocomplete&libraries=places&v=weekly"
        async></script>

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBpaHi6JeMnPBYV7MnnG3anyPz5rho4Wl4">
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBpaHi6JeMnPBYV7MnnG3anyPz5rho4Wl4&callback=initMap"
        async defer></script>
    <script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -33.8688,
                lng: 151.2195
            },
            zoom: 13
        });
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if (place.address_components[i].types[0] == 'postal_code') {
                    document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                }
                if (place.address_components[i].types[0] == 'country') {
                    document.getElementById('country').innerHTML = place.address_components[i].long_name;
                }
            }
            document.getElementById('location').innerHTML = place.formatted_address;
            document.getElementById('lat').innerHTML = place.geometry.location.lat();
            document.getElementById('lon').innerHTML = place.geometry.location.lng();
        });
    }
    </script>

</body>

</html>