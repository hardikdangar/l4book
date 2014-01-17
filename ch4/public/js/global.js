$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    slideshow: false,
  });
});

$(function() {

  $('.create-foldaram').click(function(){
    $('#createfoldagram').modal({
        keyboard: false
    });
  });

});



/* Code for html5 input in Foldagram Popup this will allow image file button to load image thumbnail without uploading it to server  */
$(function() {

var fileDiv = document.getElementById("upload");
var fileInput = document.getElementById("upload-image");
//console.log(fileInput);
fileInput.addEventListener("change",function(e){
  var files = this.files
  showThumbnail(files)
},false)

fileDiv.addEventListener("click",function(e){
  $(fileInput).show().focus().click().hide();
  e.preventDefault();
},false)

fileDiv.addEventListener("dragenter",function(e){
  e.stopPropagation();
  e.preventDefault();
},false);

fileDiv.addEventListener("dragover",function(e){
  e.stopPropagation();
  e.preventDefault();
},false);

fileDiv.addEventListener("drop",function(e){
  e.stopPropagation();
  e.preventDefault();

  var dt = e.dataTransfer;
  var files = dt.files;

  showThumbnail(files)

},false);

function showThumbnail(files){
  for(var i=0;i<files.length;i++){
    var file = files[i];
    var imageType = /image.*/;
    if(!file.type.match(imageType)){
      console.log("Not an Image");
      continue;
    }

    var image = document.createElement("img");
    // image.classList.add("")
    var thumbnail = document.getElementById("thumbnail");
    image.file = file;
    $('#thumbnail').html(image);
    var reader = new FileReader();
    reader.onload = (function(aImg){
      return function(e){
        aImg.src = e.target.result;
      };
    }(image))
    var ret = reader.readAsDataURL(file);
    var canvas = document.createElement("canvas");
    ctx = canvas.getContext("2d");
    image.onload= function(){
      ctx.drawImage(image,125,80);
    }
  }
}

});

/* END Html5 code for file preview */