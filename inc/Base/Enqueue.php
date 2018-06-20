<?php
/**
 * @package  DsportsPlugin
 */
namespace Inc\Base;
use \Inc\Base\BaseController;
/**
*
*/
class Enqueue extends BaseController{

 public function register(){
     add_action('admin_enqueue_scripts', array($this,'enqueue'));
 }
  function enqueue(){
     wp_enqueue_script( 'media-upload' );
     wp_enqueue_media();
     wp_enqueue_style( 'shuffleStyle', $this->plugin_url .'assets/css/shuffleStyles.min.css');
     wp_enqueue_style( 'bootstrapGrid', $this->plugin_url .'assets/css/bootstrap/bootstrap-grid.css');
     wp_enqueue_style( 'bootstrapGridMin', $this->plugin_url .'assets/css/bootstrap/bootstrap-grid.min.css');
     wp_enqueue_style( 'bootstrapReboot', $this->plugin_url .'assets/css/bootstrap/bootstrap-reboot.css');
     wp_enqueue_style( 'bootstrapRebootMin', $this->plugin_url .'assets/css/bootstrap/bootstrap-reboot.min.css');
     wp_enqueue_style( 'bootstrap', $this->plugin_url .'assets/css/bootstrap/bootstrap.css');
     wp_enqueue_style( 'bootstrapMin', $this->plugin_url .'assets/css/bootstrap/bootstrap.min.css');

     wp_enqueue_script('newscript', $this->plugin_url .'assets/js/shuffleScript.min.js');
     wp_enqueue_script('bootstrapBundle', $this->plugin_url .'assets/js/bootstrap/bootstrap.bundle.js');
     wp_enqueue_script('bootstrapBundleMin', $this->plugin_url .'assets/js/bootstrap/bootstrap.bundle.min.js');
     wp_enqueue_script('bootstrap', $this->plugin_url .'assets/js/bootstrap/bootstrap.js');
     wp_enqueue_script('bootstrapMin', $this->plugin_url .'assets/js/bootstrap/bootstrap.min.js');
   }
 }
