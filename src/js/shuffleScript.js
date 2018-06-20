import 'code-prettify';
import App from './modules/app.js';
const app = new App();
window.addEventListener("load", function(){

  PR.prettyPrint();
  //store tabs variables
  var tabs = document.querySelectorAll("ul.nav-tabs > li");
  for (var i = 0; i< tabs.length; i++){
    tabs[i].addEventListener("click", switchTab);
  }
  function switchTab(event){
    event.preventDefault();
    document.querySelector("ul.nav-tabs li.active").classList.remove("active");
    document.querySelector(".tab-pane.active").classList.remove("active");

    var clickedTab = event.currentTarget;
    var anchor = event.target;
    var activePaneId = anchor.getAttribute("href");


    clickedTab.classList.add("active");
    document.querySelector(activePaneId).classList.add("active");

  }
});
jQuery(function(){
  jQuery("btnImage").on("click", function(){
    console.log("hiii")
    var images = wp.media({
      title:"Upload Image",
      multiple: false
    }).open().on("selec", function(e){
      var uploadedImages = images.state().get("selection");
      console.log(uploadedImages.toJSON());
    });
  });
});
jQuery(document).ready(function ($) {
	$(document).on('click', '.js-image-upload', function (e) {
		e.preventDefault();
		var $button = $(this);

		var file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select or Upload an Image',
			library: {
				type: 'image' // mime type
			},
			button: {
				text: 'Select Image'
			},
			multiple: false
		});

		file_frame.on('select', function() {
			var attachment = file_frame.state().get('selection').first().toJSON();
      console.log(attachment.url);
      document.getElementById("image").value = attachment.url;

		});

		file_frame.open();
	});
});
