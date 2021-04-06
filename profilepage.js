function loadImages(){
  console.log("loadingimages")
  // we should probably use a multidiminsional dictionary instead of these three arrays, but now it works
  
  var reviews = new Array("I can’t wait for the month of May! When everyone gets their vaccines, we can start partying again. This really captures the chaotic energy I’ve been feeling. Definitely check this album out.", "An underrated album from Led Zeppelin. All of their standout hits like Stairway to Heaven and Kashmir are on other albums. But the raw sound Presence is really inspiring.", "Of all the people to marry Elon Musk - why? Great album though. It hits the spot when I want powerful pop with strong vocals.", "Great studying music. Way better than lo-fi hip hop beats to relax and study to. This is almost like sound-art, but actually musical instead of just an art piece. The nature that goes along with the YouTube videos makes me feel like I’m out in the mountains.","RIP Sophie. That is all. The world will never be the same.","Great mix of r&b and pop. I love her British accent! Her voice is just so beautiful and soulful, whether it’s a ballad or upbeat. ");
 
  var links = new Array("https://open.spotify.com/album/0f3AzoDpzsFoSMe6EB90RY","https://open.spotify.com/album/6vSiY2OVanKKforfEOT2PD", "https://open.spotify.com/album/7J84ixPVFehy6FcLk8rhk3","https://open.spotify.com/album/25TwYopjoWFodq0fuJd0Vj","https://open.spotify.com/playlist/4M9B459P0MBf8phz8sAwRW", "https://open.spotify.com/album/0DriDL7OcMeMENJWAElSYL")
  
  var images = new Array ("monthofmayhem.jpg", "presence.jpg", "artangels.jpg", "conferenceoftrees.jpg","product.jpg","noshame.jpg");
	  
  var idx;
  for (idx=0; idx<images.length; idx++){
    div = document.createElement("div");
    id = "review" + idx
    div.setAttribute("id", id);
    div.setAttribute("class", "reviewContainer");
    document.getElementById("albumReviews").appendChild(div)
    
    a = document.createElement('a');
    a.href = links[idx]
    document.getElementById(id).appendChild(a)
    
    img = document.createElement("img");
    img.setAttribute("id",idx)
    img.setAttribute("src",images[idx]);
    img.setAttribute("alt", images[idx]);
    img.setAttribute("width", "500px")
    a.appendChild(img)
    
    review = document.createTextNode(reviews[idx]);
    document.getElementById(id).appendChild(review)
  }
  
  
  
}//ends loadImages()
