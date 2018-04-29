<?php
/**
 * Plugin Name: dsports-plugin
 * Plugin URI: https://github.com/AlbertHerrera/dsport_plugin
 * Description: Este plugin crea concursos online.
 * Version: 0.0.1
 * Author: Albert Herrera
 * License: GPLv2 or later.
 * Author URI: wwww.shuffleshowcase.com
 *
 * Text Domain: dsports
 */



 /*
 This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined( 'ABSPATH' ) or die( 'You can not access this file,
maybe you will not get bored playing some parchis ;)
http://www.mundijuegos.com' );

class DsportsPlugin{
  //construct
  function __construct(){
    add_action('init',array($this,'custom_post_type' ) );
  }
  //methods
  function activate(){
    //generated a cpt
    // flush rewrite rules.

  }
  function deactivate(){
    // flush rewrite rules

  }
  function unistall(){
    //delete CPT
    //delete all the plugin data from the DB.

  }
  function custom_post_type(){
    register_post_type('hook', ['public' => true, 'label' => 'Dsports News']);
  }
}
if(class_exists( 'DsportsPlugin' )){

  $dsportsPlugin = new DsportsPlugin( 'Dsports Plugin initialized!' );

}
// activation
register_activation_hook(__FILE__, array( $dsportsPlugin, 'activate'));

// deactivation
register_deactivation_hook(__FILE__, array($dsportsPlugin, 'deactivate'));

// unistall

function customFunction($arg){
  echo $arg;
}
customFunction('This is my argument to echo.');
//This function Calls  my styles css.

function load_custom_wp_admin_style($hook) {
  wp_enqueue_script('newscript', plugins_url('js/shuffleScript.js', __FILE__));
      wp_enqueue_style( 'shuffleStyle', plugins_url('css/shuffleStyles.css', __FILE__) );
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
  <body onload="valueSlider()">
    <form>
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Nombre de la liga">
        </div>
      </div>
      <br>
      <h4>Shuffle Points League</h4>
      <div class="slidecontainer">
        <input type="range" min="800" max="2500" value="50" class="slider" id="myRange">
      <p>Sp: <span id="demo"></span></p>
    </div>
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
