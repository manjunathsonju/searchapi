<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6e-78B8anZSpeykd9OgFFsWzFS9lxxTI&v=3&sensor=false"></script>
<script type="text/javascript">
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
var latitude = <?=$latitude?>;
var longitude = <?=$longitude?>;

var locations = 

       <?php 
        echo '[';
        foreach($arrays as $array){
           echo '["'.$array['id'].'",'.$array['position'][1].','.$array['position'][0].',0],';
       }
        echo ']';
       ?>;


var infowindow = new google.maps.InfoWindow();

var marker, i;
function initialize() {
map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(latitude, longitude),
    mapTypeId: google.maps.MapTypeId.ROADMAP
});

for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
    });

    google.maps.event.addListener(marker, 'click', (function (marker, i) {
        return function () {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
        }
    })(marker, i));
}
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
 
