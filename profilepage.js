function loadImages(){
  console.log("loadingimages")
  // we should probably use a multidiminsional dictionary instead of these three arrays, but now it works
  
  var reviews = new Array ("Lorem Ipsum è un testo segnaposto utilizzato nel settore della tipografia e della stampa...", "Lorem Ipsum è un testo segnaposto utilizzato nel settore della tipografia e della stampa...", "Lorem Ipsum è un testo segnaposto utilizzato nel settore della tipografia e della stampa...", "Lorem Ipsum è un testo segnaposto utilizzato nel settore della tipografia e della stampa...","Lorem Ipsum è un testo segnaposto utilizzato nel settore della tipografia e della stampa...","Lorem Ipsum è un testo segnaposto utilizzato nel settore della tipografia e della stampa...");
  
  var links = new Array("https://open.spotify.com/album/0f3AzoDpzsFoSMe6EB90RY","https://open.spotify.com/album/6vSiY2OVanKKforfEOT2PD", "https://open.spotify.com/album/7J84ixPVFehy6FcLk8rhk3","https://open.spotify.com/album/25TwYopjoWFodq0fuJd0Vj","https://open.spotify.com/playlist/4M9B459P0MBf8phz8sAwRW", "https://open.spotify.com/album/0DriDL7OcMeMENJWAElSYL")
  
  var images = new Array ("albumCovers/monthofmayhem.jpg", "albumCovers/presence.jpg", "albumCovers/artangels.jpg", "albumCovers/conferenceoftrees.jpg","albumCovers/product.jpg","albumCovers/noshame.jpg");
	  
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
