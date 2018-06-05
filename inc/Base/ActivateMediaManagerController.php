<?php
/**
 * @package  dsportsPlugin
 */
namespace Inc\Base;
use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

/**
*
*/
class ActivateMediaManagerController extends BaseController{
public $callbacks;
public $subpages = array();
public function register(){

    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['media_widget']) ? $option['media_widget'] : false;
    if (! $activated){
      return;
    }
    $this->settings = new SettingsApi();
    $this->callbacks = new AdminCallbacks();
    $this->setSubpages();
    $this->settings->addSubPages( $this->subpages)->register();

    add_action('init', array($this, 'activate'));
}
public function setSubpages(){
  $this->subpages = array(
    array(
      'parent_slug' => 'dsports_plugin',
      'page_title' => 'Activate Media Widget',
      'menu_title' => 'Media Widget',
      'capability' => 'manage_options',
      'menu_slug' => 'Dsports_amm',
      'callback' => array($this->callbacks, 'adminWidget')
    )
  );
}
public function activate(){
  register_post_type('dsports_media',
    array(
      'labels' => array(
        'name' => 'Media',
        'singular_name' => 'Media'
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


}
