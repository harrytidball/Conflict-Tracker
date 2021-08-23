<?php

$lat = file("text-files/lat.txt");
$lng = file("text-files/lng.txt");
$date = file("text-files/date.txt");
$type = file("text-files/type.txt");
$country = file("text-files/country.txt");
$region = file("text-files/region.txt");
$location = file("text-files/location.txt");
$source = file("text-files/source.txt");
$notes = file("text-files/notes.txt");
$fatalities = file("text-files/fatalities.txt");
$timestamp = file("text-files/timestamp.txt");
$actor_one = file("text-files/actor_one.txt");
$actor_two = file("text-files/actor_two.txt");
$icon = file("text-files/icon.txt");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conflict Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="style.css"/>
  </head>

  <body>

  <div id="map"></div>

  <script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 30, lng: 10 },
        zoom: 2.6,
        minZoom: 2.6,
        streetViewControl: false,
    });

    var lat = <?php echo json_encode($lat); ?>;
    var lng = <?php echo json_encode($lng); ?>;
    var date = <?php echo json_encode($date); ?>;
    var type = <?php echo json_encode($type); ?>;
    var country = <?php echo json_encode($country); ?>;
    var region = <?php echo json_encode($region); ?>;
    var source = <?php echo json_encode($source); ?>;
    var notes = <?php echo json_encode($notes); ?>;
    var fatalities = <?php echo json_encode($fatalities); ?>;
    var timestamp = <?php echo json_encode($timestamp); ?>;
    var location = <?php echo json_encode($location); ?>;
    var actor_one = <?php echo json_encode($actor_one); ?>;
    var actor_two = <?php echo json_encode($actor_two); ?>;
    var icon = <?php echo json_encode($icon); ?>;
    
    for (i = 0; i < lat.length; i++) {
        addMarker({coordinates:{lat: parseFloat(lat[i]), lng: parseFloat(lng[i])}}, "<ul><h3 id='box-title'><strong>" + type[i] + 
        "</h3><h4 id='box-content'><li>Involving:</strong><br>" + actor_one[i] + actor_two[i] + "</li><br><br<br><li><strong>Fatalities: </strong>"
         + fatalities[i] + "</li><br><li><strong>Location:</strong><br>" + location[i] + "</li><br><li><strong>Time:</strong><br>" + timestamp[i] + 
         "</li></ul></h4>", "icons/" + icon[i] + ".png");
    }

    function addMarker(props, content, icon) {
        var marker = new google.maps.Marker({
            position:props.coordinates,
            map:map,
            icon:icon,
            optimized: true,
        })

        //Create new infowindow and add content
        var infowindow = new google.maps.InfoWindow({
        content:content
        });
        //Listener for mouseover marker, prompting infowindow to be displayed
        google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.open(map, marker);
        });
        //Listener for mouseout marker, prompting infowindow to be hidden
        google.maps.event.addListener(marker, 'mouseout', function() {
        infowindow.close(map, marker);
        });
        
    }
    }

    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmPs5Ngmb__8NEpXe31pAb-pUCejVe0Ko&callback=initMap&libraries=&v=weekly"
async></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>