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

  <html lang="en">
  <head>
    <script>

    // With JQuery
    $('#ex1').slider({
    	formatter: function(value) {
    		return 'Current value: ' + value;
    	}
    });

    // Without JQuery
    var slider = new Slider('#ex1', {
    	formatter: function(value) {
    		return 'Current value: ' + value;
    	}
    });
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-slider.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
   <script src="js/bootstrap-slider.min.js"></script>
   <script>
   // Without JQuery
  var slider = new Slider('#ex1', {
  	formatter: function(value) {
  		return 'Current value: ' + value;
  	}
});
   </script>

  </head>
  <body>


    <form>
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Nombre de la liga">
        </div>
      </div>

      <p>Elige el rango de puntos de la liga</p>
    <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
    </form>

</body>


  <br><?php
}

function add_create_league_meta_box()
{
    add_meta_box("create-league-box", "Create League", "custom_meta_box_markup", "page", "side", "high", null);
}

add_action("add_meta_boxes", "add_create_league_meta_box");
