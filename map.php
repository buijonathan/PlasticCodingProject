<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
	  var count = 0;
	  document.write(document.body + " " + jsonString);
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 37.303189, lng: -121.804466},
          zoom: 12
        });
      }
	  function updateMap() {
		var jsonString = "<?php include 'getPosts.php'; ?>";
		var jsonObj = JSON.parse(jsonString);
		var data = jsonObj.data;
		for(var i = 0; i < data.length; i++) {
			var post = data[i];
			var marker = new google.maps.Marker({
				position: {lat: 37.303189, lng: -121.804466},
				map: map,
				title: post.mediaId;
			});
		}
		updateMap();
	  }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNFq9N7BBRZxthhRQ_a9-gc3Lq7di0g68&callback=initMap"
    async defer></script>
  </body>
</html>
