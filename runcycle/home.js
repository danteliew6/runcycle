


window.addEventListener('load', getAllEvents);




function getAllEvents() {
    const url = "functions/allEvents.php";
    const request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.responseText);
            let upcomingEvents = document.getElementById('upcomingEvents');
            upcomingEvents.innerHTML = "";

            for (events of data.records) {
                if (events.activity == "Run") {
                    var image = "run.png";
                }
                else{
                    var image = "cycle.png";
                }


                // console.log(events);
                upcomingEvents.innerHTML += 
                ` <div class="col-lg-3 col-md-6 m-4">
                    <div class="card h-100 border-1 shadow" style="width: 18rem;">
                      <img class="card-img-top" src="${image}" style = "background-color:grey;" alt="Image cannot be displayed">
                    <div class="card-body text-left">
                      <h4 class="card-title">${events.title}</h4> 
                      <p class="card-text">
                        Start Point: ${events.start_point} <br>
                        End Point: ${events.end_point}
                      </p>
                      
                      <span><b>Details:</b></span><br>
                      <p>${events.event_datetime}<br>Duration: ${events.duration} hours
                          <br>Capacity: (num_participants)/${events.capacity}</p> 
                          <br><b>Created by: ${events.username}</b>             
                    </div>
                    <div class="card-footer text-center p-4">
                      <a href="event.html?event_id=${events.event_id}" class="btn btn-dark mr-2">Details</a>
                      <button type = "button" class="btn btn-success" id = "event${events.event_id}" onclick = "updateJoin(${events.event_id})">Join Event</a>
                    </div>
                    </div>
                </div>`;

                checkJoined(events.event_id);
            }
        }
    }
    request.open("GET", `${url}`, true);
    request.send();
}

// check if the user is currently a participant in an event
function checkJoined(event_id) {
    const url = `functions/checkJoined.php?event_id=${event_id}`;
    const request = new XMLHttpRequest();
    var data;
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            // console.log(data);
            let eventToUpdate = document.getElementById(`event${event_id}`);
            eventToUpdate.setAttribute('class', 'btn btn-danger');
            eventToUpdate.innerHTML = "Cancel";

        }
    }
    request.open('GET', `${url}`, true);
    request.send();

}



function updateJoin(event_id) {
    // console.log(event_id);
    eventToUpdate = document.getElementById(`event${event_id}`);
    checkHost(event_id);

    if (eventToUpdate.getAttribute('class') == "btn btn-success") {
        const url = `functions/joinEvent.php?event_id=${event_id}`;
        const request = new XMLHttpRequest();
    
    
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert('Event joined succesfully! Have a good workout!')
                eventToUpdate.setAttribute('class', "btn btn-danger");
                eventToUpdate.innerHTML = "Cancel";         
            }
        }
        request.open("GET", `${url}`, true);
        request.send();
    }
    else {
        const url = `functions/removeParticipant.php?event_id=${event_id}`;
        const request = new XMLHttpRequest();
    
    
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert('Event removed!');
                eventToUpdate.setAttribute('class', "btn btn-success");
                eventToUpdate.innerHTML = "Join Event";         
            }
        }
        request.open("GET", `${url}`, true);
        request.send();

    }

    }


    function checkHost(event_id) {
        const url = `functions/getEvent.php?event_id=${event_id}`;
        const request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const data = JSON.parse(this.responseText);
                // console.log(data.records[0].username);

                let username = data.records[0].username;

                
            }
        }
        request.open("GET", `${url}`, true);
        request.send();
    }
  
