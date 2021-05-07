import requests
import time
from pprint import pprint

user_id = 'phig1hflpa6zsgnf36cqhly0p'

ACCESS_TOKEN = 'BQDRax2Pzbj95XrA1N2b25qCbg90wvDXcnUaAK5f8SV_sKl1HVXTwx5j1LRAtVGrDsnnKh6ylo5bRATD6T5M69SLdYVG474mQzBTu5eElDDbVQ39aTAV9R8SyV0iJfEviDTyW7ul_Xrb_3z-RKw6OVg3ksecTh0HZ1jtmJHw86_EWqWfIQT7DqlriUAWtJcvRP2-m_CwB9K2IkDR4DLcL6Z8hbfFRwPF3KZiq7n1eZw-ziqggXFknra2G1PlAhNRRAyxoxf9cwqOWOPqVbG76tJp3avTrn3ZKrGWXAP9'

API_CREATE_PLAYLIST = f'https://api.spotify.com/v1/users/{user_id}/playlists'
API_GET_CURRENT_TRACK = 'https://api.spotify.com/v1/me/player'


# SPOTIFY API FUNCTIONS
def create_playlist(name, public):
    response = requests.post(
        API_CREATE_PLAYLIST,
        headers={
            "Authorization": f"Bearer {ACCESS_TOKEN}"
        },
        json={
            "name": name,
            "public":public
        }
    )

    json_resp = response.json()

    return json_resp

def get_current_track_info():
    response = requests.get(
        API_GET_CURRENT_TRACK,
        headers={
            "Authorization": f"Bearer {ACCESS_TOKEN}"
        }
    )

    # First retrieval error check
    if (response.status_code != 200):
        return response
    else:
        # Convert the response to json
        json_resp = response.json()

    # Second retrieval error check
    if (json_resp.get('error') == None):
        # retrieve the info from the json response
        track_id = json_resp["item"]["id"]
        track_name = json_resp["item"]["name"]
        song_link = json_resp["item"]["external_urls"]["spotify"]
        artist_info = json_resp["item"]["artists"]
        artist_names = ', '.join( [artist["name"] for artist in artist_info] )

        # convert it into a dictionary and return
        current_track_info = {
            "song_id":track_id,
            "song_name":track_name,
            "song_link":song_link,
            "artist_names":artist_names,
        }

        return current_track_info
    else:
        print("NOTE: Probably your Spotify access token is expired...")
        return json_resp.get('error')



# RUN API FUNCTIONS IN MAIN ONLY FOR TESTING PURPOSES!
def main():
    # # Create a playlist
    # playlist = create_playlist(
    #     name = "Test Playlist",
    #     public = False
    # )

    # Get the current track info
    current_track = get_current_track_info()

    # pprint(f'Playlist: {playlist}')
    print()
    pprint(current_track, indent=4)



if __name__ == "__main__":
    main()