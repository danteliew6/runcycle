window.addEventListener('load', getEvent);


function getEvent() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const event_id = urlParams.get('event_id');
    const url = `functions/getEvent.php?event_id=${event_id}`;
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.responseText);
            eventDetails = data.records[0];

            eventTable = document.getElementById('eventDetails')
            eventTable.innerHTML += `
            <tr>
                <th scope="row">Host</th>
                <td>${eventDetails.username}</td>
            </tr>
            <tr>
                <th scope="row">Duration</th>
                <td>${eventDetails.duration} Hours</td>
            </tr> 
            <tr>
                <th scope="row">Activity Type</th>
                <td>${eventDetails.activity}</td>
            </tr> 
            <tr>
                <th scope="row">Event Date and Time</th>
                <td>${eventDetails.event_datetime}</td>
            </tr> 
            <tr>
                <th scope="row">Distance</th>
                <td>${eventDetails.distance} Km</td>
            </tr>
            <tr>
                <th scope="row">Description</th>
                <td>${eventDetails.event_desc}</td>
            </tr>
            <tr>
                <th scope="row">Capacity</th>
                <td>${eventDetails.participants}/${eventDetails.capacity}</td>
            </tr>
            `;
            document.getElementById('showMap').addEventListener('click', getDirections);
            document.getElementById('showParticipants').addEventListener('click', getParticipants);
        }
    }
    request.open("GET", `${url}`, true);
    request.send();
}


function getDirections(origin, destination) {
    document.getElementById('map').innerHTML = "";
    document.getElementById('directionsPanel').innerHTML = "";

    queries = {
        origin: eventDetails.start_point,
        destination: eventDetails.end_point,
        region: 'SG',
        travelMode: 'WALKING'
    };
    const proxyurl = "https://cors-anywhere.herokuapp.com/";
    const url = "https://maps.googleapis.com/maps/api/js?key=AIzaSyB7cotLdg-POVfNJD7AqHuB4m2Wi-Styic&callback=initMap";

    const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            initMap();
            map.setCenter(new google.maps.LatLng(1.3521, 103.8198));
            map.setZoom(15);
        }
    }

    request.open('GET', `${proxyurl}` + `${url}`, true);
    request.send();
}


function getParticipants(){
    let event_id = eventDetails.event_id;
    const url = `functions/getParticipants.php?event_id=${event_id}`;
    const request = new XMLHttpRequest();


    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.responseText);
            // console.log(data);
            let count = 1;
            let participantsModal = document.getElementById('participants')
            participantsModal.innerHTML = "";
            for (participants of data.records) {
                participantsModal.innerHTML += `
                <tr>
                    <th scope="row">${count}</th>
                    <td>${participants.username}</td>
                </tr>
                `; 
                count++;
                
            }
        }
    }
    request.open("GET", `${url}`, true);
    request.send();
}



function initMap() {
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    var singapore = new google.maps.LatLng(1.3521, 103.8198);
    var mapOptions = {
        zoom: 14,
        center: singapore
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);


    directionsRenderer.setMap(map);
    directionsRenderer.setPanel(document.getElementById('directionsPanel'));

    calcRoute(directionsService, directionsRenderer);
}

function calcRoute(directionsService, directionsRenderer) {
    directionsService.route(queries, function (result, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(result);

        } else {
            document.getElementById('map').innerHTML = 'No routes were found, please enter a postal code or more specific address.';
        }
    });
}
