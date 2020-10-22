function getDirections() {
    event.preventDefault();
    document.getElementById('map').innerHTML = "";
    document.getElementById('directionsPanel').innerHTML = "";

    queries = {
        origin: document.getElementById('origin').value,
        destination: document.getElementById('destination').value,
        region: 'SG',
        travelMode: 'WALKING'
    };

    const url = "https://maps.googleapis.com/maps/api/js?";
    const request = new XMLHttpRequest();
    const params = "key=AIzaSyB7cotLdg-POVfNJD7AqHuB4m2Wi-Styic&callback=initMap";
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            initMap();
        }
    }

    request.open('GET', `${url}` + `${params}`, true);
    request.send();
}



function initMap() {
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    var singapore = new google.maps.LatLng(1.3521, 103.8198);
    var mapOptions = {
      zoom:10,
      center: singapore
    }
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    directionsRenderer.setMap(map);
    directionsRenderer.setPanel(document.getElementById('directionsPanel'));

    calcRoute(directionsService, directionsRenderer);
}

function calcRoute(directionsService, directionsRenderer) {
    directionsService.route(queries, function(result, status) {
      if (status == 'OK') {
        directionsRenderer.setDirections(result);
        computeTotalDistance(result);
        document.getElementById('origin').value = result.routes[0].legs[0]['start_address'];
        document.getElementById('destination').value = result.routes[0].legs[0]['end_address'];
        
        console.log(result.routes[0].legs[0]['start_address']); //how to get start point
        console.log(result.routes[0].legs[0]['end_address']); //how to get end point
      }
      else {
          document.getElementById('map').innerHTML = 'No routes were found, please enter a postal code or more specific address.';
      }
    });
}

function computeTotalDistance(result) {
    let total = 0;
    const myroute = result.routes[0];

    for (let i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
    // document.getElementById("total").innerHTML = total + " km";
}