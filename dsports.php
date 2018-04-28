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

//This function Calls  my styles css.

function load_custom_wp_admin_style($hook) {
      wp_enqueue_style( 'custom_wp_admin_css', plugins_url('css/shuffleStyles.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


//This action calls a function, this function create a meta box in the Page.
function custom_meta_box_markup($object)
{
  wp_nonce_field(basename(__FILE__), "meta-box-nonce");
  ?>

  <html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--Bootsrap Sytle -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!--Shuffle Styles -->

  </head>
  <body>
    <form>
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Nombre de la liga">
        </div>
      </div>
      <br>
      <h4>Shuffle Points League</h4>
      <div class="""slidecontainer">
        <input type="range" min="800" max="2500" value="50" class="slider" id="myRange">
      <p>Sp: <span id="demo"></span></p>
    </div>
    <script>
 var slider = document.getElementById("myRange");
 var output = document.getElementById("demo");
 output.innerHTML = slider.value;
 slider.oninput = function() {
   output.innerHTML = this.value;
 }
 </script>
  <button type="button" class="btn btn-success">Crear</button>
    </form>

</body>


  <br><?php
}

function add_create_league_meta_box()
{
    add_meta_box("create-league-box", "Create League", "custom_meta_box_markup", "page", "side", "high", null);
}

add_action("add_meta_boxes", "add_create_league_meta_box");
