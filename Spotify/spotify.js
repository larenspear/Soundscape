// Soundscape Client Info
const client_id = 'd61fb49a895346d999907535f080c9c6';
const client_secret = 'e98f203ad55d4ae9884cdecd2ad2b068';
var client_access_token = '';

// API ENDPOINTS (CLIENT):
const API_TOKEN = 'https://accounts.spotify.com/api/token';
const API_GET_FEATURED_PLAYLISTS = 'https://api.spotify.com/v1/browse/featured-playlists';
const API_GET_NEW_RELEASES = 'https://api.spotify.com/v1/browse/new-releases';
const API_GET_CATEGORIES = 'https://api.spotify.com/v1/browse/categories';

var API_GET_CATEGORY_PLAYLISTS = 'https://api.spotify.com/v1/browse/categories/{category_id}/playlists';



function get_access_token(){
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && (ajaxRequest.status == 200)) {
            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);

            // update the access_token
            client_access_token = jsonObj.access_token;
            console.log("Token Request Successful! \nNew Access Token:", jsonObj.access_token);

            // Update playlists
            get_featured_playlists_info()
            get_new_releases_info()
            get_categories_info()
            get_categories_info2()


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

            // Update the widget
            const playlists = jsonObj.playlists.items;
            for (let i=0; i<playlists.length; i++){
                //console.log("Playlist Name:", playlists[i]['name']);
                //console.log("Song Link:", playlists[i]['external_urls']['spotify']);
                //console.log("Image Link:", playlists[i]['images'][0]['url']);

                document.getElementById('featured_playlists').innerHTML += 
                ("<a href='"+playlists[i]['external_urls']['spotify']+"'><li><span class='number'>"+(i+1)+"</span><span class='name'>"+playlists[i]['name']+"</span></li></a>");
                
                if(i>=8){break};
            }

        }else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open("GET", API_GET_FEATURED_PLAYLISTS, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send();
}


function get_new_releases_info() {
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log("Request Successful! \nNew Releases:");
            console.log(jsonObj);

            // Update the widget
            const new_releases = jsonObj.albums.items;
            for (let i=0; i<new_releases.length; i++){
                // console.log("Album Name:", new_releases[i]['name']);
                // console.log("Album Link:", new_releases[i]['external_urls']['spotify']);
                // console.log("Image Link:", new_releases[i]['images'][0]['url']);

                document.getElementById('new_releases').innerHTML += 
                ("<a href='"+new_releases[i]['external_urls']['spotify']+"'><li><span class='number'>"+(i+1)+"</span><span class='name'>"+new_releases[i]['name']+"</span></li></a>");
                
                if(i>=8){break};
            }

        }else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open("GET", API_GET_NEW_RELEASES, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send();
}




function get_categories_info() {
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log("Request Successful! \nCategories:");
            console.log(jsonObj);

            // Update the widget
            const categories = jsonObj.categories.items;
            for (let i=0; i<categories.length; i++){
                // console.log("Category Id:", categories[i]['id']);
                // console.log("Category Name:", categories[i]['name']);
                // console.log("Icon Link:", categories[i]['icons'][0]['url']);

                document.getElementById('random_playlists').innerHTML += 
                ("<a onclick='get_category_playlists_info(\""+categories[i]['id']+"\")'><li><span class='number'>&#9835;</span><span class='name'>"+categories[i]['name']+"</span></li></a>");
                
                if(i>=8){break};
            }

        }else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open("GET", API_GET_CATEGORIES, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send();
}


function get_category_playlists_info(category_id) {
    API_GET_CATEGORY_PLAYLISTS = `https://api.spotify.com/v1/browse/categories/${category_id}/playlists`
    document.getElementById('random_playlists').innerHTML = '';
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log("Request Successful! \nPlaylists:");
            console.log(jsonObj);

            // Update the widget
            const playlists = jsonObj.playlists.items;
            for (let i=0; i<playlists.length; i++){
                // console.log("Playlist Name:", playlists[i]['name']);
                // console.log("Playlist Link:", playlists[i]['external_urls']['spotify']);
                // console.log("Image Link:", playlists[i]['images'][0]['url']);

                document.getElementById('random_playlists').innerHTML += 
                ("<a href='"+playlists[i]['external_urls']['spotify']+"'><li><span class='number'>"+(i+1)+"</span><span class='name'>"+playlists[i]['name']+"</span></li></a>");
                
                if(i>=8){break};
            }

        }else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open("GET", API_GET_CATEGORY_PLAYLISTS, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send();
}




function get_categories_info2() {
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log("Request Successful! \nCategories2:");
            console.log(jsonObj);

            // Update the widget
            const categories = jsonObj.categories.items;
            for (let i=0; i<categories.length; i++){
                // console.log("Category Id:", categories[i]['id']);
                // console.log("Category Name:", categories[i]['name']);
                // console.log("Icon Link:", categories[i]['icons'][0]['url']);

                document.getElementById('random_playlists2').innerHTML += 
                ("<a onclick='get_category_playlists_info2(\""+categories[i]['id']+"\")'><li><span class='number'>&#9835;</span><span class='name'>"+categories[i]['name']+"</span></li></a>");
                
                if(i>=8){break};
            }

        }else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open("GET", API_GET_CATEGORIES, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send();
}


function get_category_playlists_info2(category_id) {
    API_GET_CATEGORY_PLAYLISTS = `https://api.spotify.com/v1/browse/categories/${category_id}/playlists`
    document.getElementById('random_playlists2').innerHTML = '';
    const ajaxRequest = new XMLHttpRequest();

    // Create a function that will receive data sent from the API
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            // convert the response into json
            var jsonObj = JSON.parse(ajaxRequest.responseText);
            console.log("Request Successful! \nPlaylists2:");
            console.log(jsonObj);

            // Update the widget
            const playlists = jsonObj.playlists.items;
            for (let i=0; i<playlists.length; i++){
                // console.log("Playlist Name:", playlists[i]['name']);
                // console.log("Playlist Link:", playlists[i]['external_urls']['spotify']);
                // console.log("Image Link:", playlists[i]['images'][0]['url']);

                document.getElementById('random_playlists2').innerHTML += 
                ("<a href='"+playlists[i]['external_urls']['spotify']+"'><li><span class='number'>"+(i+1)+"</span><span class='name'>"+playlists[i]['name']+"</span></li></a>");
                
                if(i>=8){break};
            }

        }else if (ajaxRequest.readyState == 4) {
            console.log("Request Unsuccesful! \n", ajaxRequest)
        }
    }

    ajaxRequest.open("GET", API_GET_CATEGORY_PLAYLISTS, true);
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${client_access_token}`);
    ajaxRequest.send();
}



































































// ##################################################################
// ####################### DONT USE THESE ###########################
// ##################################################################

// ! YOU NEED TO UPDATE THE ACCESS_TOKEN EVERY HOUR or USER RELATED API FUNCTIONS WILL NOT WORK !
var user_access_token = '';
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
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${user_access_token}`);
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
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${user_access_token}`);
    ajaxRequest.send();

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
    ajaxRequest.setRequestHeader('Authorization', `Bearer ${user_access_token}`);
    ajaxRequest.send(send_str);

    // // Now get the value from user and pass it to server script.
    // var lastName = document.getElementById('lastName').value;
    // var firstName = document.getElementById('firstName').value;
    // var queryString = "?lastName=" + lastName ;
    // queryString +=  "&firstName=" + firstName + "&server=" + server + "&user=" + user + "&pwd=" + pwd + "&dbName=" + dbName;
    // ajaxRequest.open("GET", "AJAXdemo2.php" + queryString, true);
    // ajaxRequest.send(null);
}

// ##################################################################
// ####################### DONT USE THESE ###########################
// ##################################################################