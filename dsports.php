<?php
/**
 * Plugin Name: Dsports
 * Plugin URI: https://github.com/AlbertHerrera/dsport_plugin
 * Description: Este plugin crea concursos online.
 * Version: 0.0.1
 * Author: Albert Herrera
 * Author URI: wwww.shuffleshowcase.com
 *
 * Text Domain: dsports
 */
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

//This action calls a function, this function create a meta box in the Page.
function custom_meta_box_markup($object)
{
  wp_nonce_field(basename(__FILE__), "meta-box-nonce");
  ?>
  <div>
         <label for="meta-box-text">Nombre de la liga:</label>
         <input name="meta-box-text" type="leagueName" value="<?php echo get_post_meta($object->ID, "meta-box-text", true); ?>">
         <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}
</style>
</head>
<body>

<h1>Rango de puntos de liga</h1>
<p>Minimo de puntos para entrar en la liga</p>

<div class="slidecontainer">
  <input type="range" min="800" max="2500" value="800" class="slider" id="myRange">
  <p>Value: <span id="demo"></span></p>
</div>

<p>Maximo de puntos para entrar en la liga</p>

<div class="slidecontainer">
  <input type="range" min="800" max="2500" value="2500" class="slider" id="myRange2">
  <p>Value: <span id="demo2"></span></p>
</div>

<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

var slider2 = document.getElementById("myRange2");
var output = document.getElementById("demo2");
slider.oninput = function() {
  output.innerHTML = slider.value;
}

slider2.oninput = function() {
  output.innerHTML = this.value;
}
</script>

</body>


  <br><?php
}

function add_create_league_meta_box()
{
    add_meta_box("create-league-box", "Create League", "custom_meta_box_markup", "page", "side", "high", null);
}

add_action("add_meta_boxes", "add_create_league_meta_box");
