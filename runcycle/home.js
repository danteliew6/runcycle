


window.addEventListener('load', getAllEvents);


function getAllEvents() {
    const url = "functions/allEvents.php";
    const request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.responseText);

            for (events of data.records) {
                let upcomingEvents = document.getElementById('upcomingEvents');
                upcomingEvents.innerHTML = "";
                upcomingEvents.innerHTML += 
                ` <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 border-1 shadow" style="width: 18rem;">
                      <img class="card-img-top" src="runcyclewhite.png" style = "background-color:grey;" alt="Image cannot be displayed">
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
            }
        }
    }
    request.open("GET", `${url}`, true);
    request.send();
}


function updateJoin(event_id) {
    // console.log(event_id);
    eventToUpdate = document.getElementById(`event${event_id}`);
    

    if (eventToUpdate.getAttribute('class') == "btn btn-success") {
        const url = `functions/joinEvent.php?event_id=${event_id}`;
        const request = new XMLHttpRequest();
    
    
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert('Event joined succesfully! Have a good workout!')
                eventToUpdate.setAttribute('class', "btn btn-danger");
                eventToUpdate.innerHTML = "Cancel Event";         
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
  
