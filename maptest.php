<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <link rel="stylesheet" href="include/CSS/cssmap.css">

    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBpaHi6JeMnPBYV7MnnG3anyPz5rho4Wl4">
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://cdn.firebase.com/js/client/2.2.7/firebase.js"></script>



    <h1>MAP อะไอสัสรู้จักไหม</h1>

    <div class="well container">
        <form role="form">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3 col-xs-12 form-group" id="localityDIV">
                        <label class="control-label" for="locality">Населенный пункт</label>
                        <input type="text" class="form-control" id="locality" name="locality"
                            placeholder="Выберите город" data-toggle="tooltip" data-original-title="Не " />
                    </div>

                    <div class="col-sm-6 col-xs-12 form-group" id="streetHouseDIV">
                        <label for="route" class="control-label">Улица и дом</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="route" name="route"
                                placeholder='например "Бажана 32"' disabled="true" />
                            <i class="input-group-addon form-control-street-house glyphicon glyphicon-record"></i>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-12 form-group button">
                        <label for="btn" class="control-label hidden-xs">&nbsp;</label>
                        <input type="button" class="btn btn-warning" disabled="true" onclick="buttonClick()"
                            value="Сравни тарифы" />
                    </div>

                </div>
            </div>
        </form>
    </div>

    <!--<div id="gps"></div>-->
    <div id="map"></div>
    <!--<p id="result"></p>-->



    <div class="panel-collapse collapse out">
        <div class="panel-body">
            <b>Closest matching address:</b>
            <div id="address">.</div>
            <b>Place_id:</b>
            <div id="place_id">.</div>
            <b>Address type:</b>
            <div id="type">.</div>
            <b>Address precision:</b>
            <div id="precision">.</div>
            <b>Marker position:</b>
            <div id="gps">.</div>
            <b>GPS of closest matching address:</b>
            <div id="gps2">.</div>
            <b>Distance from closest address:</b>
            <div id="distance">.</div>
            <br>
            <a href="openrestaurant.php" class="btn btn-warning mb-2  float-left">
                Close
            </a>
        </div>
    </div>
    </div>

    <div id="google_translate_element"></div>


    <script type="text/javascript">
    <?php
include('include/javascriptmap.php');
?>
    </script>







</body>

</html>