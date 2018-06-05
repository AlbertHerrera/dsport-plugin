<?php
/**
 * @package  DsportsPlugin
 */
namespace Inc\Boxes\League;

/**
*
*/
class Create{
  public function register(){
    add_action("add_meta_boxes", array($this,'add_create_league_meta_box' ));
  }
  public function add_create_league_meta_box()
  {
    add_meta_box("create-league-box", "Create League", array($this, 'custom_meta_box_markup'), "page", "side", "high", null);
  }

  public  function custom_meta_box_markup ($object)
  {
      wp_nonce_field(basename(__FILE__), "meta-box-nonce");
      require_once PLUGIN_PATH. 'templates/boxes/league/create.php';

  }
 }











 ?>
