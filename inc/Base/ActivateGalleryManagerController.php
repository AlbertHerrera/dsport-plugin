<?php
/**
 * @package  dsportsPlugin
 */
namespace Inc\Base;
use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

/**
*
*/
class ActivateGalleryManagerController extends BaseController{
public $callbacks;
public $subpages = array();
public function register(){

    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['gallery_manager']) ? $option['gallery_manager'] : false;
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
      'page_title' => 'Activate Gallery Manager',
      'menu_title' => 'Gallery Manager',
      'capability' => 'manage_options',
      'menu_slug' => 'Dsports_agm',
      'callback' => array($this->callbacks, 'adminGallery')
    )
  );
}
public function activate(){
  register_post_type('dsports_Gallery',
    array(
      'labels' => array(
        'name' => 'Gallery',
        'singular_name' => 'Gallery'
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


}
