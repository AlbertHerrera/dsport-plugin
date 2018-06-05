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
     wp_enqueue_style( 'shuffleStyle', $this->plugin_url .'assets/css/shuffleStyles.min.css');
     wp_enqueue_script('newscript', $this->plugin_url .'assets/js/shuffleScript.min.js');
   }
 }
