window.addEventListener('load', authenticate);

function authenticate() {
    const url = `functions/authenticate.php`;
    const request = new XMLHttpRequest();
    
    request.onreadystatechange = function() {

        if (this.status == 404) {
            window.location.replace("login.html");
        }
        
    }

    request.open('GET', `${url}`, true);
    request.send();
    
}