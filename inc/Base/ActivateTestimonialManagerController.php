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
class ActivateTestimonialManagerController extends BaseController{
public $callbacks;
public $subpages = array();
public function register(){

    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['testimonial_manager']) ? $option['testimonial_manager'] : false;
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
      'page_title' => 'Activate Testimonial Manager',
      'menu_title' => 'Testimonial Manager',
      'capability' => 'manage_options',
      'menu_slug' => 'Dsports_atem',
      'callback' => array($this->callbacks, 'adminTestimonial')
    )
  );
}
public function activate(){
  register_post_type('dsports_testimonial',
    array(
      'labels' => array(
        'name' => 'Testimonial',
        'singular_name' => 'Testimonial'
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


}
