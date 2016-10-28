
<html>
    <head>
        <meta charset="UTF-8">
        <title>Your IP Address</title>
        <link href="main.css" rel="stylesheet">
<!--        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="bootstrap.min.css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>IP Address geocoding on Google Maps</title>
<!--        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->

<!--        <script type="text/javascript">-->
<!--            $(function(){-->
<!--                try{-->
<!--                    IPMapper.initializeMap("map");-->
<!--                    IPMapper.addIPMarker("87.241.167.103");-->
<!--                } catch(e){-->
<!--                    //handle error-->
<!--                }-->
<!--            });-->
<!--        </script>-->
    </head>
</html>

<body>



    <div class="container">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h1>Your IP</h1></div>
                <div class="panel-body">
                    <p><h2><b>Your Current IP:</b></h2></p>
                    <div><h3><?=$_SERVER["REMOTE_ADDR"]?></h3></div>
                </div>
                <div class="panel-body">
                        <h4><b>Host Name: </b><span><?php
                                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                } else {
                                    $ip = $_SERVER['REMOTE_ADDR'];
                                }
                                echo $ip;
                                ?></span></h4>
                        <h4><b>Your Browser: </b><span><?=$_SERVER["HTTP_USER_AGENT"]?></span></h4>
                </div>
            </div>
        </div>
    </div>
</body>


<!---->
<!---->
<?php
//
//
//$ip = $_SERVER['REMOTE_ADDR'];
//$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
//var_dump($details);
//echo '<br>'.$details->city; // -> "Mountain View"
//
//
//
//include('ip2locationlite.class.php');
//
////Load the class
//$ipLite = new ip2location_lite;
//$ipLite->setKey('<your_api_key>');
//
//?>
<!---->
<!--<section id="wrapper">-->
<!--    Click the allow button to let the browser find your location.-->
<!---->
<!--    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>-->
<!--    <article>-->
<!---->
<!--    </article>-->
<!--    <script>-->
<!--        function success(position) {-->
<!--            var mapcanvas = document.createElement('div');-->
<!--            mapcanvas.id = 'mapcontainer';-->
<!--            mapcanvas.style.height = '400px';-->
<!--            mapcanvas.style.width = '600px';-->
<!---->
<!--            document.querySelector('article').appendChild(mapcanvas);-->
<!---->
<!--            var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);-->
<!---->
<!--            var options = {-->
<!--                zoom: 15,-->
<!--                center: coords,-->
<!--                mapTypeControl: false,-->
<!--                navigationControlOptions: {-->
<!--                    style: google.maps.NavigationControlStyle.SMALL-->
<!--                },-->
<!--                mapTypeId: google.maps.MapTypeId.ROADMAP-->
<!--            };-->
<!--            var map = new google.maps.Map(document.getElementById("mapcontainer"), options);-->
<!---->
<!--            var marker = new google.maps.Marker({-->
<!--                position: coords,-->
<!--                map: map,-->
<!--                title:"You are here!"-->
<!--            });-->
<!--        }-->
<!---->
<!--        if (navigator.geolocation) {-->
<!--            navigator.geolocation.getCurrentPosition(success);-->
<!--        } else {-->
<!--            error('Geo Location is not supported');-->
<!--        }-->
<!---->
<!--    </script>-->
<!--</section>-->
