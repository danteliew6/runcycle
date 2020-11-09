
window.addEventListener('load', getAllEvents);


function getAllEvents() {
    const url = "functions/allEvents.php";
    const request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText);
            const data = JSON.parse(this.responseText);
            console.log(data);
            let upcomingEvents = document.getElementById('upcomingEvents');
            upcomingEvents.innerHTML = "";

            for (events of data.records) {
                if (events.activity == "Run") {
                    var image = "run.png";
                }
                else{
                    var image = "cycle.png";
                }

                if (events.participants >= events.capacity) {
                    var disabled = `disabled`;
                    var button = `btn btn-secondary`;
                    var buttonMsg = `Event Full`;
                }
                else {
                    var disabled = ``; 
                    var button = `btn btn-success`;
                    var buttonMsg = `Join Event`;
                }

                // console.log(events);
                upcomingEvents.innerHTML += 
                ` <div class="col-lg-3 col-md-6 m-4">
                    <div class="card h-100 border-1 shadow" style="width: 18rem;">
                      <img class="card-img-top" src="${image}" style = "background-color:grey;" alt="Image cannot be displayed">
                    <div class="card-body text-left">
                      <h4 class="card-title">${events.title}</h4> 
                      <p class="card-text">
                        Start Point: <br><b>${events.start_point}</b> <br><br>
                        End Point: <br><b>${events.end_point}</b><br><br>
                        Date and Time:<br><b>${events.event_datetime}</b>
                      </p>
                    </div>
                    <div class="card-body text-left">

                    </div>
                    <div class="card-footer text-center p-3"> 
                        <div class = "text-left">
                            <small>
                            Capacity: ${events.participants}/${events.capacity}<br>
                            <b>Created by: ${events.username}</b>
                            </small><br><br>  
                        </div>
                      <a href="event.html?event_id=${events.event_id}" class="btn btn-dark mr-2">Details</a>
                      <button type = "button" class="${button}" id = "event${events.event_id}" onclick = "checkHost(${events.event_id})" ${disabled}>${buttonMsg}</button>
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
            eventToUpdate.removeAttribute(`disabled`);

        }
    }
    request.open('GET', `${url}`, true);
    request.send();

}


function checkHost(event_id) {
    const url = `functions/checkHost.php?event_id=${event_id}`;
    const request = new XMLHttpRequest();
    
    var triggered = 0
    
    request.onreadystatechange = function() {
        console.log(triggered);
        if (triggered < 1 && this.readyState == 4 && this.status == 200) {           
            triggered++;     
            return cancelEvent(true, event_id);
            // request.abort();
        }
        else if (triggered < 1 && this.readyState == 4 && this.status == 404) {
            triggered++
            return cancelEvent(false, event_id);
            // request.abort();
        }
        
    }

 
    request.open('GET', `${url}`, true);
    request.send();
    
}


function cancelEvent(isHost, event_id) {
    eventToUpdate = document.getElementById(`event${event_id}`); 
    if (isHost) {
        if (confirm('You are the host. Are you sure you want to cancel this event?')) {
            // eventToUpdate = document.getElementById(`event${event_id}`);
            const url = `functions/cancelEvent.php?event_id=${event_id}`;
            const request = new XMLHttpRequest();
            request.open("GET", `${url}`, true);
            request.send();

            alert('Event removed!');
            eventToUpdate.setAttribute('class', "btn btn-success");
            eventToUpdate.innerHTML = "Join Event"; 
            console.log('Event removed');
            location.reload(); 
        }
    }
    else if (eventToUpdate.innerHTML == "Cancel") {
        const url = `functions/removeParticipant.php?event_id=${event_id}`;
        const request = new XMLHttpRequest();
    
    
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                eventToUpdate.setAttribute('class', "btn btn-success");
                eventToUpdate.innerHTML = "Join Event"; 
                alert('Event removed!');
                location.reload();        
            }
        }
        request.open("GET", `${url}`, true);
        request.send();
    }
    else {
        const url = `functions/joinEvent.php?event_id=${event_id}`;
        const request = new XMLHttpRequest();
    
    
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                eventToUpdate.setAttribute('class', "btn btn-danger");
                eventToUpdate.innerHTML = "Cancel";
                alert('Event joined succesfully! Have a good workout!');
                location.reload();        
            }
        }
        request.open("GET", `${url}`, true);
        request.send();
    }

}

function getWeather(){
    //Getting the current date
    now = new Date();
    var nowStr = now.toISOString();
    nowDate = nowStr.slice(0, 10);

    function createTD(textContents) {
        let td = document.createElement('td');
        let text = document.createTextNode(textContents);
        td.appendChild(text);
        return td;
    }

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200){ 
                //Only items has the data
            
                var tbody = document.getElementById("tbody");
                var obj = JSON.parse(this.responseText);   
                var len = obj.items.length;
                var weatherDays = ['Today', '2 Days', '4 Days']
                    for(i = 0  ; i < len ; i++ ){   
                        let output = "";
                        //Forecasts holds the important data
                        var forecast = obj.items[i].forecasts[i];
                        var text = forecast.forecast;
                        var temp = forecast.temperature;
                        var humidity = forecast.relative_humidity;
                                            
                        output+= 
                            `<tr><th>${weatherDays[i]}</th>
                                <td>${text}</td>  
                                <td>${temp.low}</td>
                                <td>${temp.high}</td>
                                <td>${humidity.low}</td>
                                <td>${humidity.high}</td>
                            </tr>`
                        
                        tbody.innerHTML += output;
                    }             
            }
          }
           
          var gotoURL = "https://api.data.gov.sg/v1/environment/4-day-weather-forecast?date="+ encodeURIComponent(nowDate);
          xhr.open("GET", gotoURL, true);
          xhr.send();

};
