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
class ActivateChatManagerController extends BaseController{
public $callbacks;
public $subpages = array();
public function register(){

    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['chat_manager']) ? $option['chat_manager'] : false;
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
      'page_title' => 'Activate Chat Manager',
      'menu_title' => 'Chat Manager',
      'capability' => 'manage_options',
      'menu_slug' => 'Dsports_cm',
      'callback' => array($this->callbacks, 'adminChat')
    )
  );

}
public function activate(){
  register_post_type('dsports_chat',
    array(
      'labels' => array(
        'name' => 'Chat',
        'singular_name' => 'Chat'
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


}
