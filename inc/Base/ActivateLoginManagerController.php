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
class ActivateLoginManagerController extends BaseController{
public $callbacks;
public $subpages = array();
public function register(){

    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['login_manager']) ? $option['login_manager'] : false;
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
      'page_title' => 'Activate Login Manager',
      'menu_title' => 'Login Manager',
      'capability' => 'manage_options',
      'menu_slug' => 'Dsports_alm',
      'callback' => array($this->callbacks, 'adminLogin')
    )
  );
}
public function activate(){
  register_post_type('dsports_login',
    array(
      'labels' => array(
        'name' => 'Login',
        'singular_name' => 'Login'
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


}
