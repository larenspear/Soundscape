allReviews = new Array()
function findReview(review,img) {
    return review.img === img;
}

function loadImages() {
  console.log("loadingimages")
  
  function createReviewObject(album, reviewText, img, spotifyLink, interactions = [0,0,0]){
    let review = {};
  
    review = {
    album : album,
    reviewText : reviewText,
    img : img,
    spotifyLink : spotifyLink,
    interactions: {
      likes : interactions[0],
      comments: interactions[1],
      views: interactions[2]
    }
    
   }
   allReviews.push(review)
   return review
  }
  
  function addReview(review){
    div = document.getElementById("albumReviews")
    imgContainer = document.createElement('div')
    imgContainer.setAttribute("class", "reviewContainer");
    img = document.createElement('img')
    str = "./data/"+review.img
    console.log(str)
    img.setAttribute("src",str)
    img.setAttribute("width","400px")
    img.setAttribute("class", "reviewImg")
    div.appendChild(imgContainer)
    imgContainer.appendChild(img)
    
     
    tbl = document.createElement("table")
    tbl.setAttribute("id", "interactMenu")
    tr = document.createElement("tr")
    
    likeImg = document.createElement("td")
    likeIcon = document.createElement("img")
    likeIcon.setAttribute("class","likeIcon")
    likeIcon.setAttribute("src", "./data/like.jpg")
    likeIcon.style.width="70px"
    likeNum = document. createElement("td")
    likeNum.setAttribute("class", "likeNum")
    likeNum.innerHTML = review.interactions.likes
    
    comment = document.createElement("td")
	  link = document.createElement("a")
	  link.setAttribute("href","review0_comments.php")
    commentIcon = document.createElement("img")
    commentIcon.setAttribute("class","commentIcon")
    commentIcon.setAttribute("src", "./data/comment.jpg")
    commentIcon.style.width="70px"
	  commentNum =document. createElement("td")
	  commentNum.innerHTML = review.interactions.comments
	  commentNum.setAttribute("class","commentNum")
    
    view = document.createElement("td")
    viewIcon = document.createElement("img")
    viewIcon.setAttribute("class","viewIcon")
    viewIcon.setAttribute("src", "./data/view.jpg")
	  viewIcon.style.width="70px"
    viewNum = document.createElement("td")
    viewNum.innerHTML = review.interactions.views
    viewNum.setAttribute("class","viewNum")
    
    reviewText = document.createElement("span")
    reviewText.setAttribute("class","hidden")
    text = document.createTextNode(review.reviewText)
    imgContainer.appendChild(reviewText)
    reviewText.appendChild(text)
    
    
    imgContainer.appendChild(tbl)
    tbl.appendChild(tr)
    tr.appendChild(likeImg)
    likeImg.appendChild(likeIcon)
    tr.appendChild(likeNum)
   
    comment.appendChild(link)
	  link.appendChild(commentIcon)
	  tr.appendChild(comment)
    tr.appendChild(commentNum)
    
    tr.appendChild(view)
    view.appendChild(viewIcon)
    tr.appendChild(viewNum)
    
    
    
  }
  
 
 addReview(createReviewObject("Month of Mayhem", "I canâ€™t wait for the month of May! When everyone gets their vaccines, we can start partying again. This really captures the chaotic energy Iâ€™ve been feeling. Definitely check this album out.","monthofmayhem.jpg", "https://open.spotify.com/album/0f3AzoDpzsFoSMe6EB90RY"))
 addReview(createReviewObject("Presence","An underrated album from Led Zeppelin. All of their standout hits like Stairway to Heaven and Kashmir are on other albums. But the raw sound Presence is really inspiring.", "presence.jpg",  "https://open.spotify.com/album/6vSiY2OVanKKforfEOT2PD"))
 addReview(createReviewObject("Art Angels","Of all the people to marry Elon Musk - why? Great album though. It hits the spot when I want powerful pop with strong vocals.","artangels.jpg","https://open.spotify.com/album/7J84ixPVFehy6FcLk8rhk3"))
 addReview(createReviewObject("Conference of Trees","Great studying music. Way better than lo-fi hip hop beats to relax and study to. This is almost like sound-art, but actually musical instead of just an art piece. The nature that goes along with the YouTube videos makes me feel like Iâ€™m out in the mountains.", "conferenceoftrees.jpg","https://open.spotify.com/album/25TwYopjoWFodq0fuJd0Vj"))
 addReview(createReviewObject("Product", "RIP Sophie. That is all. The world will never be the same.","product.jpg", "https://open.spotify.com/playlist/4M9B459P0MBf8phz8sAwRW"))
 addReview(createReviewObject("No Shame","Great mix of r&b and pop. I love her British accent! Her voice is just so beautiful and soulful, whether itâ€™s a ballad or upbeat. ","noshame.jpg", "https://open.spotify.com/album/0DriDL7OcMeMENJWAElSYL"))
 
  
  
}//ends loadImages()

$( document ).ready(function() {
    console.log( "ready!" );
    
    function animateReview(){
      $(document.body).on("click",".reviewImg", (function(){
         $img = this
         console.log($img)
         $text = $($img).next()
        console.log($text)
         $($img).toggle(1000, function(){
         });
         $($text).toggle(1000)
         }))
         
       $(document.body).on("click",".hidden", (function(){
         $text = this
         //console.log($text)
         $img = $($text).prev()
         console.log($img)
         $($text).toggle(000, function(){
         });
         $($img).toggle(1000)
         }))
    };
    
    animateReview()
    
});
