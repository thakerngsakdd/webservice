function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'ru',
        layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT,
        autoDisplay: false
    }, 'google_translate_element');
}

var boundsByCity, map, iplat, iplng, ipll, cityll, circle, marker, marker2, addr, type, lat2, lng2, contentString, streetAuto, mtUrl;
var geocoder = new google.maps.Geocoder();
var locality = localStorage["oXzypP.locality"] || "";
var street = localStorage["oXzypP.street"] || "";
var house = localStorage["oXzypP.house"] || "";
var lat = localStorage["oXzypP.lat"] || "";
var lng = localStorage["oXzypP.lng"] || "";

var countmarker = 0;
var countmarker2 = 0;
var n = 100000; //round coordinates to 5-th digit after comma
var initialGPSofMap = new google.maps.LatLng(48.379433, 31.16558); //центр Украины
var initialZoom = 6; //помещается вся украина
var cityZoom = 12;
var streetZoom = 16;
var houseZoom = 18;
var maxDistanse = 90; //граничное расстояние при определении ближайшего адреса или при определении местоположения браузера
var geolocationIcon = "";
var wrongStreet = /([а-я-a-z]{1}[0-9]{2,4})|(Unnamed Road)/ig;
var searchPK = "http://www.multitest.ua/api/v1/address_search/?format=json&address=";
var types = ["street_address", "premise", "street_number"];
var infowindow = new google.maps.InfoWindow({
    content: contentString
});

document.body.addEventListener('keydown', function(e) {
    if (e.keyCode === 13) {
        buttonClick();
    }
}, false);

var myFirebaseRef = new Firebase("https://popping-inferno-4105.firebaseio.com/searchRequests/");

function addAddressFB(address) {
    myFirebaseRef.push({
        title: address,
        created: Firebase.ServerValue.TIMESTAMP
    });
}

var limitLastSR = 9;

myFirebaseRef.limitToLast(limitLastSR).on("child_added", function(snapshot) {
    callback(snapshot.val());
});

var counter = 0;
var arrFB = [];

function callback(obj) {
    counter++;
    arrFB[counter] = {};
    arrFB[counter].datetime = new Date(obj.created).toTimeString().substr(0, 8);
    arrFB[counter].title = obj.title;
    printSR(arrFB, limitLastSR);
}

function printSR(arr, limit) {
    $("#res1").prepend('<li id="' + counter + '" class="col1">' + arr[counter].datetime + " <a href=#>" + arr[counter].title + "</a></li>");
    if (counter > limit / 3) {
        $(".col1").remove("#" + (counter - limit / 3));
        $("#res2").prepend('<li id="' + (counter - limit / 3) + '" class="col2">' + arr[counter - limit / 3].datetime + " <a href=#>" + arr[counter - limit / 3].title + "</a></li>");
    }
    if (counter > limit / 3 * 2) {
        $(".col2").remove("#" + (counter - limit / 3 * 2));
        $("#res3").prepend('<li id="' + (counter - limit / 3 * 2) + '" class="col3">' + arr[counter - limit / 3 * 2].datetime + " <a href=#>" + arr[counter - limit / 3 * 2].title + "</a></li>");
    }
    if (counter > limit) {
        $(".col3").remove("#" + (counter - limit));
    }
}

//locality autocomplete start
var localityInput = document.getElementById('locality');
var localityOptions = {
    types: ['(cities)'], //localities and admin_level_3
    componentRestrictions: {
        country: 'ua' //Ukraine only
    }
};
var locAuto = new google.maps.places.Autocomplete(localityInput, localityOptions);
//locality autocomplete end

//initialize
$(window).load(function() {
    startMap();
    if (locality == "") {
        getLocalityByIp();
    } else {
        $('#locality').val(locality);
        $("#localityDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
        $('#route').focus();
    }
    if (street + house != "") {
        $('#route').val(street + ", " + house).attr('disabled', false);
        $("#streetHouseDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
        $('.btn').attr('disabled', false);
    }
});

function getLocalityByIp() {
    $.getJSON("http://freegeoip.net/json/", function(data) {
        $.each(data, function(key, val) {
            if (key == "latitude") {
                iplat = val;
            }
            if (key == "longitude") {
                iplng = val;
                ipll = new google.maps.LatLng(iplat, iplng);
                codeLocality(ipll);
            }
        });
    });
}

function startMap() {
    var myOptions = {
        zoom: initialZoom,
        streetViewControl: false, //не показывать пешехода
        center: initialGPSofMap
    };
    map = new google.maps.Map(document.getElementById("map"), myOptions);

    //leftclick event
    var leftClickMarker = google.maps.event.addListener(map, 'click', function(l) {
        lat = l.latLng.lat();
        lng = l.latLng.lng();
        setMarker(lat, lng);
    });

    //rightclick event
    var rightClickMarker = google.maps.event.addListener(map, 'rightclick', function(r) {
        lat = r.latLng.lat();
        lng = r.latLng.lng();
        setMarker(lat, lng);
    });
}

function setMarker(lt, lg) {
    ll = new google.maps.LatLng(lt, lg);
    if (countmarker === 0) { //if no marker than add
        marker = new google.maps.Marker({
            position: ll,
            map: map,
            draggable: true
        });
        printMarkerPosition(ll);
        countmarker += 1;
        map.panTo(ll);
        //map.setZoom(17);
        geocodePosition(ll);

    } else { //if there is marker - than move
        marker.setPosition(ll);
        printMarkerPosition(ll);
        map.panTo(ll);
        //map.setZoom(17);
        geocodePosition(ll);

    }
    //marker drag event listen
    google.maps.event.addListener(marker, 'dragend', function() {
        lat = marker.getPosition().lat();
        lng = marker.getPosition().lng();
        ll = (marker.getPosition());
        map.panTo(marker.getPosition());
        printMarkerPosition(ll);
        //map.setZoom(17);
        geocodePosition(ll);
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
    });
}

function codeLocality(pos) {
    geocoder.geocode({
        'latLng': pos
    }, function(responses) {
        boundsByCity = responses[0].geometry.viewport;
        for (var i = 0; i < responses[0].address_components.length; i++) {
            if (responses[0].address_components[i].types[0] == "locality") {
                locality = responses[0].address_components[i].long_name;
                localStorage.setItem("oXzypP.locality", locality);

            }
        }
        /*$('[data-toggle="tooltip"]').tooltip({
          placement: 'bottom'
        }).tooltip('show');*/
        $("#localityDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
        $("#locality").val(locality);
        cityll = responses[0].geometry.location;
        map.panTo(cityll);
        map.setZoom(cityZoom);
        streetAutocomplete();
    });
}

google.maps.event.addListener(locAuto, 'place_changed', function() {
    if (typeof locAuto.getPlace().types[0] != 'undefined') {
        if (locAuto.getPlace().types[0] != "locality") {
            alert("Пожалуйста, выберите населенный пункт из списка");
            $('#locality').val("").focus();
            $("#localityDIV").removeClass('has-error').addClass('has-warning').removeClass('has-success');
            $("#route").val("");

        } else {
            map.setZoom(cityZoom);
            map.panTo(locAuto.getPlace().geometry.location);
            codeLocality(locAuto.getPlace().geometry.location);
            $('#route').val("").focus();
            $("#streetHouseDIV").removeClass('has-error').addClass('has-warning').removeClass('has-success');
            boundsByCity = locAuto.getPlace().geometry.viewport;
            streetAutocomplete();
        }
    }
});

function streetAutocomplete() { //подсказка 2-го поля
    $('#route').attr('disabled', false).focus();
    var routeInput = document.getElementById('route');
    var routeOptions = {
        bounds: boundsByCity,
        types: ['geocode'],
        componentRestrictions: {
            country: 'ua' //Ukraine only
        }
    };

    streetAuto = new google.maps.places.Autocomplete(routeInput, routeOptions);

    google.maps.event.addListener(streetAuto, 'place_changed', function() {
        if (types.indexOf(streetAuto.getPlace().types[0]) > -1) { //проверяем, что ответ - номер дома
            for (var i = 0; i < streetAuto.getPlace().address_components.length; i++) { //находим город
                if (streetAuto.getPlace().address_components[i].types[0] == "locality") { //проверяем, что населенный пункт совпадает          
                    if (streetAuto.getPlace().address_components[i].long_name != locality) {
                        if (confirm("Населенный пункт выбранного адреса отличается от введенного ранее. Подтверждаете изменение?")) {
                            locality = streetAuto.getPlace().address_components[i].long_name;
                            $("#locality").val(locality);
                            localStorage.setItem("oXzypP.locality", locality);

                            $("#localityDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
                            street = streetAuto.getPlace().address_components[1].long_name;
                            house = streetAuto.getPlace().address_components[0].long_name;
                            localStorage.setItem("oXzypP.street", street);
                            localStorage.setItem("oXzypP.house", house);
                            addAddressFB(locality + ", " + street + ", " + house);

                            lat = Math.round(streetAuto.getPlace().geometry.location.lat() * n) / n;
                            lng = Math.round(streetAuto.getPlace().geometry.location.lng() * n) / n;
                            map.setZoom(houseZoom);
                            map.panTo(streetAuto.getPlace().geometry.location);
                            setMarker(lat, lng);

                            $('#route').val(street + ", " + house);

                            console.log(localStorage);
                            $("#streetHouseDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
                            $("#result").empty();
                            $("#result").append("Полный адрес: <b>" + locality + ", " + street + ", " + house + "</b>" + ", " + lat + ", " + lng + "</br>" + "Place_id: " + streetAuto.getPlace().place_id);
                        } else { //отказался от изменения НП
                            $('#route').val("").focus();
                            $("#streetHouseDIV").removeClass('has-error').addClass('has-warning').removeClass('has-success');
                            map.setZoom(cityZoom);
                            map.panTo(cityll);
                        }

                    } else { //совпадает с ранее введенным
                        street = streetAuto.getPlace().address_components[1].long_name;
                        house = streetAuto.getPlace().address_components[0].long_name;
                        localStorage.setItem("oXzypP.street", street);
                        localStorage.setItem("oXzypP.house", house);
                        addAddressFB(locality + ", " + street + ", " + house);
                        lat = Math.round(streetAuto.getPlace().geometry.location.lat() * n) / n;
                        lng = Math.round(streetAuto.getPlace().geometry.location.lng() * n) / n;
                        map.setZoom(houseZoom);
                        map.panTo(streetAuto.getPlace().geometry.location);
                        setMarker(lat, lng);

                        $('#route').val(street + ", " + house);
                        $('.btn').attr('disabled', false);
                        $("#streetHouseDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');

                    }
                }
            }

        } else if (streetAuto.getPlace().types[0] == "route") { //тип выбора улица
            var answer = prompt("Пожалуйста, укажите номер дома");
            if (answer === null) { //если не ответил

                $('#route').val("").focus();
                $("#streetHouseDIV").removeClass('has-error').addClass('has-warning').removeClass('has-success');
                map.setZoom(cityZoom);
                map.panTo(cityll);
            } else { //указал дом
                house = answer;

                localStorage.setItem("oXzypP.house", house);
                $('#route').val(streetAuto.getPlace().address_components[0].long_name + ", " + house);
                $("#streetHouseDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');

                $('#route').focus();
            }
        } else { //не дом и не улица
            alert("Пожалуйста, введите корректное название улицы и номер дома");
            $('#route').val("").focus();
            $("#streetHouseDIV").removeClass('has-error').addClass('has-warning').removeClass('has-success');
            map.setZoom(cityZoom);
            map.panTo(cityll);
        }
    });
}

/*function fillStreetHouse(result) {
  street = streetAuto.getPlace().address_components[1].long_name;
  house = streetAuto.getPlace().address_components[0].long_name;
  lat = Math.round(streetAuto.getPlace().geometry.location.lat() * n) / n;
  lng = Math.round(streetAuto.getPlace().geometry.location.lng() * n) / n;
  map.setZoom(houseZoom);
  map.panTo(map.panTo(cityll));
  setMarker(lat, lng);
  $('#route').val(street + ", " + house);
  $("#streetHouseDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
}*/

function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(result) {
        if (result && result.length > 0) {

            if (nativeCountryCheck(result[0])) { //ответ из Украины
                if (types.indexOf(result[0].types[0]) > -1) { //место - номер дома
                    for (var i = 0; i < result[0].address_components.length; i++) {
                        if (result[0].address_components[i].types[0] == "locality") {
                            locality = result[0].address_components[i].long_name;
                            localStorage.setItem("oXzypP.locality", locality);

                            $("#localityDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
                            $("#locality").val(locality);
                        } else if (result[0].address_components[i].types[0] == "route") {
                            street = result[0].address_components[i].long_name;
                            localStorage.setItem("oXzypP.street", street);

                        } else if (types.indexOf(result[0].address_components[i].types[0]) > -1) {
                            house = result[0].address_components[i].long_name;

                            localStorage.setItem("oXzypP.house", house);
                            addAddressFB(locality + "," + street + "," + house);

                        }
                        $('#route').val(street + ", " + house);
                        $("#streetHouseDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
                        $('.btn').attr('disabled', false);

                        contentString = '<b>Address</b>: ' +
                            locality + ", " + street + ", " + house + '</br>' +
                            '<b>GPS</b>: ' + '<a href="http://www.multitest.ua/coordinates/internet-v-kvartiru/?lat=' + pos.lat() + '&lng=' + pos.lng() + '" target="_blank">' + (Math.round(pos.lat() * n) / n).toFixed(5) + ", " + (Math.round(pos.lng() * n) / n).toFixed(5) + " " + '<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a>';

                        infowindow.open(map, marker);
                        infowindow.setContent(contentString);
                    }
                } else {
                    //todo дописать что делать если маркер не попал в дом
                    if (result[0].types[0] == "locality") {
                        for (var x = 0; x < result[0].address_components.length; x++) {
                            if (result[0].address_components[x].types[0] == "locality") {
                                locality = result[0].address_components[x].long_name;
                                localStorage.setItem("oXzypP.locality", locality);

                                $("#localityDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
                                $("#locality").val(locality);
                            }
                        }
                    } else if (result[0].types[0] == "route") {
                        for (var c = 0; c < result[0].address_components.length; c++) {
                            if (result[0].address_components[c].types[0] == "locality") {
                                locality = result[0].address_components[c].long_name;
                                localStorage.setItem("oXzypP.locality", locality);

                                $("#localityDIV").removeClass('has-error').removeClass('has-warning').addClass('has-success');
                                $("#locality").val(locality);
                            } else if (result[0].address_components[c].types[0] == "route") {
                                if (!result[0].address_components[c].long_name.match(wrongStreet)) {
                                    street = result[0].address_components[c].long_name;
                                    localStorage.setItem("oXzypP.street", street);

                                    $('#route').val(street).focus();
                                    $("#streetHouseDIV").removeClass('has-error').addClass('has-warning').removeClass('has-success');
                                } else {
                                    $('#route').val('').focus();
                                    $("#streetHouseDIV").removeClass('has-error').addClass('has-warning').removeClass('has-success')
                                }
                            }
                        }
                    }

                    contentString = '<b>Address</b>: ' +
                        result[0].formatted_address + '</br>' +
                        '<b>GPS</b>: ' + '<a href="http://www.multitest.ua/coordinates/internet-v-kvartiru/?lat=' + pos.lat() + '&lng=' + pos.lng() + '" target="_blank">' + (Math.round(pos.lat() * n) / n).toFixed(5) + ", " + (Math.round(pos.lng() * n) / n).toFixed(5) + " " + '<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a>';
                    infowindow.open(map, marker);
                    infowindow.setContent(contentString);

                }
                addr = result[0].formatted_address;
                updateMarkerAddress(addr);
                geocodeAddr(addr);
                printType(result[0].types[0]);
                printPrecision(result[0].geometry.location_type);
                printPlaceId(result[0].place_id);
            } else {
                updateMarkerAddress('Cannot determine address at this location.');
                document.getElementById('type').innerHTML = ".";
                document.getElementById('gps2').innerHTML = ".";
                document.getElementById('distance').innerHTML = ".";
            }
        }
    });
}

function geocodeAddr(address) {
    geocoder.geocode({
        address: address
    }, function(responses) {
        if (responses && responses.length > 0) {
            lat2 = responses[0].geometry.location.lat();
            lng2 = responses[0].geometry.location.lng();
            prntGPS2(new google.maps.LatLng(lat2, lng2));
            setMarker2(lat2, lng2);
            distance();

        }
        /*else {
              
              marker2.setMap(null);
            }*/
    });
}

$("#locality").change(function() { //when locality changes, empty other fields & marker

    $('#route').val("").focus();
    $("#streetHouseDIV").removeClass('has-error').addClass('has-warning').removeClass('has-success');

});

function printPrecision(str) {
    document.getElementById('precision').innerHTML = str;
}

function distance() {
    var latLngA = new google.maps.LatLng(lat, lng);
    var latLngB = new google.maps.LatLng(lat2, lng2);
    document.getElementById("distance").innerHTML = Math.round(google.maps.geometry.spherical.computeDistanceBetween(latLngA, latLngB));
}

function prntGPS2(gg) {
    document.getElementById('gps2').innerHTML = [
        Math.round(gg.lat() * n) / n,
        Math.round(gg.lng() * n) / n
    ].join(', ');
}

function printType(str) {
    document.getElementById('type').innerHTML = str;
}

function printPlaceId(str) {
    document.getElementById('place_id').innerHTML = '<a href="https://maps.googleapis.com/maps/api/place/details/json?key=AIzaSyBLDTHOplXqY6Uf5KPlH2sBVoDfEGDnSSA&placeid=' + str + '" target="_blank">' + str + '</a>';

}

function updateMarkerAddress(str) {
    document.getElementById('address').innerHTML = '<a href="https://maps.google.com/maps/api/geocode/json?sensor=false&language=ru&address=' + str + '" target="_blank">' + str + '</a>';
}

$(".spoiler-trigger").click(function() {
    $(this).parent().next().collapse('toggle');
});

$(".glyphicon-record").click(function() { //геолокация 
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            if (position.coords.accuracy < maxDistanse) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
                setMarker(lat, lng);
                console.log(position.coords.accuracy);
            } else {
                alert("Точное местоположение определить не удалось. Нажмите на нужный дом на карте");
                var geolocation = new google.maps.LatLng(
                    position.coords.latitude, position.coords.longitude);

                if (typeof circle != "undefined") {
                    circle.setMap(null);
                }
                if (typeof marker != "undefined") {
                    marker.setMap(null);
                    countmarker = 0;
                }
                circle = new google.maps.Circle({
                    strokeColor: "green",
                    strokeOpacity: 0.6,
                    strokeWeight: 1.5,
                    fillColor: "green",
                    fillOpacity: 0.2,
                    map: map,
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                streetAuto.setBounds(circle.getBounds());

                map.setZoom(houseZoom + 1 - Math.round(Math.pow(position.coords.accuracy, (1 / 4.4)))); //динамически подбираем масштаб карты в зависимости от радиуса геолокации
                map.panTo(geolocation); //при клике на круг удалять его
                google.maps.event.addListener(circle, 'click', function(event) {
                    circle.setMap(null);
                    map.setZoom(houseZoom);
                });
            }
        });
    } else {
        alert("Ваш браузер не поддерживает функцию геолокацию");
    }
});

function buttonClick() {
    var searchAPI = "http://www.multitest.ua/api/v1/address_search/?format=json&address=";
    var address = locality + ", " + street + ", " + house;
    var url;
    $.ajax({
        url: searchAPI + address,
        timeout: 1000,
        cache: false,
        success: function(html) {
            if (html) {
                url = 'http://www.multitest.ua' + html[0].handbook_url;
                window.open(url);
            } else {
                url = 'http://www.multitest.ua/coordinates/internet-v-kvartiru/?lat=' + lat + '&lng=' + lng;
                window.open(url);
            }
        }
    });
}

function nativeCountryCheck(result) {
    for (var j = 0; j < result.address_components.length; j++) {
        if (result.address_components[j].types[0] == "country") {
            if (result.address_components[j].short_name == "UA" || result.address_components[j].long_name == "Украина") {
                return true;

            } else {
                removeMarker();
                switch (result.address_components[j].short_name) {
                    case "RU":
                        if (confirm("Вы указали на местоположение за пределами Украины. Перейти на сайт Мультитест в России?")) {
                            window.open("http://www.multitest.ru");
                        }
                        return false;
                        break;
                    case "PL":
                        if (confirm("Вы указали на местоположение за пределами Украины. Перейти на сайт Мультитест в Польше?")) {
                            window.open("http://www.multitest.net.pl");
                        }
                        return false;
                        break;
                    case "US":
                        if (confirm("Вы указали на местоположение за пределами Украины. Перейти на сайт Мультитест в США?")) {
                            window.open("http://www.multitest.co");
                        }
                        return false;
                        break;
                    default:
                        if (confirm("Вы указали на местоположение за пределами Украины. Перейти на сайт Multitest.me?")) {
                            window.open("http://www.multitest.me");
                        }
                        return false;
                }
            }
        }
    }
}

function findPK(address, lat, lng) {
    $.ajax({
        url: searchPK + address,
        timeout: 500,
        cache: false,
        success: function(html) {
            if (html) {
                return ('http://www.multitest.ua' + html[0].handbook_url);
                window.open(url);
            } else {
                url = 'http://www.multitest.ua/coordinates/internet-v-kvartiru/?lat=' + lat + '&lng=' + lng;
                window.open(url);
            }
        },
        error: function() {
            url = 'http://www.multitest.ua/coordinates/internet-v-kvartiru/?lat=' + lat + '&lng=' + lng;
            window.open(url);
        }

    });
}

function removeMarker() {
    map.setZoom(cityZoom);
    map.panTo(cityll);
    marker.setMap(null);
    countmarker = 0;
}

/*$('#route').on("keypress", function(e) {
           
            if (e.keyCode == 13) {  // ENTER PRESSED
            }});*/

function printMarkerPosition(ll) {
    document.getElementById('gps').innerHTML = '<a href="https://maps.google.com/maps/api/geocode/json?sensor=false&language=ru&latlng=' + ll.lat() + "," + ll.lng() + '" target="_blank">' +
        (Math.round(ll.lat() * n) / n).toFixed(5) + ", " + (Math.round(ll.lng() * n) / n).toFixed(5) + '</a>';
}

/*function setMarker2(lat, lng) {
  ll = new google.maps.LatLng(lat, lng);
  if (countmarker2 === 0) { //if no marker than add
    marker2 = new google.maps.Marker({
      position: ll,
      map: map,
      draggable: false,
      icon: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    countmarker2 += 1;
  } else { //if there is marker than move
    marker2.setPosition(ll);
  }
}*/

/*$("#locality").focusin(function() {
      $(document).keypress(function(e) {
        if (e.which == 13 || event.which == 9) { // ENTER PRESSED
          
        }
      });
    }*/