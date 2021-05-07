// Soundscape Client Info
const client_id = 'd61fb49a895346d999907535f080c9c6';
const client_secret = 'e98f203ad55d4ae9884cdecd2ad2b068';
var client_access_token = '';

// API ENDPOINTS (CLIENT):
const API_TOKEN = 'https://accounts.spotify.com/api/token';
const API_GET_FEATURED_PLAYLISTS = 'https://api.spotify.com/v1/browse/featured-playlists';



function get_access_token(){
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && (ajaxRequest.status == 200)) {
            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log("Token Request Successful! \nNew Access Token:", jsonObj.access_token);

            // update the access_token
            client_access_token = jsonObj.access_token;

        } else if (ajaxRequest.readyState == 4) {
            console.log("Token Request Failed! \n", ajaxRequest);
        }
    }
    const body = 'grant_type=client_credentials';

    ajaxRequest.open("POST", API_TOKEN, true);
    ajaxRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequest.setRequestHeader('Authorization', 'Basic ' + btoa(client_id + ':' + client_secret));
    ajaxRequest.send(body);
}


function get_featured_playlists_info() {
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log("Request Successful! \nFeatured Playlists:");
            console.log(jsonObj);

            // update the data
            const playlists = jsonObj.playlists.items;
            for (let i=0; i<playlists.length; i++){
                console.log("Playlist Name:", playlists[i]['name']);
                console.log("Song Link:", playlists[i]['external_urls']['spotify']);
                console.log("Image Link:", playlists[i]['images'][0]['url']);

            }

            // var song_name = jsonObj.item.name;
            // var song_link = jsonObj.item.external_urls.spotify;
            // var artist_info = jsonObj.item.artists;
            // var artist_names = json_extractor(artist_info, "name")

            // document.getElementById("api_results").innerHTML = 'Song Name: ' + song_name + '<br><br> Artist Name:' + artist_names + '<br><br> Song Link: ' + song_link  ;


        }else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open("GET", API_GET_FEATURED_PLAYLISTS, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send();
}














// ! YOU NEED TO UPDATE THE ACCESS_TOKEN EVERY HOUR or USER RELATED API FUNCTIONS WILL NOT WORK !
const user_id = 'phig1hflpa6zsgnf36cqhly0p';

// API ENDPOINTS (USER):
const API_CREATE_PLAYLIST = `https://api.spotify.com/v1/users/${user_id}/playlists`;
const API_GET_CURRENT_TRACK = 'https://api.spotify.com/v1/me/player';


// Handle json objects
function json_extractor(iterable_object, target_value){
    var result = [];
    for (i in iterable_object){
        result.push(iterable_object[i][target_value]);
    }
    return result.join(", ");
}

// SPOTIFY API FUNCTIONS
function create_playlist(name, public) {
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && (ajaxRequest.status == 200 || ajaxRequest.status == 201)) {
            // request succesfull!
            //console.log(ajaxRequest.responseText);

            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log(jsonObj)

        } else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    const json_data = {
        "name": name,
        "public": public
    };

    ajaxRequest.open("POST", API_CREATE_PLAYLIST, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.setRequestHeader('Content-Type', 'application/json');
    ajaxRequest.send(JSON.stringify(json_data));
    // JSON.stringify(json_data)
}

function get_current_track_info() {
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            // request succesfull!
            //console.log(jsonObj)

            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log(jsonObj);
            console.log(jsonObj.item.name);

            var song_id = jsonObj.item.id;
            var song_name = jsonObj.item.name;
            var song_link = jsonObj.item.external_urls.spotify;
            var artist_info = jsonObj.item.artists;
            var artist_names = json_extractor(artist_info, "name")

            document.getElementById("api_results").innerHTML = 'Song Name: ' + song_name + '<br><br> Artist Name:' + artist_names + '<br><br> Song Link: ' + song_link  ;


        } else if (ajaxRequest.readyState == 4 && ajaxRequest.status == 204) {
            console.log("Request Succesfull! \n But you're not listening to anything... \n", ajaxRequest)

        } else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open("GET", API_GET_CURRENT_TRACK, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send();

}

function get_featured_playlists(){
    // TODO: ask Mehmet to update the remote repo!
}

function follow_artist(){
    // TODO: ask Mehmet to update the remote repo!
}

function follow_user(){
    // TODO: ask Mehmet to update the remote repo!
}

function follow_user(){
    // TODO: ask Mehmet to update the remote repo!
}


// ! DO NOT USE THIS FUNCTION !!!
function template_request(request_type, url, send_str = null) {
    // The variable that makes Ajax possible! 
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            // request succesfull!
            //console.log(ajaxRequest.responseText);

            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
        } else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open(type, "AJAXdemo2.php" + queryString, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send(send_str);

    // // Now get the value from user and pass it to server script.
    // var lastName = document.getElementById('lastName').value;
    // var firstName = document.getElementById('firstName').value;
    // var queryString = "?lastName=" + lastName ;
    // queryString +=  "&firstName=" + firstName + "&server=" + server + "&user=" + user + "&pwd=" + pwd + "&dbName=" + dbName;
    // ajaxRequest.open("GET", "AJAXdemo2.php" + queryString, true);
    // ajaxRequest.send(null);
}