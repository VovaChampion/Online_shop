"use strict";

let startIndex = 0;
let currentIndex;
let smallImages;


window.addEventListener("load", function() {
    
    smallImages = document.getElementById("smalls").getElementsByTagName("img");
    for(let i=0; i < smallImages.length; i++){
        smallImages[i].addEventListener("click", smallImagesClick);
        smallImages[i].setAttribute("data-index", i); 
    }

    document.querySelector("#nextImg").addEventListener("click", function(myEvent){
        myEvent.stopPropagation();
        displayNextImg();
    });
    document.querySelector("#prevImg").addEventListener("click", function(myEvent){
        myEvent.stopPropagation();
        displayPrevImg();
    });

    
    document.querySelector("#big-display-1").addEventListener("click",bigImageClick);
    //document.querySelector(".material-icons").addEventListener("click",bigImageClick);
    document.querySelector("#overlay").addEventListener("click",removeOverlay);

    document.addEventListener("keydown", keyListener);

    currentIndex = startIndex;
    displayImgFromIndex(currentIndex);
});

function keyListener() { 
    let tangent = event.keyCode;
    if(tangent == 37) displayPrevImg();
    if(tangent == 39) displayNextImg();
    if(tangent == 27) removeOverlay();
} 

function displayNextImg() {
    currentIndex = currentIndex + 1;
    if (currentIndex >= smallImages.length) {
        currentIndex = 0;
    }
    displayOverlayImageFromIndex(currentIndex);
}

function displayPrevImg() {
    currentIndex = currentIndex - 1;
    if (currentIndex < 0) {
        currentIndex = smallImages.length - 1;
    }
    displayOverlayImageFromIndex(currentIndex);
}

function displayImgFromIndex(index) {
    document.querySelector("#big-display-1").src = smallImages[index].getAttribute("data-bigimgsrc");
} 

function displayOverlayImageFromIndex(index) {
    document.querySelector("#overlay .overlay-image").src = smallImages[index].getAttribute("data-bigimgsrc");
}

function smallImagesClick(){
    currentIndex = parseInt(this.dataset.index);
    document.querySelector("#big-display-1").src = this.dataset.bigimgsrc;
    /* let firstimg = document.querySelector(".first_img");
    console.log(firstimg);
    firstimg.style.display = "none";   */  
}

function bigImageClick() {
    let elem = document.querySelector("#overlay .overlay-image");
    elem.src = this.src;
    showOverlay();
}

function showOverlay() {
    document.querySelector("#overlay").classList.add("visible");
}

function removeOverlay() {
    document.querySelector("#overlay").classList.remove("visible");
}