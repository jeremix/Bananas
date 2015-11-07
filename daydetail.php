<?php
    date_default_timezone_set('UTC');

    if (isset($_GET['d'])) {   
      $requestedDay = $_GET['d'];
    }else{
      $requestedDay = $currentDate = Date("Y-m-d");
    }
?>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map');

        var mapOptions = {
          center: new google.maps.LatLng(38.5836479,-7.9069337),
          zoom: 5,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)        

		 if (navigator.geolocation) {
		     navigator.geolocation.getCurrentPosition(function (position) {
		         initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		         map.setCenter(initialLocation);
		    });
		}
		


		var json = (function () { 
            var json = null; 
            $.ajax({ 
                'async': false, 
                'global': false, 
                'url': "http://localhost/bnanas/markers2.php?d="+<?php echo '\''.$requestedDay.'\''; ?>,
                'dataType': "json", 
                'success': function (data) {
                     json = data; 
                 }
            });
            return json;
        })();
        
		//console.log(json);
		infowindow = new google.maps.InfoWindow(); 
		$.each(json.locations, function(key, data) {
			    var latLng = new google.maps.LatLng(data.lat, data.lng);

			    var marker = new google.maps.Marker({
			        position:   latLng,
			        map:        map,
			        title:      data.title
			    });

			    var details = data.website + ", " + data.phone + ".";

			    bindInfoWindow(marker, map, infowindow, details);

			});
      }
		function bindInfoWindow(marker, map, infowindow, strDescription) {
		    google.maps.event.addListener(marker, 'click', function() {
		    //	alert('ok')
		    infowindow.setContent(strDescription);
		    infowindow.open(map, marker);
		    });
		}

     // google.maps.event.addDomListener(window, 'load', initialize);
		initialize();
    </script>

    <div class="popupBackground" />
    <div class="popUpDayDetail">
    	<div id="map"></div>
    	<div id="distances">

    	</div>
    </div>

    <script>
    $(".popupBackground").click(function() {
      //console.log(this.id);
      $(".popUpDayDetailContainer").toggleClass( "hidden" );
      return false;
    });
    </script>