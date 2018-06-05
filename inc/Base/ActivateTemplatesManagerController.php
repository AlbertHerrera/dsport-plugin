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
class ActivateTemplatesManagerController extends BaseController{
public $callbacks;
public $subpages = array();
public function register(){

    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['templates_manager']) ? $option['templates_manager'] : false;
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
      'page_title' => 'Activate Templates Manager',
      'menu_title' => 'Templates Manager',
      'capability' => 'manage_options',
      'menu_slug' => 'Dsports_atemm',
      'callback' => array($this->callbacks, 'adminTemplates')
    )
  );
}
public function activate(){
  register_post_type('dsports_templates',
    array(
      'labels' => array(
        'name' => 'Templates',
        'singular_name' => 'Templates'
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


}
