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
class ActivateMembershipManagerController extends BaseController{
public $callbacks;
public $subpages = array();
public function register(){

    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['membership_manager']) ? $option['membership_manager'] : false;
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
      'page_title' => 'Activate Membership Manager',
      'menu_title' => 'Membership Manager',
      'capability' => 'manage_options',
      'menu_slug' => 'Dsports_ambm',
      'callback' => array($this->callbacks, 'adminMembership')
    )
  );
}
public function activate(){
  register_post_type('dsports_taxonomy',
    array(
      'labels' => array(
        'name' => 'Membership',
        'singular_name' => 'Membership'
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


}
