$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    slideshow: false,
  });
});

$(function() {

  $('#qty').keyup(function(e) {  // e=event
    //e.preventDefault();
    // attempt to GET the new content
    var qty = $(this).val();
    $.post(base_url+'price/',{ qty:$(this).val()}, function(data) {
        $('#price').val(data);
        if(qty==''){
          $('#total').val(0);
        }else {
          $('#total').val(parseInt(qty)*parseFloat(data));
        }

    });

  });

   $('#qty').focus(function(e) {  // e=event
    //e.preventDefault();
    // attempt to GET the new content
    var qty = $(this).val();
    $.post(base_url+'price/',{ qty:$(this).val()}, function(data) {
        $('#price').val(data);
        if(qty==''){
          $('#total').val(0);
        }else {
          $('#total').val(parseInt(qty)*parseFloat(data));
        }

    });
  });

  $('.create-foldaram').click(function(){
    $('#createfoldagram').modal({
        keyboard: false
    });
  });

   var i=0;
   var j=0;

  //$('.add, .submit-btn, .enteraddress, .backfirst, .address .alert-error, .remove').hide();
  $('.address .alert-error, .acount').hide();

  $('.submit-content .edit-btn').click(function(){
    // body...
     j= Number(total_item)+1;
    $('#hpreview').modal('hide');
    $('#popup').modal('show');
  });

  $('.address .alert-error .close').click(function(){
      $('.address .alert-error').hide();
  });


  $('.enter-message').limit('1200','#charsLeft');

  if(total_item == 0){
      var j=1;
      $('.remove').hide();
  }
  else {
      $('.acount').show();
      $(".next").click();
      var j= Number(total_item)+1;
  }

  $('.remove').hide();
  var html = $('#recipient_address').html();
  html = html.replace(/zero/g,i);
  html = html.replace("rone",j);
  html = html.replace("aid",j);

  $(".recipient_address_wapper").append(html);

  $(".add").on('click',function(){
    //$('.total_foldagram p.total').html("<strong>Total Item : </strong>"+j);
    var html = $('#recipient_address').html();
    html = html.replace(/zero/g,++i);
    html = html.replace("rone",++j);
    html = html.replace("aid",j);
    $('.recipient_address_wapper .recipient_address').hide();
    $(".recipient_address_wapper").append(html);
    $('.remove, .acount').show();
    return false;
  });

  $('.remove').on('click', function(){
    $('#recip_'+j).remove();
    $('#recip_'+--j).show();
    if(j==1){
      $('.remove, .acount').hide();
    }
     return false;
  });

   $(".continue_shoping").click(function(){
      $('#popup').modal('show');
  });

   $('.approve-btn').click(function(){
      window.location.href = base_url+"cart";
   });

   $(".editradd").click(function(){

      var rid = $(this).val();

      if($(this).html()=="Edit"){

        $(this).html("Save");
        $('#raddress #'+rid+' .dispaddress').hide();
        $('#raddress #'+rid+' .editaddress').show();

      }else if($(this).html()=="Save"){

         $(this).html("Edit");

         $.post(base_url+'updateraddress', {rid:$(this).val(), fullname:$('input[name="fullname_'+rid+'"]').val(), address:$('textarea[name="address_one_'+rid+'"]').val()},
          function(data){
              var daddress = "<p>"+data+"</p>";
              $('#raddress #'+rid+' .dispaddress').html(daddress);
              $('#raddress #'+rid+' .dispaddress').show();
              $('#raddress #'+rid+' .editaddress').hide();
         });
      }
   });



  $.validator.setDefaults({
  showErrors: function(map, list) {
    // there's probably a way to simplify this
    var focussed = document.activeElement;
    if (focussed && $(focussed).is("input, textarea")) {
      $(this.currentForm).tooltip("close", { currentTarget: focussed }, true)

    }
    this.currentElements.removeAttr("title").removeClass("ui-state-highlight");
    $.each(list, function(index, error) {
      $(error.element).attr("title", error.message).addClass("ui-state-highlight");
    });
    if (focussed && $(focussed).is("input, textarea")) {
      $(this.currentForm).tooltip("open", { target: focussed });
    }
  }
});

   $("#create").tooltip({
    show: false,
    hide: false
  });

  $("#create").validate();
  $("#cart").validate();

});

jQuery(function($){

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
