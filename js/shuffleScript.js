
//Value Slider bar Shuffle points.
function valueSlider(){
  var slider = document.getElementById("myRange");
  console.log(document);

  var output = document.getElementById("demo");
  output.innerHTML = slider.value;
  slider.oninput = function() {
    output.innerHTML = this.value;
  }

}
